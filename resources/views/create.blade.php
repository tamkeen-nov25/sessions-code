@extends('layouts.app')

@section('title', 'create user')
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
            <label for="title_en">title en</label>
            <input id="title_en" type="text" name="title[en]">

            <label for="title_ar">title ar</label>
            <input id="title_ar" type="text" name="title[ar]">

        </div>

        <label for="password">password</label>
        <input id="password" type="password" name="password">


        <button type="submit">submit</button>
    </form>

@endsection
