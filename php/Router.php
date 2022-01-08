<?php

class Router
{
    public static function get($app_route, $app_callback)
    {
        if ( strcasecmp($_SERVER['REQUEST_METHOD'], 'GET') !== 0 ) {
            return;
        }

        self::on($app_route, $app_callback);
    }

    public static function post($app_route, $app_callback)
    {
        if ( strcasecmp($_SERVER['REQUEST_METHOD'], 'POST') !== 0 ) {
            return;
        }

        self::on($app_route, $app_callback);
    }

    public static function on($exprr, $call_back)
    {
        $paramtrs = $_SERVER['REQUEST_URI'];
        $paramtrs = (stripos($paramtrs, "/") !== 0) ? "/".$paramtrs : $paramtrs;
        $exprr    = str_replace('/', '\/', $exprr);
        $matched  = preg_match('/^'.($exprr).'$/', $paramtrs, $is_matched, PREG_OFFSET_CAPTURE);

        if ( $matched ) {
            array_shift($is_matched);
            $paramtrs = array_map(function ($paramtr) {
                return $paramtr[0];
            }, $is_matched);

            $call_back($paramtrs);
        }
    }
}
