<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\MyAccountController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\LogoController;
use App\Http\Controllers\SMTPController;
use App\Http\Controllers\NewTransactionController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SalesController;


Route::get('/refresh-csrf', function () {
    return response()->json(['token' => csrf_token()]);
})->name('csrf.refresh');
// Rotas públicas
Route::get('/tela_login', [AuthController::class, 'login'])->name('login');
Route::get('/', function () {
    return view('paginainicial');
});
Route::post('login_post', [AuthController::class, 'login_post']);
Route::get('forgot', [AuthController::class, 'forgot']);
Route::post('forgot_post', [AuthController::class, 'forgot_post']);
Route::get('reset/{token}', [AuthController::class, 'getReset']);
Route::post('reset/{token}', [AuthController::class, 'getResetPost']);
Route::get('registration', [AuthController::class, 'registration']);
Route::post('registration_post', [AuthController::class, 'registration_post']);


// Rotas protegidas para admin
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('admin/dashboard', [DashboardController::class, 'dashboard']);
    Route::get('admin/smtp', [SMTPController::class, 'smtp']);
    Route::post('admin/smtp/update', [SMTPController::class, 'smtp_update']);
    Route::get('admin/category', [CategoryController::class, 'index']);
    Route::get('admin/category/data', [CategoryController::class, 'getCategories']);
    Route::post('admin/category/store', [CategoryController::class, 'store']);
    Route::get('admin/category/edit/{id}', [CategoryController::class, 'edit']);
    Route::post('admin/category/update/{id}', [CategoryController::class, 'update']);
    Route::delete('admin/category/delete/{id}', [CategoryController::class, 'destroy']);
    Route::get('admin/product', [ProductController::class, 'index']);
    Route::post('admin/product/store', [ProductController::class, 'store'])->name('product.store');
    Route::get('admin/product/fetch', [ProductController::class, 'fetchProducts'])->name('product.fetch');
    Route::get('admin/product/edit/{id}', [ProductController::class, 'edit']);
    Route::post('admin/product/update/{id}', [ProductController::class, 'update']);
    Route::get('admin/transaction/pdf_transaction/{id}', [TransactionController::class, 'pdf_transaction']);
    Route::delete('admin/product/delete/{id}', [ProductController::class, 'destroy']);
    Route::get('admin/member', [MemberController::class, 'index']);
    Route::get('admin/logo', [LogoController::class, 'logo_index']);
    Route::post('admin/logo/update', [LogoController::class, 'logo_update']);
    Route::get('admin/member/add', [MemberController::class, 'add']);
    Route::post('admin/member/add', [MemberController::class, 'store']);
    Route::get('admin/member/member_pdf', [MemberController::class, 'member_pdf'])->name('member.pdf');
    Route::get('admin/member/member_pdf_row/{id}', [MemberController::class, 'member_pdf_row'])->name('member.pdf_row'); // Ajuste aqui
    Route::get('admin/member/edit/{id}', [MemberController::class, 'edit']);
    Route::post('admin/member/edit/{id}', [MemberController::class, 'update']);
    Route::get('admin/member/delete/{id}', [MemberController::class, 'delete']);
    Route::get('admin/supplier', [SupplierController::class, 'index']);
    Route::get('admin/supplier/delete/{id}', [SupplierController::class, 'delete']);
    Route::get('admin/supplier/add', [SupplierController::class, 'add']);
    Route::post('admin/supplier/add', [SupplierController::class, 'store']);
    Route::get('admin/supplier/edit/{id}', [SupplierController::class, 'edit']);
    Route::post('admin/supplier/edit/{id}',[SupplierController::class, 'update']);
    Route::get('admin/expense',[ExpenseController::class, 'list']);
    Route::get('admin/expense/add',[ExpenseController::class, 'add']);
    Route::post('admin/expense/add', [ExpenseController::class, 'store']);
    Route::get('admin/expense/edit/{id}', [ExpenseController::class, 'edit']);
    Route::post('admin/expense/edit/{id}', [ExpenseController::class, 'update']);
    Route::get('admin/expense/delete/{id}', [ExpenseController::class, 'delete']);
    Route::get('admin/purchase', [PurchaseController::class, 'purchase']);
    Route::get('admin/purchase/add', [PurchaseController::class, 'purchase_add']);
    Route::post('admin/purchase/add', [PurchaseController::class, 'purchase_store']);
    Route::get('admin/purchase/edit/{id}', [PurchaseController::class, 'purchase_edit']);
    Route::post('admin/purchase/edit/{id}', [PurchaseController::class, 'purchase_update']);
    Route::get('admin/supplier/supplier_pdf', [SupplierController::class, 'supplier_pdf'])->name('supplier.pdf');
    Route::get('admin/supplier/supplier_pdf_row/{id}', [SupplierController::class, 'supplier_pdf_row'])->name('supplier.pdf_row');
    Route::get('admin/member/member_pdf', [MemberController::class, 'member_pdf'])->name('member.pdf');
    Route::get('admin/member/member_pdf_row/{id}', [MemberController::class, 'member_pdf_row'])->name('member.pdf_row'); // Ajuste aqui
    Route::get('admin/purchase/delete/{id}', [PurchaseController::class, 'purchase_delete']);
    Route::get('admin/sales', [SalesController::class, 'sales_index']);
    Route::get('admin/sales/add', [SalesController::class, 'sales_add']);
    Route::post('admin/sales/add', [SalesController::class, 'sales_post']);
    Route::get('admin/sales/edit/{id}', [SalesController::class, 'sales_edit']);
    Route::post('admin/sales/edit/{id}', [SalesController::class, 'sales_edit_update']);
    Route::get('admin/sales/delete/{id}', [SalesController::class, 'sales_delete']);
    Route::get('admin/sales/all_delete', [SalesController::class, 'all_delete']);
    Route::get('admin/purchase/purchase_details/{id}', [PurchaseController::class, 'purchase_details']);
    Route::get('admin/purchase/purchase_details_add/{id}', [PurchaseController::class, 'purchase_details_add']);
    Route::post('admin/purchase/purchase_details_add/{id}', [PurchaseController::class, 'purchase_details_add_store']);
    Route::get('admin/purchase/purchase_details_edit/{id}', [PurchaseController::class, 'purchase_details_edit']);
    Route::post('admin/purchase/purchase_details_edit/{id}', [PurchaseController::class, 'purchase_details_edit_update']);
    Route::get('admin/purchase/purchase_details_delete/{id}', [PurchaseController::class, 'purchase_details_delete']);
    Route::get('admin/purchase/purchase_all_delete', [PurchaseController::class, 'purchase_all_delete']);
    Route::get('admin/sales/sales_details_list/{id}', [SalesController::class, 'sales_details_list']);
    Route::get('admin/sales/sales_details_add/{id}', [SalesController::class, 'sales_details_add']);
    Route::post('admin/sales/sales_details_add/{id}', [SalesController::class, 'sales_details_add_store']);
    Route::get('admin/sales/sales_details_edit/{id}', [SalesController::class, 'sales_details_edit']);
    Route::get('admin/sales/sales_details_delete/{id}', [SalesController::class, 'sales_details_delete']);
    Route::post('admin/sales/sales_details_update/{id}', [SalesController::class, 'sales_details_update'])
    ->name('sales.details.update');
    Route::get('admin/transaction', [TransactionController::class, 'admin_transaction']);
    Route::get('admin/transaction_status_update', [TransactionController::class, 'transaction_status_update']);
    Route::get('admin/my_account', [MyAccountController::class, 'admin_my_account']);
    Route::post('admin/my_account_update', [MyAccountController::class, 'admin_my_account_update']);
    Route::get('admin/transaction/delete_transaction_multi', [TransactionController::class, 'delete_transaction_multi']);
    Route::get('admin/transaction/description/{id}', [TransactionController::class, 'transaction_description']);
    Route::post('admin/transaction/description/{id}', [TransactionController::class, 'transaction_description_update']);
    // Rota para exibir o formulário de registro de transação pelo administrador
    Route::get('admin/transaction/register', [TransactionController::class, 'registerTransaction'])->name('admin.transaction.register');

    // Rota para salvar a transação registrada pelo administrador
    // Route::post('admin/transaction/register', [TransactionController::class, 'storeTransaction'])->name('admin.transaction.store');

    // Rota para visualizar transações
    Route::get('admin/transaction/view', [TransactionController::class, 'viewTransactions'])->name('admin.transaction.view');

    // Rotas para transações
    Route::get('admin/transaction/add', [TransactionController::class, 'create'])->name('admin.transaction.add');
    Route::post('admin/transaction/add', [TransactionController::class, 'store'])->name('admin.transaction.store');
    Route::get('admin/transaction/edit/{id}', [TransactionController::class, 'edit'])->name('admin.transaction.edit');
    Route::put('admin/transaction/edit/{id}', [TransactionController::class, 'update'])->name('admin.transaction.update');
    Route::get('admin/transaction/delete/{id}', [TransactionController::class, 'destroy'])->name('admin.transaction.delete');
    Route::post('admin/transaction/update_status', [TransactionController::class, 'transaction_status_update'])->name('admin.transaction.update_status');

    // Nova funcionalidade para registrar um usuário
    Route::get('admin/users/register', [UsersController::class, 'register'])
         ->name('admin.users.register');
    Route::post('admin/users/register', [UsersController::class, 'store'])
         ->name('admin.users.store');
});

