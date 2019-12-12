<ul>
@foreach ($photos as $photo)
<li>{{$photo->id}} {{$photo->title}}</li>
@endforeach
