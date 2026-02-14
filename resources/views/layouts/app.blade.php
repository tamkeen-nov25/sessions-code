<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', config('app.name'))</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">


</head>

<body class="bg-light d-flex flex-column min-vh-100">

    @include('partials.navbar')

    <main class="flex-fill py-4">
        <div class="container">
            @yield('content')
        </div>
    </main>



    @include('partials.footer')
    @include('partials.firebase')

</body>

</html>
