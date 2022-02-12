<?php
namespace Base;

use App\Model\User;

/**
 * Class View
 * @package Base
 *
 */
abstract class View
{

    /** @var \Twig\Environment */
    protected $_twig;

    protected string $templatePath = '';
    protected array $data = [];

    public function __construct()
    {
        $this->templatePath = PROJECT_ROOT_DIR . DIRECTORY_SEPARATOR . 'app/View';
    }

    public function getTwig(): \Twig\Environment
    {
        if (!$this->_twig) {
            $path = $this->templatePath . DIRECTORY_SEPARATOR;
            $loader = new \Twig\Loader\FilesystemLoader($path);
            $this->_twig = new \Twig\Environment(
                $loader
//                ['cache' => $path . '_cache', 'autoescape' => false]
            );
        }

        return $this->_twig;
    }

    public function assign(string $name, $value)
    {
        $this->data[$name] = $value;
    }

    public function render(string $tpl, $data = []): string
    {

    }

    public function __get($varName)
    {
        return $this->data[$varName] ?? null;
    }
}