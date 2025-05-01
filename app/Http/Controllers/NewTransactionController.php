<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\TransactionsModel;
use Auth;
use PDF;
use Carbon\Carbon;

class NewTransactionController extends Controller
{
    public function pdf_wallets($id)
    {
        if (auth()->user()->id == 5) {
            return redirect()->back()->with('error', 'Acesso negado para este usuário.');
        }
        $data['getRecord'] = User::find($id);
        $pdf = PDF::loadView('new_transaction.pdf_wallets', $data);
        return $pdf->download('pdf_wallets.pdf');
    }

    public function new_transaction()
    {
        $use_id = Auth::user()->id;
        $data['getRecord'] = User::find($use_id);
        return view('new_transaction.list', $data);
    }

    public function add_wallets($id)
    {
        $data['getRecord'] = User::find($id);
        return view('new_transaction.update', $data);
    }

    public function add_wallets_update($id, Request $request)
    {
        if (auth()->user()->id == 5) {
            return redirect()->back()->with('error', 'Acesso negado para este usuário.');
        }
        $update = User::find($id);
        $Add = $request->wallets + $update->wallets;
        $update->wallets = trim($Add);
        $update->updated_at = Carbon::now('America/Sao_Paulo');
        $update->save();
        return redirect('user/new_transaction')->with('success', "Registro atualizado com sucesso");
    }

    public function user_transaction_list(Request $request)
    {
        $user_id = Auth::user()->id;
        $getRecord = TransactionsModel::select('transactions.*');
        
        if(!empty($request->id)) {
            $getRecord = $getRecord->where('transactions.id', '=', $request->id);
        }
        if(!empty($request->amount)) {
            $getRecord = $getRecord->where('transactions.amount', 'like', '%'.$request->amount.'%');
        }
        if(!empty($request->description)) {
            $getRecord = $getRecord->where('transactions.description', 'like', '%'.$request->description.'%');
        }
        if(!empty($request->created_at)) {
            $getRecord = $getRecord->where('transactions.created_at', 'like', '%'.$request->created_at.'%');
        }
        if(!empty($request->updated_at)) {
            $getRecord = $getRecord->where('transactions.updated_at', 'like', '%'.$request->updated_at.'%');
        }
        
        $getRecord = $getRecord->where('user_id', '=', $user_id)->get();
        $data['getRecord'] = $getRecord;
        return view('transaction.user_transaction_list', $data);
    }

    public function transaction_list_add()
    {
        return view('transaction.user_transaction_list_add');
    }

    public function transaction_list_add_store(Request $request)
    {
        if (auth()->user()->id == 5) {
            return redirect()->back()->with('error', 'Acesso negado para este usuário.');
        }
        $user_id = Auth::user()->id;
        $getWallet = User::where('id', '=', $user_id)->first();
        
        if($getWallet->wallets >= $request->amount) {
            User::where('id', $user_id)->update([
                'wallets' => $getWallet->wallets - $request->amount
            ]);
            
            $save = new TransactionsModel;
            $save->user_id = $user_id;
            $save->amount = $request->amount;
            $save->updated_at = Carbon::now('America/Sao_Paulo');
            $save->created_at = Carbon::now('America/Sao_Paulo');
            $save->save();
            return redirect('user/transaction_list')->with('success', 'Transação realizada com sucesso!');
        } else {
            return redirect()->back()->with('error', 'Saldo insuficiente na sua carteira. Verifique sua carteira antes de tentar novamente.');
        }
    }
}
