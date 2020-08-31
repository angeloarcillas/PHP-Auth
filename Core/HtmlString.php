<?php
namespace Core;

class HtmlString
{
    public $html;

    public function __construct($html = '')
    {
        $this->html = $html;
    }

    public function __toString()
    {
        return $this->html;
    }

    public function isEmpty()
    {
        return $this->html === '';
    }
}
