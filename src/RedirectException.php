<?php
namespace Base;

use JetBrains\PhpStorm\Pure;

class RedirectException extends \Exception
{
    private string $url;

    public function __construct(string $url)
    {
        parent::__construct();
        $this->url = $url;
    }

    public function getUrl(): string
    {
        return $this->url;
    }
}