<?php
namespace Core;

/**
 * View
 * 
 * PHP version 8.1
 */
class View {
  /**
   * Render a view file
   * 
   * @param string $view The view file
   * 
   * @return void
   */
  public static function render($view, $args = []) {
    extract($args, EXTR_SKIP);
    
    $file = "../App/views/User/$view"; // relative to Core directory
 
    if (is_readable($file)) {
      require $file;
    } else {
      echo "$file not found";
    }
  }
}