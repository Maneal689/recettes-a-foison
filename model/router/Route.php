<?php

namespace App\Router;

class Route
{
  private $path;
  private $callback;

  public function __construct($path, $callback)
  {
    $this->path = trim($path, "/");
    $this->callback = $callback;
  }

  public function match($url)
  {
    $url = trim($url, "/");
    preg_match("#^([^?]*)#", $url, $matches);
    $url = $matches[1];
    return ($this->path === $url);
  }

  public function call()
  {
    call_user_func($this->callback);
  }
}
