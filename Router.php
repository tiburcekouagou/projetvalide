<?php
    class Router {
        /**L'ensemble des route de l'application (La table des routes)
         * 
         * @var array
         */
        protected $routes = [];

        /**L'ensemble des paramètres de la route actuelle
         * 
         * @var array
         */
        protected $params = [];

        /**Permet d'ajouter une route à la table des routes
         * 
         * @param string $url l'url à ajouter
         * @param array $params L'ensemble des paramètres de la route
         * @return void
         */
        public function add($url, $params = []) {
            $route = preg_replace("#\/#", "\/", $url);

            $route = preg_replace("/\{([a-z-]+)\}/", "(?'\\1'[a-z-]+)", $route);

            $route = preg_replace("/\{([a-z-]+):([^\}]+)\}/", "(?'\\1'\\2)", $route);

            $route = "/^" . $route . "\$/i";

            $this->routes[$route] = $params;
        }

        /**Permet de matcher une route
         * 
         * @param string $url
         * @return boolean
         */
        public function match($url) {
            
                foreach ($this->routes as $route => $params) {
                    if(preg_match($route, $url, $matches)) {

                        foreach ($matches as $key => $match) {
                            if(is_string($key)) {
                                $params[$key] = $match;
                            }
                        }
                        $this->params = $params;
                        return true;
                    }
                }
                return false;
        }

        /**Renvoi toutes les routes
         * 
         * @return void
         */
        public function getRoutes() {
            return $this->routes;
        }

        /**Renvoi toutes les paramètres
         * 
         * @return void
         */
        public function getParams() {
            return $this->params;
        }

        public function converToPascalCase($str) {
            // return str_replace(' ', '', ucwords(str_replace('-', ' ', $str)));
            return preg_replace("/-/","", ucwords($str, "-"));
        }

        public function converToCamelCase($str) {
            return lcfirst($this->converToPascalCase($str));
        }

        /**Permet de matcher une route
         * 
         * @param string $url
         * @return string
         */
        public function dispatch($url) {
            if ($this->match($url)) {
               $controller = $this->params["controller"];
               $controller = $this->converToPascalCase($controller);

            if(class_exists($controller)) {
                $controller_objet = new $controller();
                $action = $this->converToCamelCase($this->params["action"]);
                if (method_exists($controller_objet, $action)) {
                    $controller_objet->$action();
                } else {
                    echo "Méthode \"$action\" inexistante dans le controlleur \"$controller\".";
                }
            } 
            else {
                echo "Class \"$controller\" inexistante";
            }
            } 
            else {
                echo "Route inexistante \"$url\"";
            }
        }
    }