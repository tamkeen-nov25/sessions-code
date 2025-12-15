@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="card shadow">
        <div class="card-body">
            <h1 class="card-title">Welcome</h1>
            <p class="card-text">
                This page uses a layout with Blade partials and Bootstrap styling.
            </p>
        </div>
    </div>


    <x-alert type="primary">


        <x-slot name="view">
            home
        </x-slot>


        hello 
    </x-alert>
@endsection
