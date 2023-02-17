<?php

use App\Kernel;

require_once dirname(__DIR__) . '/vendor/autoload_runtime.php';


return function (array $context) {
    if ($context['APP_DEBUG']) {
        header('Access-Control-Allow-Origin:' . rtrim($context['HTTP_REFERER'], '/'));
    } else {
        header('Access-Control-Allow-Origin:www.hikamsm.com');
    }
    header('Access-Control-Allow-Headers:*');
    header('Access-Control-Allow-Credentials:true');
    header('Access-Control-Allow-Headers:X-Requested-With, Content-Type, withCredentials');
    if ($context['REQUEST_METHOD'] === 'OPTIONS') {
        die();
    }
    return new Kernel($context['APP_ENV'], (bool) $context['APP_DEBUG']);
};
