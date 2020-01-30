<?php


namespace App\DBModels;


use Illuminate\Database\Eloquent\Model;


class CustomerAccount extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
'CustomerId',
'AccountNumber',
'AccountType',
'CurrencyType',
'Amount'
    ];
}
