<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\DBModels\Customer;
use App\DBModels\User;
use App\DBModels\NotificationType;
use Illuminate\Support\Facades\DB;
use Validator;
use App\Http\Resources\Customer as CustomerResource;

class CustomerController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::all();

        return $this->sendResponse(CustomerResource::collection($customers), 'Customer retrieved successfully.',NotificationType::Success);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $input = $request->all();
        //print_r($input);
        $validator = Validator::make($input, [
            'firstName' => 'required',
            'email' => 'required',
            'personalCode' => 'required',
            'password' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $name = $input['firstName'];
        if(!empty($input['lastName'])){
          $name = ' '.$input['lastName'];
        }
        $user_input['name'] = $name;
        $user_input['email'] = $input['email'];
        $user_input['personalCode'] = $input['personalCode'];
        $user_input['password'] = bcrypt($input['password']);

        $customer = Customer::create($input);
        $user = User::create($user_input);

        $customer_Id = $customer['id'];
        DB::table('users')
            ->where('id', $user['id'])
            ->update(['customer_Id' => $customer_Id]);

        DB::table('customer_account')->insert(
          array(
            'CustomerId' => $customer_Id,
            'AccountNumber' => $customer_Id,
            'AccountType' => $input['accountType'],
            'CurrencyType' => $input['currencyType'],
            'Amount' => $input['amount'],
          )
        );

        DB::table('account_transaction')->insert(
          array(
            'CustomerId' => $customer_Id,
            'AccountId' => $customer_Id,
            'TransactionDate' => date('Y-m-d'),
            'TransferType' => 1,
            'DrAmount' => $input['amount'],
            'CrAmount' => 0,
          )
        );

        return $this->sendResponse(new CustomerResource($customer),
        'Customer created successfully.', NotificationType::Success);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = Customer::find($id);

        if (is_null($customer)) {
            return $this->sendError('Customer not found.');
        }

        return $this->sendResponse(new ProductResource($customer), 'Customer retrieved successfully.');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'FirstName' => 'required',
            'Email' => 'required',
            'PersonalCode' => 'required',
            'Password' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $customer->FirstName = $input['firstName'];
        $customer->save();

        return $this->sendResponse(new CustomerResource($customer), 'Customer updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return $this->sendResponse([], 'Customer deleted successfully.');
    }

    public function customerAccountList(){
      $customer_accounts = DB::table('customer_account')
            ->join('customers', 'customers.id', '=', 'customer_account.CustomerId')
            ->select('customers.id','customers.FirstName', 'customers.LastName', 'customer_account.AccountNumber')
            ->get();

      return $this->sendResponse($customer_accounts, 'Customer Account generated successfully.',NotificationType::Success);
    }
}
