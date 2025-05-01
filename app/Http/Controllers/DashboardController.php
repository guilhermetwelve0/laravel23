<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductModel;
use App\Models\SalesModel;
use App\Models\User;
use App\Models\PurchaseModel;
use App\Models\SupplierModel;
use App\Models\TransactionsModel;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{ 
    public function dashboard(Request $request)
    {
            if(Auth::user()->is_role == 1)
            {
              $TotalProduct = ProductModel::count();
              $TotalSales = SalesModel::TotalSalescount();
              $TotalPurchase = PurchaseModel::count();
              $TotalSupplier =SupplierModel::TotalSupplierCount();
              $TotalWallets = User::sum('wallets');
              $products = ProductModel::select('name_product', 'selling_price')->get();
              $chartData = [
                'categories' => $products->pluck('name_product')->toArray(),
                'data' => $products->pluck('selling_price')->toArray(),
              ];
              $data['salesData'] = SalesModel::selectRaw('member.code_member, SUM(sales.total_item) as total_sales')
              ->join('member', 'member.id', '=', 'sales.member_id')
              ->groupBy('member.code_member')->get();
              $salesWithTransactions = SalesModel::with('transaction')->get();
              $transactions = TransactionsModel::all();
              return view('dashboard.admin_list', [
                  'chartData' => $chartData,
                  'TotalProduct' => $TotalProduct,
                  'TotalSales' => $TotalSales,
                  'TotalPurchase' => $TotalPurchase,
                  'TotalSupplier' => $TotalSupplier,
                  'salesData' => $data['salesData'],
                  'TotalWallets' => $TotalWallets,
                  'salesWithTransactions' => $salesWithTransactions,
                  'transactions' => $transactions
              ]);  
            }
            else if(Auth::user()->is_role == 2)
            {
                $user_id = Auth::user()->id;
                $data['getWallets'] = User::find($user_id);
                $data['TotalPending'] = TransactionsModel::where('user_id', '=', $user_id)
                ->where('payment_type', '=', 0)->sum('amount');
                $data['TotalCompleted'] = TransactionsModel::where('user_id', '=', $user_id)
                ->where('payment_type', '=', 1)->sum('amount');
                return view('dashboard.user_list', $data);
            }
        }
}