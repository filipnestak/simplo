<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'              => $this->id,
            'first_name'      => $this->first_name,
            'surname'         => $this->surname,
            'contact_email'   => $this->contact_email,
            'phone'           => $this->phone,
            'customer_groups' => CustomerGroupResource::collection($this->whenLoaded('customerGroups'))
        ];
    }
}
