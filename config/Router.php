<?php

namespace Config;

use AltoRouter;
use App\Repository\AboutRepository;
use Exception;
use App\View\Templates;

class Router
{
    public function __construct(private AltoRouter $router) {}

    /**
     * @throws Exception
     */
    public function get(string $route, string $file, string $name): void
    {
        $this->router->map('GET', $route, $file, $name);
    }

    /**
     * @throws Exception
     */
    public function post(string $route, string $file, string $name): void
    {
        $this->router->map('POST', $route, $file, $name);
    }

    /**
     * @throws Exception
     */
    public function dynamic(string $route, string $file, string $name): void
    {
        $this->router->map('GET|POST', $route, $file, $name);
    }

    /**
     * @throws Exception
     */
    public function run(): void
    {
        $match = $this->router->match();
        $router = $this->router;
        ob_start();
        if(is_array($match)) {
            $class = str_split($match['target'], strpos($match['target'], "::"));
            $function = str_replace("::", "", $class[1]);
            if (class_exists($class[0])) {
                $controller = new $class[0]($this->router);
                if(method_exists($class[0], $function)) {
                    if(isset($match["params"]) and !empty($match["params"])) {
                        $controller->$function($match["params"]);
                    } else {
                        $controller->$function();
                    }
                } else {
                    require dirname(__DIR__) . "/src/View/errors/404.php";
                }
            } else {
                require dirname(__DIR__) . "/src/View/errors/404.php";
            }
        } else {
            require dirname(__DIR__) . "/src/View/errors/404.php";
        }

        if ((!empty($class) && $class != "APIController") || empty($class)) {
            $content = ob_get_clean();
            $timetable = ((new AboutRepository())->getInfos())->getTimetable();
            (new Templates)->index($router, $content, $timetable);
        }
    }

    /**
     * @param string $routeName
     * @param array $params
     * @return string
     * @throws Exception
     */
    public function generate(string $routeName, array $params = []): string {
        return $this->router->generate($routeName, $params);
    }
}