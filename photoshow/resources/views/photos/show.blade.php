@extends('layouts.app')

@section('content')
<h5>{{$photo->title}}<h5>
    <p>{{$photo->discription}}</p>
<a href="/albums/{{$photo->album_id}}">Back To Gallery</a>
<hr>
<img src="/storage/photos/{{$photo->album_id}}/{{$photo->photo}}" alt="{{$photo->title}}" hieght="600px" width="600px">
<br><br>
{!!Form::open(['action'=>['PhotosController@destroy',$photo->id],'method'=>'POST','onsubmit'=>'return functiona()'])!!}
{{Form::hidden('_method','DELETE')}}
{{Form::submit('Delete Photo',['class'=>'button alert'])}}
{!!Form::close()!!}
<hr>
<small>Size: {{$photo->size}}</small>
<script>
        function functiona()
        {
            x=confirm("Do You Want To Delete");
            if(x)
            return true;
            else
            return false;
        }
    </script>
@endsection