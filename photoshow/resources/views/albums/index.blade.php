@extends('layouts.app')


@section('content')
@if(count($albums)>0)
<?php
$colcount=count($albums);
$i=1;
?>
<div id="albums">
    <div class="row text-center">
        @foreach ($albums as $album)
        @if($i == $colcount)
        <div class='medium-4 columns end'>
            <a href="/albums/{{$album->id}}">
            <img class="thumbnail" src="storage/album_covers/{{$album->cover_image}}" alt="{{$album->name}}" height="300px" width="300px">
                </a>
                <br>
                <h4>{{$album->name}}</h4>
                {!!Form::open(['action'=>['AlbumsController@destroy',$album->id],'method'=>'POST','onsubmit'=>'return functiona()'])!!}
                {{Form::hidden('_method','DELETE')}}
                {{Form::submit('Delete Album',['class'=>'button alert'])}}
                {!!Form::close()!!}
                @else
                <div class="medium-4 columns">
                <a href="/albums/{{$album->id}}">
                <img class="thumbnail" src="storage/album_covers/{{$album->cover_image}}" alt="{{$album->name}}" height="300px" width="300px">
                </a>
                <br>
                <h4>{{$album->name}}</h4>
                {!!Form::open(['action'=>['AlbumsController@destroy',$album->id],'method'=>'POST','onsubmit'=>'return functiona()'])!!}
                {{Form::hidden('_method','DELETE')}}
                {{Form::submit('Delete Album',['class'=>'button alert'])}}
                {!!Form::close()!!}
                @endif
            @if($i % 3==0)
            </div></div><div class="row text-center">
                @else
            </div>
            @endif
            <?php
             $i++;
            ?>
            @endforeach
        </div>
</div>
@else
<p>NO ALBUMS TO DISPLAY</p>
@endif
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