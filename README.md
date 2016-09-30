# QPhalcon Framework (q-phalcon)


[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Total Downloads][ico-downloads]][link-downloads]


**Note:** ```PHP``` ```Phalcon``` ```Framework```



# 欢迎使用Qphalcon框架，我将带你一起了解它！

　　现在是2016年！互联网敏捷开发时代~~~

　　QPhalcon以下简称QP！它是一个基于Phalcon封装的高性能PHP框架！
关注过Phalcon的同学都知道，Phalcon堪称是世界上最快的PHP框架，没有之一！

　　笔者利用PHP语言的简单和敏捷开发特性、结合phalcon带来的性能优势和强大的API文档社区特性，
封装了一套适应目前主流BS架构的PHP框架——QP！

　　Phalcon其实只是PHP的一个C扩展，在windows下，它是一个.dll文件！
虽然它不强制约束项目结构，但对于团队配合开发来说，没有规范，不成方圆！
笔者经过不断的提升自己对编程和设计思想的理解，不断的在开发实践中总结优雅的代码，成功完成QP框架的开发！
制定出一个简单的框架，让开发人员关注的事情极大减少，真正实现敏捷开发！

　　关于项目配置、日志、异常处理、请求参数、响应、会话、常用工具...这些只需要简单的一两行代码就能搞定！
你只需要把重点放在阅读phalcon官网的model和PDO上即可完成大部分的任务！
如果遇到困难，你可以查阅QP或phalcon的官方文档和论坛，我相信任何问题都能解决！


## QP只有三个关键字：简洁易懂、敏捷开发、性能

以下是QP的特性：

### 1. 使用Composer添加第三方组件
　　编辑~/composer.json，根据composer工具轻松加入任何第三方组件！

```php
    "require": {
        "q-phalcon/kernel": "0.1.0",
        "yunhack/php-validator": "0.0.1"
    }
```

### 2. 路由简单，支持模块化开发和中间件
　　QP的路由既灵活又简单！支持三段：modules/controller/action，其中最后一段action是方法，倒数第二段controller是控制器，
剩余的是模块，模块可以又分为N段，建议分三段即可！

　　如下是模块化开发的例子：foo模块的路由文件被指定到任意路径！
　　
```php
    Router::modules([
        'foo' => 'app/Modules/Tome/_routers.php'
    ]);
    
    Router::set([
        "controllers"   => [
            'user' => 'User',
        ],
        "namespace" => "Foo",
        "middlewares" => ["SessionCheck"]
    ]);
```

### 3. 增强Phalcon的异常处理，调试起来更加容易定位问题

　　警告级别的异常也会被抛出，目的是争取在测试阶段就发现潜在的危机，并解决它！坚持认真对待每一个潜在的错误！

### 4. 标准化日志风格和内容、让排错变得更简单

　　日志统一存放在~logs目录下，支持复杂项目中日志的分模块需求！并且支持占位符替换！
　　
```php
    Log::info('my name is {name}', ['name' => 'Qvil'], true, 'test-module');
    
    //日志文件：~/logs/test-module/2016-08-30_info.log
    //内容：[2016-08-30 20:53:08] [127.0.0.1] [router : /] 【my name is Qvil】
```

### 5. 配置简单

　　使用全局函数 config() 即可优先从本地.php配置文件从读取参数;

　　本地配置文件：~/.php (相当于Laravel框架中的 ~/.env)

　　生产配置文件目录：~/config
　　
```php
    $host = config('database.default.host');
```

### 6. 数据库连接

　　支持多个数据库连接，返回Phalcon的PDO对象，操作数据库变得非常简单！

```php
    $conn = \Qp\Kernel\DB::connection('db');
```

### 7. 读取会话

　　QP强力推荐Redis作为会话存储介质！当然Phalcon本身支持的数据库和缓存是非常丰富的！

```php
    $user_name = \Qp\Kernel\Session::get('user_name');
```

### 8. 第三方组件 PHPValidator

