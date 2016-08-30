<?php

namespace App\Controllers;

use Phalcon\Mvc\Controller;

class IndexController extends Controller
{
    public function indexAction()
    {
        // 这里访问视图文件：~/app_view/index.phtml << ~/app_view/Index/index.phtml
    }

    public function notFoundAction()
    {
        header('HTTP/1.1 404 not found');
        return "404 not found!";
    }
}
