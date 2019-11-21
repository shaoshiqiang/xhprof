<?php
$server = $_SERVER;

if (strpos($server['SERVER_NAME'], 'xhprof') === false) {
    include_once "/Users/shaoshiqiang/WWW/xhprof/xhprof_lib/utils/xhprof_lib.php";
    include_once "/Users/shaoshiqiang/WWW/xhprof/xhprof_lib/utils/xhprof_runs.php";
    xhprof_enable();
    //在程序结束后收集数据
    register_shutdown_function(function ($server) {
        $xhprof_data = xhprof_disable();

        //让数据收集程序在后台运行
        //        if (function_exists('fastcgi_finish_request')) {
        //            fastcgi_finish_request();
        //        }

        //实例化xhprof类
        $xhprof_runs = new XHProfRuns_Default();
        //获取当前当前页面分析结果
        $xhprof_runs->save_run($xhprof_data, str_replace('.', '_', $server['SERVER_NAME']));
    }, $server);
}