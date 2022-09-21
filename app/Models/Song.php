<?php

namespace App\Models;

use Database\Factories\SongFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\Song
 *
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int|null $playlist_id
 * @property string $title
 * @property string $artist
 * @method static SongFactory factory(...$parameters)
 * @method static Builder|Song newModelQuery()
 * @method static Builder|Song newQuery()
 * @method static Builder|Song query()
 * @method static Builder|Song whereCreatedAt($value)
 * @method static Builder|Song whereId($value)
 * @method static Builder|Song wherePlaylistId($value)
 * @method static Builder|Song whereTitle($value)
 * @method static Builder|Song whereUpdatedAt($value)
 * @mixin Eloquent
 * @method static Builder|Song whereArtist($value)
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
