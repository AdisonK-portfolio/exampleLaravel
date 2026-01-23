<?php 
    use App\Models\Company;
    $maxWidth = "max-w-2xl";
?>
@extends('app-noInertia', ['maxWidth' => $maxWidth])

@section('title')
    <div>Edit Contact</div>
@endsection

@section('content')
    <div class="mx-auto">
        <form action="{{ route('contact.update', $contact) }}" method="POST">
            @csrf
            @method('PATCH')
            @include('contacts.contactForm', $contact)
        </form>
    </div>
@endsection