<?php

namespace App\Data\Spotify\PlaylistData;

use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;

class PlaylistData extends Data
{
    public function __construct(
        #[MapInputName('name')]
        public string $title,
        public string $description,
    )
    {}
}