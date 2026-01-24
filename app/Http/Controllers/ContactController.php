<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Exports\ContactsExport;
use App\Http\Requests\ContactRequest;
use App\Http\Resources\ContactResource;
use Illuminate\Support\Facades\Session;

class ContactController extends Controller
{
    public function index(){
        
        /* If I didn't want to sort columns, I could use a blade contacts index page (like indexContacts.blade.php) or the genericIndex blade as a really simple way to display a report that can be used for multiple models without making a blade (or Vue component) for each one */
        /*$export = (new ContactsExport);
        return view('genericIndex', [
            'title' => 'Contacts',
            'route' => '/contacts',
            'export' => $export,
            'items' => $export->query()->paginate(5)
        ]);*/

        return Inertia::render('IndexContacts', [
            'title' => "Contacts",
            //'styling' => (new ContactsExport)->extraClasses()->toArray(), // if using more dynamic inputs, could use styling to instruct classes on th and td
        ]);
    }

    public function apiList(){
        return ContactResource::collection((new ContactsExport)->query()->paginate(5));
    }

    public function export(){
        return (new ContactsExport)->download('contacts.xlsx');
    }

    public function charts(){
        //import vue-chartjs, make a page to use it, show chart of how many contacts with each company
        return ;
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
            'primaryCompany_id' => $request->primaryCompany_id,
        ]);

        return redirect()->route('contacts');
    }

    public function edit(Contact $contact){
        return view('contacts.editContact', ['contact' => $contact]);
    }

    public function update(ContactRequest $request, Contact $contact){ //
        $contact->update([
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'email' => $request->email,
            'primaryCompany_id' => $request->primaryCompany_id,
        ]);
        return redirect()->route('contacts');
    }

    public function delete(){

    }
}
