<?php
namespace app\controller;

use app\core\TableRegistry;

class PostsController extends AppController
{
    public function index()
    {
        $posts = $this->Posts->findAll();

        $this->view->set('posts', $posts);
    }

    public function view($id)
    {
        $post = $this->Posts->get($id);

        if (empty($post)) {
            throw new \Exception('Post Not Found');
        }

        if ($this->request->isPost()) { // New Comment
            $comment = TableRegistry::get('Comments')->newEntity([
                'post_id' => $id,
                'user_id' => empty($this->loggedUser) ? 0 : $this->loggedUser['id'],
                'content' => $this->request->data('comment')
            ]);

            TableRegistry::get('Comments')->save($comment);
        }

        $post->comments = TableRegistry::get('Comments')->findByPostId($id);

        $this->view->set('post', $post);
    }

    public function add()
    {
        if (empty($this->loggedUser)) {
            throw new \Exception('Only logged users can do it!');
        }

        $post = $this->Posts->newEntity();

        if ($this->request->isPost()) {
            $this->Posts->patchEntity($post, $this->request->getData());

            $this->Posts->validate($post);

            if (!$post->hasErrors()) {
                $post->user_id = $this->loggedUser['id'];
                $this->Posts->save($post);

                $this->redirect();
            }
        }

        $this->view->set('post', $post);
    }
}
