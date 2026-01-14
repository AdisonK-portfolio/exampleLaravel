<?php

namespace App\Http\Controllers;

//use Inertia\Inertia;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Exports\ContactsExport;
use App\Http\Requests\ContactRequest;
use App\Http\Resources\ContactResource;
use Illuminate\Support\Facades\Session;

class ContactController extends Controller
{
    public function index(){
        return view('contacts.indexContacts', ['contacts' => (new ContactsExport)->query()->paginate(5)]);
        
        // return Inertia::render('IndexContacts', [
        //     'contacts' => Contact::all()//paginate(5),
        // ]);
    }

    public function apiList(){
        return ContactResource::collection(Contact::all());
    }

    public function export(){
        return (new ContactsExport)->download('contacts.xlsx');
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
        return view('contacts.editContact');
    }

    public function update(){

    }

    public function delete(){

    }
}
