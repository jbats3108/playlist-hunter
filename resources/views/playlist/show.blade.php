<?php

@foreach ($playlist as $song)
    {{$song->title}}
    {{$song->artist}}
@endforeach
