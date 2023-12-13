<?php

namespace App\Listeners;

use App\Models\Post;
use App\Models\User;
use App\Notifications\NewComment;
use App\Events\CommentCreated;
use Illuminate\Contracts\Queue\Queue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendCommentCreatedNotifications implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(CommentCreated $event): void
    {
        $post = Post::query()->where('id',$event->comment->post_id)->first();
        $user = User::where('id', $post->author_id)->first();
//        dd($user);
        $user->notify(new NewComment($event->comment));
    }
}
