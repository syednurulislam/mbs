<?php


namespace App\DBModels;


use Illuminate\Database\Eloquent\Model;


class AccountTransaction extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
'TransferDate',
'CustomerId',
'AccountId',
'TransactionDate',
'TransferType',
'DrAmount',
'CrAmount',
    ];
}
