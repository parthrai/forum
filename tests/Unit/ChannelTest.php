<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ChannelTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    use DatabaseMigrations;

    public function test_a_channel_consists_of_threads()
    {
        $channel = create('App\Channel');
        $thread= create('App\Thread',['channel_id' => $channel->id]);
        $this->assertTrue($channel->threads->contains($thread));
    }
}
