@extends('layouts.app')
@section('content')
    <div class="flex justify-center">
        <div class="bg-white w-8/12 p-3 rounded-lg">
             <x-post :post="$post" ></x-post>
        </div>
    </div>
@endsection
