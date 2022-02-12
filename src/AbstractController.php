<?php
namespace Base;

use App\Model\User;

abstract class AbstractController
{
    /** @var View */
    protected View $view;
    /** @var User */
    protected User $user;

    protected function redirect(string $url)
    {
        throw new RedirectException($url);
    }

    public function setView(View $view): void
    {
        $this->view = $view;
    }

    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    public function getUser(): ?User
    {
        $userId = $_SESSION['id'] ?? false;
        if (!$userId) {
            return null;
        }

        $user = User::getById($userId);
        if (!$user) {
            return null;
        }

        return $user;
    }


}