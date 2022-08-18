<?php

namespace Tests\Unit\Models;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class UserTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function it_has_a_spotify_id()
    {
        // Given
        $spotifyId = 'fooBar';

        // When
        $user = User::factory()->create(
            [
                'spotify_id' => $spotifyId
            ]
        );

        // Then
        $this->assertSame($spotifyId, $user->spotify_id);
    }
}
