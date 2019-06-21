<?php
namespace App;

/**
 * Class View
 * @package App
 *
 * @property string $param
 */
class View
{

    public $param;

    /**
     * @param string $template
     */
    public function display(string $template)
    {
        echo $this->render($template);
    }

    /**
     * @param string $template
     * @return string
     */
    public function render(string $template)
    {
        ob_start();

        include $template;

        $content = ob_get_contents();
        ob_end_clean();

        return $content;
    }

}