<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AccountTransaction extends JsonResource
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
            'accountType' => $this->accountType,
            'accountNumber' => $this->accountNumber,
            'balanceAmount' => $this->balanceAmount      
        ];
    }
}
