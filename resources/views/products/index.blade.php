@extends('layouts.app')
@section('title','Products')
@section('content')

  <table class="table">
        <thead>
            <tr>
                <th scope="col">name en</th>
                <th scope="col">name ar</th>
            
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->getTranslation('name', 'en') }} </td>
                    <td> {{ $product->getTranslation('name', 'ar') }} </td>
                 

                </tr>
            @endforeach

        </tbody>
    </table>


   
@endsection
