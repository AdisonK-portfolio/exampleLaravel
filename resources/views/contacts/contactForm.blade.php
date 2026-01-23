<?php $contact = (isset($contact) ? $contact : null);?>
<div>
    <label for="firstName">First Name</label>
    <input type="text" name="firstName" id="firstName" class="input" value="{{ old('firstName', $contact?->firstName) }}">
    @error('firstName')
        <div class="alert alert-danger validationErr">{{ $message }}</div>
    @enderror
</div>
<div>
    <label for="lastName">Last Name</label>
    <input type="text" name="lastName" id="lastName" class="input" value="{{ old('lastName', $contact?->lastName) }}">
    @error('lastName')
        <div class="alert alert-danger validationErr">{{ $message }}</div>
    @enderror
</div>
<div>
    <label for="email">Email</label>
    <input type="text" name="email" id="email" class="input" value="{{ old('email', $contact?->email) }}">
    @error('email')
        <div class="alert alert-danger validationErr">{{ $message }}</div>
    @enderror
</div>
<div>
    <label for="primaryCompanyId">Primary Company</label>
    <select id="primaryCompanyId" class="input" name="primaryCompany_id">
        @foreach(App\Models\Company::all() as $company)
            <option value="{{ $company->id }}" {{(old('primaryCompany_id', $contact?->primaryCompany_id) == $company->id) ? 'selected' : ''; }}>{{ $company->name }}</option>
        @endforeach
    </select>
    @error('primaryCompany_id')
        <div class="alert alert-danger validationErr">{{ $message }}</div>
    @enderror
</div>

<button type="submit" class="submitBtn mt-4">Submit</button>