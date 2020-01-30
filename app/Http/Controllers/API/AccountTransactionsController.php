<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\DBModels\AccountTransaction;
use App\DBModels\NotificationType;
use Illuminate\Support\Facades\DB;
use Validator;
use App\Http\Resources\Customer as CustomerResource;

class AccountTransactionsController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAccountBalance(Request $request)
    {
        //$customers = AccountTransactions::all();
        $input = $request->all();

        $customer_id = $input['customerId'];

        $balance = $this->account_balance($customer_id);

        return $this->sendResponse($balance, 'Customer retrieved successfully.',NotificationType::Success);
    }

    public function accountDeposit(Request $request){

      $input = $request->all();
      $customer_id = $input['customerId'];

      DB::table('account_transaction')->insert(
        array(
          'CustomerId' => $customer_id,
          'AccountId' => $customer_id,
          'TransactionDate' => date('Y-m-d'),
          'TransferType' => 1,
          'DrAmount' => $input['amount'],
          'CrAmount' => 0,
        )
      );

      $accountBalance = $this->account_balance($customer_id);

      return $this->sendResponse($accountBalance, 'Deposited Successfully',NotificationType::Success);
    }

    public function accountWithdraw(Request $request){
      $input = $request->all();
      $customer_id = $input['customerId'];

      DB::table('account_transaction')->insert(
        array(
          'CustomerId' => $customer_id,
          'AccountId' => $customer_id,
          'TransactionDate' => date('Y-m-d'),
          'TransferType' => 2,
          'DrAmount' => 0,
          'CrAmount' => $input['amount'],
        )
      );
      $accountBalance = $this->account_balance($customer_id);
      return $this->sendResponse($accountBalance, 'Withdraw Successfully',NotificationType::Success);
    }

    public function balanceTransfer(Request $request){
      $input = $request->all();
      $customer_id = $input['customerId'];


      DB::table('account_transaction')->insert(
        array(
          'CustomerId' => $customer_id,
          'AccountId' => $customer_id,
          'TransactionDate' => date('Y-m-d'),
          'TransferType' => 3,
          'DrAmount' => 0,
          'CrAmount' => $input['amount'],
        )
      );
      $accountBalance = $this->account_balance($customer_id);
      return $this->sendResponse($accountBalance, 'Balance Transfer Successfully',NotificationType::Success);
    }

    public function AccountTransactions(Request $request){

      $input = $request->all();
      $customer_id = $input['CustomerId'];

      $query = DB::table('account_transaction')
            ->select('*')
            ->where('CustomerId', '=', $customer_id)
            ->where('AccountId', '=', $customer_id);

      if($_REQUEST['transactionType']){
        $query->where('TransferType', '=', $_REQUEST['transactionType']);
      }
      if($_REQUEST['fromDate'] && $_REQUEST['toDate']){
        $query->whereBetween('TransactionDate', [$_REQUEST['fromDate'], $_REQUEST['toDate']]);
      }
      $accounts_transactions = $query->get();

      $accountBalance = new \stdClass();

      $accountBalance->lists = $accounts_transactions;
      $accountBalance->links = [];
      $accountBalance->paging = null;

      return $this->sendResponse($accounts_transactions, 'Customer Account generated successfully.',NotificationType::Success);

    }

    function account_balance($customer_id){

      $accountBalance = new \stdClass();

        $query = "SELECT acc.CustomerId, acc.AccountId, CASE WHEN ca.AccountType = 1 THEN 'Saving' ELSE 'Current' END AccountType,
            ca.AccountNumber, BalanceAmount
            FROM
            (
              SELECT CustomerId, AccountId, SUM(DrAmount - CrAmount) BalanceAmount
              FROM account_transaction
              WHERE CustomerId = '".$customer_id."'
              and   AccountId = '".$customer_id."'
              and   TransactionDate <= CURDATE()
              GROUP BY CustomerId, AccountId
            )acc INNER JOIN customer_account ca ON acc.CustomerId = ca.CustomerId";

        $result = DB::select($query);
        $accountBalance->accountType = $result[0]->AccountType;
        $accountBalance->accountNumber = $result[0]->AccountNumber;
        $accountBalance->balanceAmount = $result[0]->BalanceAmount;

        return $accountBalance;

    }

}
