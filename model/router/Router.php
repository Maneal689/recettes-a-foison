<?php

namespace App\Router;

require_once("model/router/RouterException.php");
require_once("model/router/Route.php");

class Router
{
  private $url;
  private $routes = [];

  public function __construct($url)
  {
    $this->url = $url;
  }

  public function run()
  {
    $method = $_SERVER["REQUEST_METHOD"];
    if (!isset($this->routes[$method]))
      throw new RouterException("Request method doesn't exist");
    foreach ($this->routes[$method] as $route) {
      if ($route->match($this->url)) {
        return $route->call();
      }
    }
    echo "url: $this->url<br>";
    throw new RouterException("No matching route");
  }

  public function get($path, $callback)
  {
    $route = new Route($path, $callback);
    $this->routes["GET"][] = $route;
    return $route;
  }
  public function post($path, $callback)
  {
    $route = new Route($path, $callback);
    $this->routes["POST"][] = $route;
    return $route;
  }
  public function all($path, $callback)
  {
    $route = new Route($path, $callback);
    $this->routes["POST"][] = $route;
    $this->routes["GET"][] = $route;
    return $route;
  }
}