// // Rotas protegidas para usuários comuns
// Route::middleware(['auth', 'user'])->group(function () {
//     Route::get('user/new_transaction_pdf_wallets/{id}', [NewTransactionController::class, 'pdf_wallets']);
//     Route::get('user/dashboard', [DashboardController::class, 'dashboard']);
//     Route::get('user/new_transaction', [NewTransactionController::class, 'new_transaction']);
//     Route::get('user/new_transaction/add_wallets/{id}', [NewTransactionController::class, 'add_wallets']);
//     Route::post('user/new_transaction/add_wallets/{id}', [NewTransactionController::class, 'add_wallets_update']);
//     Route::get('user/transaction_list', [NewTransactionController::class, 'user_transaction_list']);
//     Route::get('user/transaction_list/add', [NewTransactionController::class, 'transaction_list_add']);
//     Route::post('user/transaction_list/add', [NewTransactionController::class, 'transaction_list_add_store']);
//     Route::get('user/my_account', [MyAccountController::class, 'my_account']);
//     Route::post('user/my_account_update', [MyAccountController::class, 'my_account_update']);
//     Route::get('user/change_password', [MyAccountController::class, 'change_password']);
//     Route::post('user/change_password_update', [MyAccountController::class, 'change_password_update']);



// });

// Logout
Route::get('logout', [AuthController::class, 'logout']);