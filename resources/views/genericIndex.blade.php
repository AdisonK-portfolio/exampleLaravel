<?php 
    $maxWidth = "max-w-4xl";
?>
@extends('app-noInertia', ['maxWidth' => $maxWidth])

@section('title')
    <div>{{ $title }}</div>
@endsection

@section('content')
    <div>
        <div class="px-2 md:px-4 my-2 mb-4 flex justify-between space-x-2">
            <form action="{{ $route }}">
                @csrf
                <div class="flex space-x-0">
                    <input type="text" name="search" placeholder="Search for Contact" class="m-0" value="{{ request('search') }}">
                    <button class="bg-primary p-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                    </button>
                </div>
            </form>
            <a href="{{ $route }}/create"><button type="button" class="submitBtn">New User</button></a>
        </div>
        <table class="table">
            <thead>
                <tr>
                    @foreach($export->headings() as $heading)
                        <th>{{ $heading }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                
                @foreach($items as $item)
                    <tr>
                        <?php $styles = $export->extraClasses();?>
                        @foreach($export->map($item) as $key => $data)
                            <td class="{{ $styles->get($key) }} ">{{ $data }} </td>
                        @endforeach
                    </tr>
                @endforeach
                
            </tbody>
        </table>

        <div class="mt-4 px-2">
            {{ $items->onEachSide(1)->links() }}
        </div>
        
    </div>
@endsection