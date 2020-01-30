<?php


namespace App\DBModels;


use Illuminate\Database\Eloquent\Model;

class AccountDeposit extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
'CustomerId',
'AccountId',
'DepositDate',
'Amount'
    ];
}
