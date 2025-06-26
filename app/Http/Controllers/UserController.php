<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Company;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function showInviteAdmin() {
        return view('invite.admin');
    }

    public function inviteAdmin(Request $request) {
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users,email',
            'company_name'=>'required'
        ]);

        $company = Company::create(['name'=>$request->company_name]);

       $user= User::create([
            'full_name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make('password'),
            'role'=>'Admin',
            'company_id'=>$company->id,
        ]);
       
      

        return back()->with('success','Admin invited & company created.');
    }

    public function showInviteUser() {
        return view('invite.user');
    }

    public function inviteUser(Request $request) {
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users,email',
            'role'=>'required|in:Admin,Member',
        ]);

        $companyId = Auth::user()->company_id;

        User::create([
            'full_name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make('password'),
            'role'=>$request->role,
            'company_id'=>$companyId,
        ]);

        return back()->with('success','User invited.');
    }
}
