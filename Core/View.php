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
    

    // print_r($args);
    // exit();
    $file = "../App/views/User/$view"; // relative to Core directory
    $adminFile = "../App/views/Admin/$view"; // relative to Core directory
    $notFound = "../Logs/404.php"; //relative to not found page
 
    if (is_readable($file)) {
      require $file;
    } 
    else if (is_readable($adminFile)) {
      require $adminFile;
    }
    else {
      require $notFound;
    }
  }
}