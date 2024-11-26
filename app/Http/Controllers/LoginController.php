<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use App\Models\User;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('users.login');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:users',
            'address' => 'required',
            'contact' => 'required',
            'username' => 'required',
            'password' => 'required',
            'credentials' => 'required|file|max:7129',
        ]);

        if($validator->passes()) {
            $user = new User();

            $user->name =$request->name;
            $user->email =$request->email;
            $user->contact =$request->contact;
            $user->address = $request->address;
            $user->username =$request->username;
            $user->password =$request->password;


            $path = $request->file('credentials')->store('uploads');
            $user->credentials = $path;
            $user->save();

            return redirect()->back()->with('success', 'Data Added');
             
        } else {
            return redirect()->back()->with('error', 'Data not Added');
        }
    }

    public function loginPost(Request $request) {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required'
        ]);

        if($validator->passes()) {
            if(Auth::guard('borrowers')->attempt(['username' => $request->username, 'password' => $request->password])) {
                $request->session()->regenerate();
                return redirect()->intended(route('index'))->with('success', 'Success');
            } else {
                return redirect()->back()->with('error', 'Invalid Username or Password');
            }
        } 
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function logout() {
        Session::flush();
        Auth::logout();
        return redirect()->intended(route('login.index'))->with('success', 'Logged Out');
    }
}
