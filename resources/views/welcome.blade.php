<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @if (Auth::check())
            <a href="{{route('home')}}">{{auth()->user()->name}}</a>
    @else

        <a href="{{route('login')}}">login</a>
        <a href="{{route('register')}}">register</a>
    @endif
</body>
</html>
