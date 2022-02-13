<?php

namespace App\Controller;

use Base\AbstractController;
use App\Model\Message;
use Base\View;

class Blog extends AbstractController
{
    public function index(): string
    {
        if (!$this->getUser()) {
            $this->redirect('/');
        }
        $messages = Message::getList();

        return $this->view->render('Blog\messages', [
            'messages' => $messages,
            'user' => $this->getUser()
        ]);
    }

    public function addMessage()
    {
        if (!$this->getUser()) {
            $this->redirect('/');
        }

        $text = (string) $_POST['text'];

        $message = new Message([
            'text' => $text,
            'author_id' => $this->user->getId()
        ]);

        if (isset($_FILES['image']['tmp_name'])) {
            $message->loadFile($_FILES['image']['tmp_name']);
        }

        $message->save();
        $this->redirect('/blog');

    }
}