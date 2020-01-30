<?php


namespace App\DBModels;

use Illuminate\Database\Eloquent\Model;


class AccountTransfer extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
'TransferDate',
'TransferType',
'FromCustomerId',
'ToCustomerId',
'FromAccountId',
'ToAccountId',
'Amount',
    ];
}