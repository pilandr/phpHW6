<?php

namespace Base;

class TwigView extends View
{
    public function render(string $tpl, $data = []): string
    {
                $twig = $this->getTwig();
                ob_start(null, PHP_OUTPUT_HANDLER_STDFLAGS);
                try {

                    $this->data += $data;
                    echo $twig->render($tpl . '.twig', $this->data);
                } catch (\Exception $e) {
                    trigger_error($e->getMessage());
                }
                return ob_get_clean();
    }

}