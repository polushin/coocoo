<?php

namespace app\model\table;

use app\core\Table;
use app\core\TableRegistry;
use app\model\entity\Post;

class Posts extends Table
{
    protected $fields = [
        'id' => 'integer',
        'user_id' => 'integer',
        'title' => 'string',
        'content' => 'text',
        'created' => 'datetime'
    ];

    public function get($id)
    {
        $post = parent::get($id);
        if (empty($post)) {
            return null;
        }

        $post->author = TableRegistry::get('Users')->get($post->user_id);

        return $post;
    }

    public function findAll()
    {
        $rows = $this->db->query('SELECT posts.id AS post_id, posts.*, users.* FROM `posts` INNER JOIN `users` ON `posts`.`user_id`=`users`.`id` ORDER BY `created` DESC');
        $posts = [];
        foreach($rows as $row) {
            $post = $this->newEntity($row, true);

            $author = TableRegistry::get('Users')->newEntity($row, true);
            $author->id = $post->user_id;

            $post->author = $author;
            $post->id = $row['post_id'];
            $posts[] = $post;
        }

        return $posts;
    }


    public function validate(Post $post)
    {
        $title = $post->title;
        if (empty($title)) {
            $post->addError('title', 'Field can not be empty');
        }

        $content = $post->content;
        if (empty($content)) {
            $post->addError('content', 'Field can not be empty');
        }
    }


}