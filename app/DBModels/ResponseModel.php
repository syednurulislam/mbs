<?php


namespace App\DBModels;


use Illuminate\Database\Eloquent\Model;

class ResponseModel extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [       
'Success',
'Message',
'DepositDate',
'Amount'
    ];
}
