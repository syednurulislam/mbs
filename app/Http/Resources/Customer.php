<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Customer extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'FirstName' => $this->firstName,
            'lastName' => $this->lastName,
            'fatherName' => $this->fatherName,
            'motherName' => $this->motherName,
            'customerType' => $this->customerType,
            //'DateOfBirth' => $this->dateOfBirth->format('y/m/d'),
            'country' => $this->country,
            'city' => $this->city,
            'zipCode' => $this->zipCode,
            'phone' => $this->phone,
            'email' => $this->email,
            'personalCode' => $this->personalCode,
            'password' => $this->password
        ];
    }

}
