<?php

namespace Core;

/**
 * Router
 * PHP version 8.1
 */
class Router {
  /**
   * Associative array of routes (the routing table)
   * @var array
   */
  protected $routes = [];

  /**
   * Parameters from the matched route
   * @var array
   */
  protected $params = [];

  /**
   * Add a route to the routing table
   * 
   * @param string $route The route URL
   * @param array $params Parameters (controller, action, ect..)
   */
  public function add($route, $params = []) {
    // Convert the route to a regular expression escape forward slashes
    $route = preg_replace("/\//", "\\/", $route);

    // Convert variables e.g. {controller}
    $route = preg_replace("/\{([a-z]+)\}/", "(?<\\1>[a-z-]+)", $route);

    // Convert variables with custom regular expresions e.g. {id:\d+}
    $route = preg_replace("/\{([a-z]+):([^\}]+)\}/", "(?<\\1>\\2)", $route);

    // Add start and end delimiters, and case insensitive flag
    $route = "/^" . $route . "$/i";

    $this->routes[$route] = $params;
   
  }

  /**
   * Get all the routes from the routing table
   * 
   * @return array
   */
  public function getRoutes() {
    return $this->routes;
  }

  /**
   * Match the route to the routes in 
   * the routing table, setting the params
   * property if a route is found
   * 
   * @param string $url The route URL
   * 
   * @return boolean true if a match is found, false otherwise
   */
  public function match($url) {
    /*
    foreach ($this->routes as $route => $params) {
      if ($url === $route) {
        $this->params = $params;
        return true;
      }
    }
    return false;
    */
    // Match to the fixed URL format /controller/action
    // $reg_exp = "/^(?P<controller>[a-z-]+)\/(?P<action>[a-zA-Z-]+)/";
    foreach ($this->routes as $route => $parameters) {
      if (preg_match($route, $url, $matches)) {
        // Get the named capture group values
        $params = [];
        
        foreach ($matches as $key => $match) {
          if (is_string($key)) {
            $parameters[$key] = $match;
          }
        }
        $this->params = $parameters;
        return true;
      }
    }
    return false;
  }

  /**
   * Get the currently matched parameters
   * 
   * @return array
   */
  public function getParams() {
    return $this->params;
  }

  /**
   * Dispatch the the given string and try to execute on the controller class,
   * the action method
   * 
   * @param string $url The route URL
   * 
   * @return void
   */
  public function dispatch($url) {
    $url = $this->removeQueryStringVariables($url);
    if ($this->match($url)) {
      $controller = $this->params['controller'];
      $controller = $this->convertToStudlyCaps($controller);
      // $controller = "App\Controllers\\$controller";
      $controller = $this->getNamespace() . $controller . 'Controller';

      if (class_exists($controller)) {
        $controller_object = new $controller($this->params);

        $action = $this->params['action'];
        $action = $this->convertToCamelCase($action);

        if (is_callable([$controller_object, $action])) {
          $controller_object->$action();
        } else {
          echo "Method $action (in controller $controller) not found";
        }
      } else {
        echo "Controller class $controller not found.";
      }
    } else {
      require "../Logs/404.php";
      // echo "No route matched";
    }
  }

  /**
   * Convert the string with hyphens to StudlyCaps.
   * e.g. post-authors => PostAuthors
   * 
   * @param string $string The string to convert
   * 
   * @return string
   */
  public function convertToStudlyCaps($string) {
    return str_replace(" ", "", ucwords(str_replace("-", " ", $string)));
  }

  /**
   * Convert the string with hyphens to camelCase.
   * e.g. add-new => addNew
   * 
   * @param string $string The string to convert
   * 
   * @return string
   */
  public function convertToCamelCase($string) { {
      return lcfirst($this->convertToStudlyCaps($string));
    }
  }

  /**
   * A URL of the format localhost/?page (one variable name, no value) won't
   * work however. (NB: The .htaccess file converts the first ? to a & when 
   * it's passed through to the $_SERVER variable).
   * 
   * @param string $url The full URL
   * 
   * @return string The URL with the query string variables removed
   */
  protected function removeQueryStringVariables($url) {
    if ($url !== "") {
      $parts = explode("&", $url, 2);

      if (strpos($parts[0], "=") === false) {
        $url = $parts[0];
      } else {
        $url = "";
      }
    }
    return $url;
  }

  /**
   * Get the namespace for the controller class.
   * The namespace defined in the route parameters is added if present.
   * 
   * @return string The request URL
   */
  protected function getNamespace() {
    $namespace = "App\Controllers\\";

    if (array_key_exists("namespace", $this->params)) {
      $namespace .= $this->params["namespace"] . "\\";
    }

    return $namespace;
  }
}
