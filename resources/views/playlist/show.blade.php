{{$playlist->title}}

@foreach($playlist->songs()->get() as $song)
    {{$song->title}} by {{ $song->artist }} : {{$song->url()}}
@endforeach
