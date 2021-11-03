<?php

namespace app\routes;

class UserRoute
{
    public $getRoutes;
    public $postRoutes;

    public function get($url, $fn)
    {
        $this->getRoutes[$url] = $fn;
    }

    public function post($url, $fn)
    {
        $this->postRoutes[$url] = $fn;
    }

    public function run()
    {

        $method = $_SERVER['REQUEST_METHOD'];
        $route = $_SERVER['PATH_INFO'];
        $fn = null;

        if ($method === 'GET') {
            $fn = $this->getRoutes[$route];

        } else {
            $fn = $this->postRoutes[$route];
        }

        call_user_func($fn);

    }

}