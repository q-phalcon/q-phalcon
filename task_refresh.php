<?php

//自动加载
require __DIR__ . "/bootstrap/autoload.php";

//启动并执行请求
(new \Qp\Kernel\Main())->task_refresh();