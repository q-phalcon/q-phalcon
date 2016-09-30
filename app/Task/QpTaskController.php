<?php

namespace App\Task;

use Qp\Kernel\Task;
use Phalcon\Mvc\Controller;

class QpTaskController extends Controller
{
    public function kernelAction()
    {
        Task::call('T1', function (){
            echo "~~~~~~hello world~~~~\r\n";
        })->everyMinute();
    }
}
