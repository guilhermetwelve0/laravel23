<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use Str;
use Hash;
use App\Models\LogoWebsiteModel;

class MyAccountController extends Controller
{

    public function my_account(Request $request)
    {
        $data['getRecord'] = User::find(Auth::user()->id);
        $data['getWebsite'] = LogoWebsiteModel::getSingleFirst();

        // Ensure the logo path is correctly set
        if (!empty($data['getWebsite']->logo)) {
            $data['getWebsite']->logo = url('upload/' . $data['getWebsite']->logo);
        } else {
          
        }

        // Ensure the profile image path is correctly set for the user
        if (!empty($data['getRecord']->profile_image)) {
            $data['getRecord']->profile_image_url = url('upload/' . $data['getRecord']->profile_image);
        } else {
            $data['getRecord']->profile_image_url = null; // Default or placeholder if needed
        }

        return view('user_account.my_account', $data);
    }

    public function my_account_update(Request $request)
    {
        if (auth()->user()->id == 5) {
            return redirect('admin/my_account')->with('error', 'Acesso negado para este usuário.');
        }

        $request->validate([
            'email' => 'required|unique:users,email,' . Auth::user()->id
        ]);

        $user = User::find(Auth::user()->id);
        $user->name = trim($request->name);
        $user->email = trim($request->email);

        // Atualização da imagem de perfil
        if (!empty($request->file('profile_image'))) {
            if (!empty($user->profile_image) && file_exists('upload/' . $user->profile_image)) {
                unlink('upload/' . $user->profile_image);
            }
            $file = $request->file('profile_image');
            $filename = Str::random(30) . '.' . $file->getClientOriginalExtension();
            $file->move('upload/', $filename);
            $user->profile_image = $filename;
        }

        $user->save();

        // ==========================
        // Atualizar LOGO E WEBSITE
        // ==========================

        $website = LogoWebsiteModel::getSingleFirst();

        if ($website) {
            if ($request->hasFile('logo')) {
                if (!empty($website->logo) && file_exists('upload/' . $website->logo)) {
                    unlink('upload/' . $website->logo);
                }
                $logo = $request->file('logo');
                $logoName = time() . '_logo.' . $logo->getClientOriginalExtension();
                $logo->move('upload/', $logoName);
                $website->logo = $logoName;
            }

            if ($request->hasFile('favicon')) {
                if (!empty($website->favicon) && file_exists('upload/' . $website->favicon)) {
                    unlink('upload/' . $website->favicon);
                }
                $favicon = $request->file('favicon');
                $faviconName = time() . '_favicon.' . $favicon->getClientOriginalExtension();
                $favicon->move('upload/', $faviconName);
                $website->favicon = $faviconName;
            }

            $website->website_name = trim($request->website_name);
            $website->user_id = Auth::id();
            $website->save();
        } else {
            return redirect()->back()->with('error', 'Nenhum registro encontrado para atualizar.');
        }

        return redirect()->back()->with('success', "Conta e configurações atualizadas com sucesso");
    }


    public function change_password()
    {
        return view('change_password.user_update');
    }

    public function change_password_update(Request $request)
    {
        if (auth()->user()->id == 5) {
            return redirect('admin/my_account')->with('error', 'Acesso negado para este usuário.');
        }
        $user = User::find(Auth::user()->id);
        if(trim($request->new_password) == trim($request->confirm_password))
        {
            if(Hash::check($request->old_password, $user->password))
            {
                $user->password = Hash::make($request->new_password);
                $user->save();
                return redirect()->back()->with('success', "Senha alterada com sucesso.");
            }else{
                return redirect()->back()->with('error', "A senha antiga não corresponde.");
            }
        }else{
            return redirect()->back()->with('error', "A confirmação da senha não foi realizada.");
        }
    }

    public function admin_my_account()
    {
        $data['getRecord'] = User::find(Auth::user()->id);
        return view('user_account.admin_my_account', $data);
    }

    public function admin_my_account_update(Request $request)
    {
        if (auth()->user()->id == 5) {
            return redirect('admin/my_account')->with('error', 'Acesso negado para este usuário.');
        }
        $use = request()->validate([
            'email' => 'required|unique:users,email,'.Auth::user()->id
        ]);
        $user = User::find(Auth::user()->id);
        $user->name = trim($request->name);
        $user->email = trim($request->email);
        
        if(!empty($request->password)){
            $user->password = Hash::make($request->password);
        }

        if(!empty($request->file('profile_image'))){
            if(!empty($user->profile_image) && file_exists('upload/'.$user->profile_image)){
                unlink('upload/'.$user->profile_image);
            }
            $file = $request->file('profile_image');
            $randomStr = Str::random(30);
            $filename = $randomStr .'.'.$file->getClientOriginalExtension();
            $file->move('upload/',$filename);
            $user->profile_image = $filename;
        }
        
        $user->save();
        return redirect()->back()->with('success', "Registro atualizado com sucesso");
    }
}
