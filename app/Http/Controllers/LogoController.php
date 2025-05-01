<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\LogoWebsiteModel;
use App\Models\ExpenseModel;
use Str;
use Carbon\Carbon;
use Auth;

class LogoController extends Controller
{
    public function logo_index(Request $request)
    {
        $data['getRecord'] = LogoWebsiteModel::getSingleFirst();
        return view('logo.update', $data);
    }

    public function logo_update(Request $request)
    {
        if (auth()->check() && auth()->user()->id == 5) {
            return redirect('admin/logo')->with('error', 'Acesso negado para este usuário.');
        }
        $user = LogoWebsiteModel::getSingleFirst();
        $user->website_name = trim($request->website_name);
        
        if(!empty($request->file('logo'))){
            if(!empty($user->logo) && file_exists('upload/logo/'.$user->logo)){
                unlink('upload/logo/'.$user->logo);
            }
            $file = $request->file('logo');
            $randomStr = Str::random(30);
            $filename = $randomStr .'.'.$file->getClientOriginalExtension();
            $file->move('upload/logo/',$filename);
            $user->logo = $filename;
        }
        
        if(!empty($request->file('favicon'))){
            if(!empty($user->favicon) && file_exists('upload/logo/'.$user->favicon)){
                unlink('upload/logo/'.$user->favicon);
            }
            $file = $request->file('favicon');
            $randomStr = Str::random(30);
            $filename = $randomStr .'.'.$file->getClientOriginalExtension();
            $file->move('upload/logo',$filename);
            $user->favicon = $filename;
        }
        
        $user->save();
        return redirect()->back()->with('success', "Logo salvo com sucesso");
    }
}
