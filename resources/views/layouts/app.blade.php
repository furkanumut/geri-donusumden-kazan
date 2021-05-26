<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Furkan Umut Ceylan') | Mersin Universitesi</title>
    @include('partials.style')
</head>
<body class="bg-light">
    @include('partials.header')

    @yield('content')

    @include('partials.footer')
    @include('partials.script')
</body>
</html>
