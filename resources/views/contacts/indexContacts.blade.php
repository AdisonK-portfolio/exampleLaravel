@extends('app')

@section('title')
    <div class="text-4xl">Contacts</div>
@endsection

@section('content')
    <div>
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Company</th>
                </tr>
            </thead>
            <tbody>
                @foreach($contacts as $contact)
                    <tr>
                        <td>{{$contact->lastName}}, {{$contact->firstName}}</td>
                        <td>{{$contact->email}}</td>
                        <td>{{$contact->company->name}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection