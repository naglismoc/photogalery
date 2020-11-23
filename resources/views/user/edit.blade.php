<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    {{-- <a href="{{route('user.store')}}">kazkas</a> --}}
    {{$user->name}}
    <form action="{{route('user.update',$user->id)}}" method="post" enctype="multipart/form-data">
        <input type="file" name="logo" >
        <button type="submit">prideti</button>
        @csrf
    </form>
</body>
</html>