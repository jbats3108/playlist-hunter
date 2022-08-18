<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    use HasFactory;

    const BASE_URL = 'https://www.ultimate-guitar.com/search.php?search_type=title&value=';

    public function playlist()
    {
        return $this->belongsTo(Playlist::class)->first();
    }

    public function url()
    {
        return self::BASE_URL . rawurlencode(
                sprintf('%s %s', $this->title, $this->artist)
            );
    }
}
