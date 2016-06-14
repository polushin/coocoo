<?php

namespace app\core;

class View
{
    private $layout = 'layout';
    private $prefix = 'app/templates/';

    private $data = [];

    public function set($name, $value)
    {
        $this->data[$name] = $value;
    }

    public function render($contentTemplate, $data = null)
    {
        if (is_array($this->data)) {
            extract($this->data);
        }

        if (is_array($data)) {
            extract($data);
        }

        $contentTemplate = $this->prefix . $contentTemplate . '.php';

        include $this->prefix . $this->layout.'.php';
    }

}