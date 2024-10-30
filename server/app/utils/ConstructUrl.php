<?php
class ConstructUrl
{
    protected $url;
    public function __construct(String $path)
    {
        $this->url = 'http://' . $_SERVER['HTTP_HOST'] . $path;
    }
    public function getUrl()
    {
        return $this->url;
    }
}
