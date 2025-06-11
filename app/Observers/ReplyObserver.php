<?php

namespace App\Observers;

use App\Models\Reply;

class ReplyObserver
{
    /**
     * Handle the Reply "created" event.
     *
     * @param Reply $reply
     * @return void
     */
    public function created(Reply $reply): void
    {
        $reply->topic->reply_count = $reply->topic->replies()->count();
        $reply->topic->save();
    }

    /**
     * Handle the Reply "creating" event.
     *
     * This method is called before a reply is created.
     * It sanitizes the content of the reply to prevent XSS attacks.
     *
     * @param Reply $reply
     * @return void
     */
    public function creating(Reply $reply): void
    {
        $reply->content = clean($reply->content, 'user_topic_body');
    }
}
