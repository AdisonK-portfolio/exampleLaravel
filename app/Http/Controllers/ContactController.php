<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use Illuminate\Support\Facades\Session;

class ContactController extends Controller
{
    public function index(){
        return view('contacts.indexContacts', ['contacts' => Contact::all()]);
    }

    public function create(){
        return view('contacts.createContact');
    }

    public function store(ContactRequest $request){
        $contact = Contact::create([
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'email' => $request->email,
            'madeBy_id' => 1, // todo - auth()->user()->id
            'company_id' => $request->companyId,
        ]);

        return route('contact.edit', $contact);
    }

    public function edit(){

    }

    public function update(){

    }

    public function delete(){

    }
}
