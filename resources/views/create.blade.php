@extends('layouts.app')

@section('title','create user')
@section('content')

<form method='POST' action="{{ route('users.store') }}">

    @csrf
    <div class="form-group">
        <label for="name">Name</label>
        <input id="name" type="text" name="name[en]">
        @error('name')
         {{ $message }}
        @enderror
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input id="email" type="email" name="email">
        @error('email')
            <div class="error-message">{{ $message }}</div>
        @enderror
    </div>

    <label for="password">password</label>
    <input id="password" type="password" name="password">


    <button type="submit">submit</button>
</form>

@endsection