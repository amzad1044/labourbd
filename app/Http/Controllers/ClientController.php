<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Client;
use Session;
use App\Onworking;
 
class ClientController extends Controller
{
    public function index()
    {
    	return view('front.client.signup');
    }
    public function ClientSignup(Request $request)
    {
    	$this->validate($request,[
            'name' =>['required', 'string', 'max:255'],
            'email' =>['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' =>'required|numeric|digits_between:10,13',
            'password' => ['required', 'string', 'min:3', 'confirmed'],
            'address' => 'required|min:5'
        ]);

        $customer = new Client();
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->password = bcrypt($request->password);
        $customer->address = $request->address;

        $customer->save();

        $custId = $customer->_id;
        $custName = $customer->name;

        Session::put('custId',$custId);
        Session::put('custName',$custName);
        Session::put('custEmail',$customer->email);
        Session::put('custPhone',$customer->phone);
        Session::flash('success','Your registration successful');
        return redirect('/');
    }

    public function ClientLogin()
    {
    	return view('front.client.login');
    }
    public function ClientLoginPost(Request $request)
    {
    	 $this->validate($request,[
            'email' => 'required',
            'password' => 'required'
        ]);
        $pass = $request->input('password');

        $customer = Client::where('email',$request->email)->first();
        if($customer && password_verify($pass,$customer->password))
        {
            Session::put('custId',$customer->_id);
            Session::put('custName',$customer->name);
            Session::put('custEmail',$customer->email);
            Session::put('custPhone',$customer->phone);
            Session::flash('success','Login Successful');
            return redirect('/');
        }
        else
        {
        	Session::flash('error','Incorrect user and password');
            return redirect('/');
        }
    }
    public function ClientLogout()
    {
        Session::forget('custId');
        Session::forget('custName');

        Session::flash('warning','You are logged out');
        return redirect('/');
    }

}
