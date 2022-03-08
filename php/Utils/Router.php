<?php

/**
 *
 */
class Router
{
    /**
     * @param $app_route
     * @param $app_callback
     *
     * @return void
     */
    public static function get($app_route, $app_callback)
    {
        if ( strcasecmp($_SERVER['REQUEST_METHOD'], 'GET') !== 0 ) {
            return;
        }

        self::on($app_route, $app_callback);
    }

    /**
     * @param $app_route
     * @param $app_callback
     *
     * @return void
     */
    public static function post($app_route, $app_callback)
    {
        if ( strcasecmp($_SERVER['REQUEST_METHOD'], 'POST') !== 0 ) {
            return;
        }

        self::on($app_route, $app_callback);
    }

    /**
     * @param $expression
     * @param $call_back
     *
     * @return void
     */
    public static function on($expression, $call_back)
    {
        $parameters = $_SERVER['REQUEST_URI'];
        $parameters = (stripos($parameters, "/") !== 0) ? "/".$parameters : $parameters;
        $expression = str_replace('/', '\/', $expression);
        $matched    = preg_match('/^'.($expression).'$/', $parameters, $is_matched, PREG_OFFSET_CAPTURE);

        if ( $matched ) {
            array_shift($is_matched);
            $parameters = array_map(function ($paramtr) {
                return $paramtr[0];
            }, $is_matched);

            $call_back($parameters);
        }
    }
}
