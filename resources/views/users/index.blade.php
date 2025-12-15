@extends('layouts.app')
@section('title','Users')
@section('content')

  <table class="table">
        <thead>
            <tr>
                <th scope="col">name</th>
                <th scope="col">email</th>
                <th scope="col">actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <a href="{{ route('users.edit', $user) }}">edit</a>
                        <form action="{{ route('users.destroy', $user) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit">delete</button>
                        </form>

                    </td>

                </tr>
            @endforeach

        </tbody>
    </table>


    <a href={{ route('users.create') }}>create</a>

     <x-alert type="danger">


        <x-slot name="view">
            users
        </x-slot>


        hello 
    </x-alert>
@endsection