```php
    Validator::make([$param,
        'age' => 'present|integer_str|between:18,30|to_type:integer'
    ]);
```
　　QP使用第三方组件作为请求参数校验的极力工具：yunhack/php-validator

　　以上校验age参数：必传、整数格式的字符串、值在18-30之间，校验通过后，$param['age']将自动转成整数类型！
　　
### 9. 请求响应

```php
    $request = \Qp\Kernel\Request::request();

    $response = \Qp\Kernel\Response::response();
    $response->setContentType('application/json');
    
```

### 10. 定时任务

　　在~/app/Task/QpTaskController.php文件的kernelAction()方法中，定义了定时任务代码，您可以这样使用：

```php
    Task::call('T1', function (){
        //任务代码;
    })->everyMinute();
```

　　其中T1是任务编号。Qp框架在设计定时任务的时候，考虑到：如果您的“任务代码”执行时间超过一分钟的话，可能会导致不可预期的BUG。因此加入任务编号的概念，将任务状态写到Redis中(至此，我们强烈要求使用Redis)

　　Task::call方法呼叫一个任务，任务的执行时间，目前有如下几种：
 - 每分钟
 - 每5分钟
 - 每小时
 - 每天
 - 每个月
 - 每天的指定时间点
 
 　　当然，设置完“任务代码”后，你需要启动任务！原理是在执行Qp根目录下的 task_refresh.php文件，代码如下：
```php
    php task_refresh.php
```

 　　这样就可以把任务刷新(切记，以后修改完任务，特别是修改任务的执行周期和新增任务后，一定要调用此文件，刷新任务列表)

 　　接下来就是执行任务了，方法就是利用外部循环，1分钟调一次Qp根目录下的 task.php文件，利用Linux系统的crontab指令轻松实现哦！

### 至此：

　　QP适合BS架构，需要敏捷开发的小型Web项目！
当然用只要composer存在，任何功能都不是问题，但是默认的QP非常简洁轻巧，只有100KB左右哦，但是功能已经完全足够写一个博客系统了！

　　在QP框架中，您可以阅读QP基础文档，而在实践开发中，您依然需要翻阅大量Phalcon官方文档和活跃在Phalcon社区！

### 不足之处：

　　用户自定义异常处理，需要用户自己编写和设计！

　　如果你发现框架存在BUG，请致邮箱：339799232@qq.com


### 阿里云1和1G性能测试结果(使用QP，完全不用担心PHP的性能问题了)

　　读2次mysql小表、写1次redis、读1次redis、写一次文件日志、写1次mysql：100并发压力下，平均24毫秒一个请求

　　同Laravel相对比，针对60万数据量的表进行查询操作，laravel的model需要800毫秒，而QP无论是否命中缓存，只需要200毫秒，几乎所有耗时都集中在数据库那一层了
　
　　

　　

　　


# Install

### 1. 下载q-phalcon框架
　　使用Composer工具安装项目，关于composer的用法，请自行学习！

```php
    composer create-project q-phalcon/q-phalcon
```

### 2. 需要的环境

　　需要 php >= 7.0

　　需要 phalcon扩展：[install phalcon][link-Download_Phalcon]

　　强烈建议使用redis作为会话驱动方式！安装 redis-server：[Download Redis for linux][link-Download_Redis]

　　因此，同时需要redis扩展

### 3. 配置

　　修改php.ini文件中：session.serialize\_handler = php\_serialize (否则无法使用Session::getAll方法)

　　当然别忘记在php.ini中添加 phalcon和redis扩展哦~~~

# License

　　The MIT License (MIT). Please see [License File](LICENSE.md) for more information.


[ico-version]: https://img.shields.io/packagist/v/q-phalcon/q-phalcon.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/q-phalcon/q-phalcon.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/q-phalcon/q-phalcon
[link-downloads]: https://packagist.org/packages/q-phalcon/q-phalcon
[link-Download_Phalcon]: https://phalconphp.com/en/download
[link-Download_Redis]: http://redis.io/download
