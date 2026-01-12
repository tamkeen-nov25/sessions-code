@extends('layouts.app')

@section('title', 'Home')

@section('content')

    <table>
        <tbody>
            @foreach ($posts as $post)
                <tr>
                    <td>
                        @can('update', $post)
                            <button>update post </button>
                        @endcan
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>




@endsection
