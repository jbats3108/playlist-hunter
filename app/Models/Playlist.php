<?php

namespace App\Models;

use Database\Factories\PlaylistFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * App\Models\Playlist
 *
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string $title
 * @property-read Collection|Song[] $songs
 * @property-read int|null $songs_count
 * @method static PlaylistFactory factory(...$parameters)
 * @method static Builder|Playlist newModelQuery()
 * @method static Builder|Playlist newQuery()
 * @method static Builder|Playlist query()
 * @method static Builder|Playlist whereCreatedAt($value)
 * @method static Builder|Playlist whereId($value)
 * @method static Builder|Playlist whereTitle($value)
 * @method static Builder|Playlist whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Playlist extends Model
{
    use HasFactory;

    public function songs(): HasMany
    {
        return $this->hasMany(Song::class);
    }
}
