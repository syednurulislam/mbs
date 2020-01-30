<?php


namespace App\DBModels;


use Illuminate\Database\Eloquent\Model;

class NotificationType extends Model
{
    const Success = 'Success';
    const Info = 'Info';
    const  Warning = 'Warning';
    const Error = 'Error';
}
