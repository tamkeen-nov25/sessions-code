@extends('layouts.app')
@section('title', 'Register')
@section('content')

    <form method='POST' action="{{ route('register') }}">
        @csrf

        <label for="name">name</label>    
        <input id="name" type="text" name="name">

        <label for="email">email</label>
        <input id="email" type="email" name="email">

        <label for="password">password</label>
        <input id="password" type="password" name="password">

        
        <button type="submit">Register</button>
    </form>
@endsection
