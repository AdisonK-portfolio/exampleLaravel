<?php 
    use App\Models\Company;
    $maxWidth = "max-w-2xl";
?>
@extends('app-noInertia', ['maxWidth' => $maxWidth])

@section('title')
    <div>Create Contact</div>
@endsection

@section('content')
    <div class="mx-auto">
       <div>
            <label for="firstName">First Name</label>
            <input type="text" name="firstName" id="firstName" class="input">
       </div>
       <div>
            <label for="lastName">Last Name</label>
            <input type="text" name="lastName" id="lastName" class="input">
       </div>
       <div>
            <label for="email">Email</label>
            <input type="text" name="email" id="email" class="input">
       </div>
       <div>
            <label for="companyId">Company</label>
            <select class="input">
                @foreach(Company::all() as $company)
                    <option value="{{$company->id}}" <?= $contact->companies->where('id', $company->id)->first() ? 'select' : ''; ?>>{{$company->name}}</option>
                @endforeach
            </select>
       </div>

        <button type="submit" class="submitBtn mt-4">Submit</button>
    </div>
@endsection