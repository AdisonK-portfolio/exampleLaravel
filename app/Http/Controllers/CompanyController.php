<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Exports\CompaniesExport;
use App\Http\Requests\CompanyRequest;
use App\Http\Resources\CompanyResource;

class CompanyController extends Controller
{
    public function index(){
        
        return view('companies.indexCompanies', ['companies' => CompanyResource::collection((new CompaniesExport)->query()->paginate(5))]); 
        /* I could use my genericIndex blade instead if I wanted to */
        // $export = (new CompaniesExport);
        // return view('genericIndex', [
        //     'title' => 'Companies',
        //     'route' => '/company',
        //     'export' => $export,
        //     'items' => $export->query()->paginate(5)
        // ]);
    }

    public function export(){
        return (new CompaniesExport)->download('companies.xlsx');
    }

    public function create(){
        return view('companies.createCompany');
    }

    public function store(CompanyRequest $request){
        $company = Company::create([
            'name' => $request->name, 
            'description' => $request->description 
        ]);

        return redirect('company.edit', $company);
    }

    public function edit(Company $company){
        return view('companies.editCompany', ['company' => $company]);
    }

    public function update(CompanyRequest $request, Company $company){
        $company->update([ 
            'name' => $request->name, 
            'description' => $request->description 
        ]);

        return redirect('companies');
    }

    public function delete(){

    }
}
