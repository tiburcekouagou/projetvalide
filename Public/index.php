<?php  
/**
 * Front Controller
 * 
 * PHP version 8.1
 */

// Require the controller class
// require "../app/Controller/Posts.php";

/**
 * Autoloader
 */
spl_autoload_register(function ($class) {
  $root = dirname(__DIR__); // get the parent directory
  $file = $root . "/" . str_replace("\\", "/", $class) . ".php";

  if (is_readable($file)) {
    require $root . "/" . str_replace("\\", "/", $class) . ".php";
  }
});

//  echo 'Requested URL = "' . $_SERVER['QUERY_STRING'] . '"';
/**
 * Routing
 */
require "../core/Router.php";
$router = new Core\Router();

// echo get_class($router);

// Add the routes
$router->add('', ['controller' => 'Route', 'action' => 'home']);
$router->add('about', ['controller' => 'Route', 'action' => 'about']);
$router->add('shop', ['controller' => 'Route', 'action' => 'shop']);
$router->add('orders', ['controller' => 'Route', 'action' => 'orders']);
$router->add('about', ['controller' => 'Route', 'action' => 'about']);
$router->add('category', ['controller' => 'Route', 'action' => 'category']);
$router->add('contact', ['controller' => 'Route', 'action' => 'contact']);
$router->add('search', ['controller' => 'Route', 'action' => 'search']);
$router->add('wishlist', ['controller' => 'Route', 'action' => 'wishlist']);
$router->add('card', ['controller' => 'Route', 'action' => 'card']);
$router->add('checkout', ['controller' => 'Route', 'action' => 'checkout']);
$router->add('login', ['controller' => 'Route', 'action' => 'login']);
$router->add('register', ['controller' => 'Route', 'action' => 'register']);
$router->add('logout', ['controller' => 'Route', 'action' => 'logout']);
$router->add('update', ['controller' => 'Route', 'action' => 'update']);

$router->add('posts/new', ['controller' => 'Posts', 'action' => 'new']);
$router->add('{controller}/{action}');
$router->add("{controller}/{id:\d+}/{action}");
$router->add("admin/{controller}/{action}", ["namespace" => "Admin"]);

// Display the routing table
// echo '<pre>';
// var_dump($router->getRoutes());
// echo $_SERVER['QUERY_STRING'];
// echo htmlspecialchars(print_r($router->getRoutes(), true));
// echo '</pre>';
// exit();

// Match the requested route
$url = $_SERVER['QUERY_STRING'];
// echo 'url =>' . $url;
// exit();


// if ($router->match($url)) {
//   var_dump($router->getParams());
// } else {
//   echo "No route found for URL '$url'";
// }

$router->dispatch($_SERVER["QUERY_STRING"]);
