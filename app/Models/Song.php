<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $title
 * @property string $artist
 * @property string $url
 */
class Song extends Model
{


    use HasFactory;

    public const BASE_UG_SEARCH_URL = 'https://www.ultimate-guitar.com/search.php?search_type=title&value=';

    public function playlist(): Model | BelongsTo | null
    {
        return $this->belongsTo(Playlist::class)->first();
    }

    public function url(): string
    {
        return self::BASE_UG_SEARCH_URL . rawurlencode(
                sprintf('%s %s', $this->title, $this->artist)
            );
    }
}
