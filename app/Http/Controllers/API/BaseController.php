<?php

namespace App\Http\Controllers\API;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;


class BaseController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendResponse($result, $message, $messageType)
    {
        $obj = new \stdClass();
        $obj->type = $messageType;
        $obj->message = $message;

    	$response = [
            'success' => true,
            'data'    => $result,
            'notification' => $obj            
        ];

        return response()->json($response, 200);
    }


    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($error, $errorMessages = [], $code = 404)
    {
    	$obj = new \stdClass();
        $obj->type = "Error";

        if(!empty($errorMessages)){           
            $obj->message = $errorMessages;
        }
        else{
            $obj->message = $error;
        }       

    	$response = [
            'success' => false,
            'data'    => [],
            'notification' => $obj            
        ];

        return response()->json($response, $code);
    }
}