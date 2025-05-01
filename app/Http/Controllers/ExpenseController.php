<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\ExpenseModel;
use Carbon\Carbon;
use Auth;

class ExpenseController extends Controller
{
    public function list(Request $request)
    {
        $getRecord = ExpenseModel::orderBy('id', 'asc');

         if($request->id){
            $getRecord = $getRecord->where('id', '=', $request->id);
         }
         if($request->description){
            $getRecord = $getRecord->where('description', 'like', '%'.$request->description.'%');
         }
         if($request->amount){
            $getRecord = $getRecord->where('amount', 'like', '%'.$request->amount.'%');
         }
         if($request->created_at){
            $getRecord = $getRecord->where('created_at', 'like', '%'.$request->created_at.'%');
         }
         if($request->updated_at){
            $getRecord = $getRecord->where('updated_at', 'like', '%'.$request->updated_at.'%');
         }

        
         $getRecord = $getRecord->paginate(5);
         $data['getRecord'] = $getRecord;

        return view('expense.list', $data);
    }

    public function add()
    {
        return view('expense.add');
    }

    public function store(Request $request)
    {
        if (auth()->check() && auth()->user()->id == 5) {
            return redirect('admin/expense')->with('error', 'Acesso negado para este usuário.');
        }
        $save = new ExpenseModel;
        $save->description = trim($request->description);
        $save->tenant_id = Auth::id();
        $save->amount = trim($request->amount);
        $save-> created_at = Carbon::now('America/Sao_Paulo');
        $save-> updated_at = Carbon::now('America/Sao_Paulo');
        $save->save();
        return redirect('admin/expense')->with('success', "Registro salvo com sucesso");
    }

    public function edit($id)
    {
        $data['getRecord'] = ExpenseModel::find($id);
        return view('expense.edit', $data);
    }

    public function update($id, Request $request)
    {
        if (auth()->check() && auth()->user()->id == 5) {
            return redirect('admin/expense')->with('error', 'Acesso negado para este usuário.');
        }
        $save = ExpenseModel::find($id);
        $save->description = trim($request->description);
        $save->amount = trim($request->amount);
        $save-> created_at = Carbon::now('America/Sao_Paulo');
        $save-> updated_at = Carbon::now('America/Sao_Paulo');
        $save->save();
        return redirect('admin/expense')->with('success', "Registro atualizado com sucesso");
    }

    public function delete($id)
    {
        if (auth()->user()->id == 5) {
            return redirect('admin/expense')->with('error', 'Acesso negado para este usuário.');
        }
        $save = ExpenseModel::find($id);
        $save->delete();
        return redirect('admin/expense')->with('success', "Registro deletado com sucesso");
    }
}
