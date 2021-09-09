<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\CustomerRequest;
use App\Http\Requests\ManageCustomerGroupsRequest;
use App\Http\Resources\CustomerCollection;
use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use App\Models\CustomerGroup;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class CustomerController
 * @package App\Http\Controllers\Api
 */
class CustomerController extends Controller
{
    /**
     * @return CustomerCollection
     */
    public function index()
    {
        $customers = Customer::paginate();
        return new CustomerCollection($customers);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function show($id, $withGroups = false)
    {
        if (!$withGroups) {
            return new CustomerResource(Customer::findOrFail($id));
        } else {
            return new CustomerResource(Customer::with('customerGroups')->findOrFail($id));
        }
    }

    /**
     * @param CustomerRequest $request
     * @return mixed
     */
    public function store(CustomerRequest $request)
    {
        $customer = Customer::create($request->validated());
        return response()->json([
            'message' => 'success',
            'data'    => new CustomerResource($customer)
        ]);
    }

    /**
     * @param CustomerRequest $request
     * @param $id
     * @return mixed
     */
    public function update(CustomerRequest $request, $id)
    {
        $customer = Customer::findOrFail($id);
        $customer->update($request->validated());
        return response()->json([
            'message' => 'success',
            'data'    => new CustomerResource($customer)
        ]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|int
     */
    public function delete(Request $request, $id)
    {
        Customer::destroy($id);
        return response(null, 204);
    }

    /**
     * @param ManageCustomerGroupsRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function addCustomerGroup(ManageCustomerGroupsRequest $request, $id)
    {
        $customer = Customer::with('customerGroups')->find($id);
        $customerGroups = json_decode($request->validated()['customerGroups']);

        // Control exist customer groups
        $items = CustomerGroup::whereIn('id', $customerGroups)->get('id')->pluck('id')->toArray();
        $customer->customerGroups()->syncWithoutDetaching($items);

        return response()->json([
            'message' => 'success',
            'data'    => new CustomerResource(Customer::with('customerGroups')->findOrFail($id))
        ]);
    }

    /**
     * @param ManageCustomerGroupsRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function removeCustomerGroup(ManageCustomerGroupsRequest $request, $id)
    {
        $customer = Customer::with('customerGroups')->findOrFail($id);
        $customerGroups = json_decode($request->validated()['customerGroups']);
        $customer->customerGroups()->detach($customerGroups);

        return response()->json([
            'message' => 'success',
            'data'    => new CustomerResource(Customer::with('customerGroups')->findOrFail($id))
        ]);
    }
}
