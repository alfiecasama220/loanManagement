<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

use App\Models\Borrower;

use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('users.member');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fname' => 'required',
            'mname' => 'nullable',
            'lname' => 'required',
            'address' => 'required',
            'sex' => 'required',
            'age' => 'required',
            'civil' => 'required',
            'religion' => 'required',
            'contact' => 'required',
            'dateOfBirth' => 'required',
            'placeOfBirth' => 'required',
            'yearLevel' => 'required',
            'course' => 'required',
            'email' => 'required',
            'username' => 'required',
            'password' => 'required',
            
        ]);

        if($validator->passes()) {
            $borrower = new Borrower();

            $borrower->firstname = $request->fname;
            $borrower->middlename = $request->mname;
            $borrower->lastname = $request->lname;
            $borrower->address = $request->address;
            $borrower->sex = $request->sex;
            $borrower->age = $request->age;
            $borrower->civil = $request->civil;
            $borrower->religion = $request->religion;
            $borrower->contact_no = $request->contact;
            $borrower->dateOfBirth = $request->dateOfBirth;
            $borrower->placeOfBirth = $request->placeOfBirth;
            $borrower->yearLevel = $request->yearLevel;
            $borrower->course = $request->course;
            $borrower->email = $request->email;
            $borrower->username = $request->username;
            $borrower->password = Hash::make($request->password);
            $borrower->save();

            return redirect()->back()->with('success', 'Your data is added');
            
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
}
