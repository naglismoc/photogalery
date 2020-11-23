<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        a:hover {
            opacity: 0.5;
    }
    </style>
</head>

<body>
    @if(Auth::User()->logo)
  
    <img src="{{asset('img/'.Auth::User()->logo)}}"  alt="">
    @endif
    <br>
  
    @if(!Auth::User()->logo=="" || Auth::User()->logo!=null)
    <a href="{{route('user.edit',Auth::User()->id)}}">redaguoti logotipa |</a>
        <a href="{{route('user.deletePhoto')}}">Salinti nuotrauka</a>       
   @else
   <a href="{{route('user.edit',Auth::User()->id)}}">Prideti logotipa</a><br>
   @endif
   <form action="{{route('photo.store')}}" method="post" enctype="multipart/form-data">

    <input type="file" name="photos[]" multiple>
    @csrf
    <input type="submit">
    </form><br>

    @foreach (Auth::User()->photos as $photo)
    <a href="{{route('photo.deletePhoto',$photo->id)}}">
        <img src="{{asset('img/'.$photo->photo)}}"  alt="">
    </a>
    
    @endforeach
</body>
</html>