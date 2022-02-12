<?php

namespace App\Controller;

use App\Model\Message;
use Base\AbstractController;

class Admin extends AbstractController
{

    public function deleteMessage()
    {
        if(!$this->getUser() || !$this->getUser()->isAdmin()) {
            $this->redirect('/');
        }
        $messageId = (int) $_GET['id'];

        Message::deleteMessage($messageId);
        $this->redirect('/blog');
    }
}