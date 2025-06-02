<?php

namespace App\Observers;

use App\Models\Topic;

class TopicObserver
{
    /**
     * When a topic is being created or updated, generate an excerpt from the body.
     *
     * @param Topic $topic
     * @return void
     */
    public function saving(Topic $topic): void
    {
        // 过滤话题内容的特殊标签
        $topic->body = clean($topic->body, 'user_topic_body');

        // 生成摘要
        $topic->excerpt = make_excerpt($topic->body);

        // 如果没有 slug，则使用标题生成 slug
        // 我们按照查得的日本公司最常见的方式来处理 slug
        if (!$topic->slug) {
            $topic->slug = rawurlencode($topic->title);
        }
    }
}
