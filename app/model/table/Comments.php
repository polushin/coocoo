<?php

namespace app\model\table;

use app\core\Table;
use app\core\TableRegistry;

class Comments extends Table
{
    protected $fields = [
        'id' => 'integer',
        'post_id' => 'integer',
        'user_id' => 'integer',
        'content' => 'string',
        'created' => 'datetime',
    ];


    public function findByPostId($postId)
    {
        $stmt = $this->db->prepare('SELECT comments.id AS comment_id, users.id AS user_id, comments.*, users.* FROM `comments` LEFT JOIN `users` ON `comments`.`user_id`=`users`.`id` WHERE post_id=:postId ORDER BY `created` DESC');
        $stmt->execute(['postId' => $postId]);
        $rows = $stmt->fetchAll();
        $comments = [];
        foreach($rows as $row) {
            $comment = $this->newEntity($row, true);
            if ($row['user_id']) {
                $author = TableRegistry::get('Users')->newEntity($row, true);
                $author->id = $comment->user_id;
            } else {
                $author = null;
            }

            $comment->author = $author;
            $comment->id = $row['comment_id'];
            $comments[] = $comment;
        }

        return $comments;
    }
}
