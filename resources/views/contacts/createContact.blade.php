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
       <form action="{{ route('contacts.store') }}" method="POST">
            @csrf
            @include('contacts.contactForm')
       </form>
    </div>
@endsection