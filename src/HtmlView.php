<?php

namespace Base;

class HtmlView extends View
{
    public function render(string $tpl, $data = []): string
    {
        $this->data += $data;
        foreach ($data as $key => $value) {
            $this->data[$key] = $value;
        }
        ob_start();
        include $this->templatePath . DIRECTORY_SEPARATOR . $tpl . ".phtml";
        return ob_get_clean();
    }
}