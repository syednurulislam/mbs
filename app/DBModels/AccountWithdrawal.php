<?php


namespace App\DBModels;


use Illuminate\Database\Eloquent\Model;


class AccountWithdrawal extends Model
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
'WithdrawalDate',
'Amount'
    ];
}
