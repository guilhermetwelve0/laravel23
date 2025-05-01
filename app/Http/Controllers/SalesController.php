<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\SalesModel;
use App\Models\MemberModel;
use Carbon\Carbon;
use App\Models\SalesDetailsModel;
use App\Models\User;
use App\Models\ProductModel;
use Auth;
use DB;

class SalesController extends Controller
{ 
    public function all_delete()
    {
        if (auth()->user()->id == 5) {
            return redirect('admin/sales')->with('error', 'Acesso negado para este usuário.');
        }
        DB::table('sales')->truncate();
        return redirect()->back()->with('success', 'Todos os registros foram deletados com sucesso');
    }

    public function sales_index(Request $request)
    {
        $getRecord = SalesModel::select('sales.*', 'member.name_member', 'users.name')
        ->join('member', 'member.id', '=', 'sales.member_id')
        ->join('users', 'users.id', '=', 'sales.user_id');
        
        if($request->id)
        {
            $getRecord = $getRecord->where('sales.id', '=', $request->id);
        }
        if($request->member_id){
            $getRecord = $getRecord->where('member.name_member', 'like', '%'.$request->member_id.'%');
        }
        if($request->user_id){
            $getRecord = $getRecord->where('users.name', 'like', '%'.$request->user_id.'%');
        }
        if($request->total_item){
            $getRecord = $getRecord->where('sales.total_item', 'like', '%'.$request->total_item.'%');
        }
        if($request->accepted){
            $getRecord = $getRecord->where('sales.accepted', '=', $request->accepted);
        }
        
        $getRecord = $getRecord->paginate(5);
        $data['getRecord'] = $getRecord;
        return view('sales.list', $data);
    }

    public function sales_add(Request $request)
    {
        $data['getMember'] = MemberModel::get();
        $data['getUser'] = User::where('is_role', '=', 2)->get();
        return view('sales.add', $data);
    }

    public function sales_post(Request $request)
    {
        if (auth()->user()->id == 5) {
            return redirect('admin/sales')->with('error', 'Acesso negado para este usuário.');
        }
       $save = new SalesModel;
         $save->member_id = trim($request->member_id);
         $save->total_item = trim($request->total_item);
         $save->total_price = trim($request->total_price);
         $save->tenant_id = Auth::id();
         $save->discount = trim($request->discount);
         $save->accepted = trim($request->accepted);
         $save->user_id = trim($request->user_id);
         $save->created_at = Carbon::now('America/Sao_Paulo');
         $save->updated_at = Carbon::now('America/Sao_Paulo');
         $save->save();
        return redirect('admin/sales')->with('success', 'Registro criado com sucesso');
    }

    public function sales_edit ($id)
    {
        $data['getMember'] = MemberModel::get();
        $data['getUser'] = User::where('is_role', '=', 2)->get();
        $data['getEdit'] = SalesModel::find($id);
        return view('sales.edit', $data);
    }

    public function sales_edit_update($id, Request $request)
    {
        if (auth()->user()->id == 5) {
            return redirect('admin/sales')->with('error', 'Acesso negado para este usuário.');
        }
        $save = SalesModel::find($id);
        $save->member_id = trim($request->member_id);
        $save->total_item = trim($request->total_item);
        $save->total_price = trim($request->total_price);
        $save->discount = trim($request->discount);
        $save->accepted = trim($request->accepted);
        $save->user_id = trim($request->user_id);
        $save->updated_at = Carbon::now('America/Sao_Paulo');
        $save->save();
        return redirect('admin/sales')->with('success', 'Registro atualizado com sucesso');
    }

    public function sales_delete($id)
    {
        if (auth()->user()->id == 5) {
            return redirect('admin/sales')->with('error', 'Acesso negado para este usuário.');
        }
        SalesModel::find($id)->delete();
        SalesDetailsModel::where('sales_details.sales_id', '=', $id)->delete();
        return redirect('admin/sales')->with('success', 'Registro deletado com sucesso');
    }

    public function sales_details_list($id, Request $request)
    {
        $data['sales_id'] = $id;
        $getRecord = SalesDetailsModel::select('sales_details.*', 'product.name_product');
        $getRecord = $getRecord->join('product', 'product.id', '=', 'sales_details.product_id');
        
        if($request->product_id){
            $getRecord = $getRecord->where('product.name_product', 'like', '%'.$request->product_id.'%');
        }
        if($request->selling_price){
            $getRecord = $getRecord->where('sales_details.selling_price', 'like', '%'.$request->sales_price.'%');
        }
        if($request->amount){
            $getRecord = $getRecord->where('sales_details.amount', 'like', '%'.$request->amount.'%');
        }
        if($request->discount){
            $getRecord = $getRecord->where('sales_details.discount', 'like', '%'.$request->discount.'%');
        }
        $getRecord = $getRecord->where('sales_details.sales_id', '=', $id)->paginate(5);
        $data['getRecord'] = $getRecord; 

        return view('sales.sales_details_list', $data);
    }

    public function sales_details_add($id)
    {
        $data['sales_id'] = $id;
        $data['getProduct'] = ProductModel::get();
        return view('sales.sales_details_add', $data);
    }

    public function sales_details_add_store(Request $request)
    {
        if (auth()->user()->id == 5) {
            return redirect('admin/sales')->with('error', 'Acesso negado para este usuário.');
        }
        $request->validate([
            'product_id' => 'required',
        ]);
        SalesDetailsModel::recordInsert($request);
        return redirect('admin/sales/sales_details_list/'.$request->sales_id)->with('success', 'Registro criado com sucesso');
    }

    public function sales_details_edit($id)
    {
        $data['getRecord'] = SalesDetailsModel::findOrFail($id);
        $data['getProduct'] = ProductModel::get();
        return view('sales.sales_details_edit', $data);
    }

    public function sales_details_update($id, Request $request)
    {
        if (auth()->user()->id == 5) {
            return redirect('admin/sales')->with('error', 'Acesso negado para este usuário.');
        }
        $save = SalesDetailsModel::findOrFail($id);
        $save->product_id = trim($request->product_id);
        $save->selling_price = trim($request->selling_price);
        $save->amount = trim($request->amount);
        $save->discount = trim($request->discount);
        $save->subtotal = trim($request->subtotal);
        $save->updated_at = Carbon::now('America/Sao_Paulo');
        $save->save();
        return redirect('admin/sales/sales_details_list/'.$request->sales_id)->with('success', 'Registro atualizado com sucesso');
    }

    public function sales_details_delete($id)
    {
        if (auth()->user()->id == 5) {
            return redirect('admin/sales')->with('error', 'Acesso negado para este usuário.');
        }
        SalesDetailsModel::find($id)->delete();
        return redirect()->back()->with('success', 'Registro deletado com sucesso');
    }
}
