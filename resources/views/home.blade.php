@extends('layouts.app')
@section('title','Users')
@section('content')

<a href={{ route('locale','en') }}>EN</a>
<a href={{ route('locale','ar') }}>AR</a>

    {{-- {{ __("messages.hello",['name'=>__("messages.attributes.alissar")]) }} --}}

    {{ trans_choice("messages.apples",1) }}

  <table class="table">
        <thead>
            <tr>
                <th scope="col">name ar</th>
                <th scope="col">name en</th>
              
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->getTranslation('name','ar') }}</td>
                    <td>{{ $product->getTranslation('name','en') }}</td>
                  -

                </tr>
            @endforeach

        </tbody>
    </table>



@endsection
