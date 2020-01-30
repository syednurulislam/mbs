<?php


namespace App\DBModels;


use Illuminate\Database\Eloquent\Model;


class Customer extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $timestamps = false;
    protected $fillable = [
        'id',
'firstName',
'lastName',
'fatherName',
'motherName',
'customerType',
'dateOfBirth',
'country',
'city',
'zipCode',
'phone',
'email',
'personalCode',
'password'
    ];
}
