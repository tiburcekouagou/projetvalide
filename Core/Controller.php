<?php

namespace Core;

/**
 * Base controller
 * 
 * PHP version 5.4
 */
abstract class Controller
{
  /**
   * Parameters from the matched route
   * @var array
   */
  protected $route_params = [];

  /**
   * Class constructor
   * 
   * @param array $route_params Parameters from the route
   * 
   * @return void
   */
  public function __construct($route_params)
  {
    $this->route_params = $route_params;
  }

  /**
   * Magic method - called when a method is not matched | callable directly
   * 
   * @param string $name - The name of the method to be called
   * @param array $arguments - The arguments of the method
   * 
   * @return void
   */
  public function __call($name, $arguments)
  {
    $method = $name . "Action";

    if (method_exists($this, $method)) {
      if ($this->before() !== false) {
        call_user_func([$this, $method], $arguments);
        $this->after();
      }
    } else {
      echo "Method $method not found in controller " . get_class($this);
    }
  }

  /**
   * Before filter - called before an action method
   * 
   * @return void
   */
  protected function before()
  {
  }

  /**
   * After filter - called after an action method
   * 
   * @return void
   */
  protected function after()
  {
  }
}
