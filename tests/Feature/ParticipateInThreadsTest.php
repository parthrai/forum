<?php
namespace Tests\Feature;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
class ParticipateInThreadsTest extends TestCase
{
    use DatabaseMigrations;
    /** @test */



    function unauthenticated_users_may_not_add_replies()
    {
        $this->expectException('Illuminate\Auth\AuthenticationException');
        $this->post('/threads/some-channel/1/replies', []);
    }
    /** @test */
    function an_authenticated_user_may_participate_in_forum_threads()
    {
        $this->be($user = factory('App\User')->create());
        $thread = factory('App\Thread')->create();
        $reply = factory('App\Reply')->make();
        $this->post($thread->path() . '/replies', $reply->toArray());
        $this->get($thread->path())->assertSee($reply->body);
    }

    function test_a_reply_requires_a_body(){
        $this->expectException('Illuminate\Validation\ValidationException');
        $this->signIn();
        $thread = create('App\Thread');
        $reply = make('App\Reply',['body'=>null]);
        $this->post($thread->path().'/replies',$reply->toArray())
            ->assertSessionHasErrors('body');

    }
}