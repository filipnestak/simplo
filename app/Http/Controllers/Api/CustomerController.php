<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\CustomerRequest;
use App\Http\Requests\ManageCustomerGroupsRequest;
use App\Models\Customer;
use App\Models\CustomerGroup;
use Illuminate\Http\Request;

/**
 * Class CustomerController
 * @package App\Http\Controllers\Api
 */
class CustomerController extends Controller
{
    /**
     * @return Customer[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index($withGroups = false)
    {
        return Customer::all();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function show($id, $withGroups = false)
    {
        if (!$withGroups) {
            return Customer::findOrFail($id);
        } else {
            return Customer::with('customerGroups')->findOrFail($id);
        }
    }

    /**
     * @param CustomerRequest $request
     * @return mixed
     */
    public function store(CustomerRequest $request)
    {
        return Customer::create($request->validated());
    }

    /**
     * @param CustomerRequest $request
     * @param $id
     * @return mixed
     */
    public function update(CustomerRequest $request, $id)
    {
        $article = Customer::findOrFail($id);
        $article->update($request->validated());

        return $article;
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
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     */
    public function addCustomerGroup(ManageCustomerGroupsRequest $request, $id)
    {
        $customer = Customer::with('customerGroups')->find($id);
        $customerGroups = json_decode($request->validated()['customerGroups']);

        // Control exist customer groups
        $items = CustomerGroup::whereIn('id', $customerGroups)->get('id')->pluck('id')->toArray();
        $customer->customerGroups()->syncWithoutDetaching($items);

        return Customer::with('customerGroups')->findOrFail($id);
    }

    /**
     * @param ManageCustomerGroupsRequest $request
     * @param $id
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     */
    public function removeCustomerGroup(ManageCustomerGroupsRequest $request, $id)
    {
        $customer = Customer::with('customerGroups')->findOrFail($id);
        $customerGroups = json_decode($request->validated()['customerGroups']);
        $customer->customerGroups()->detach($customerGroups);

        return Customer::with('customerGroups')->findOrFail($id);
    }
}
