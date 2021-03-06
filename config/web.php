<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'modules' => [
        'admin' => [
            'class' => 'app\modules\admin\Admin',
        ],
    ],
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'defaultRoute'=>'blog',//修改默认控制器
    'components' => [
        'urlManager' => [
                'class' => 'yii\web\UrlManager',
                'enablePrettyUrl' => true,
                'showScriptName' => false,
                'suffix'=>'.html',
                //'enableStrictParsing' => true,
                'rules' => [
                    [
                        'pattern'=>'article',
                        'route'=>'article/detail',
                        'suffix'=>'.html'
                    ],
                    [
                        'pattern'=>'category',
                        'route'=>'blog/list',
                        'suffix'=>'.html'
                    ],
                    [
                        'pattern'=>'feed',
                        'route'=>'blog/feed',
                        'suffix'=>'.xml'
                    ],
                    [
                        'pattern'=>'tag',
                        'route'=>'blog/tag',
                        'suffix'=>'.html'
                    ],
                    'msg' => 'blog/msg', 
                    '<module:admin>/<controller:log>/<action:captcha>'=>'<module>/<controller>/<action>',
                ],
            ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'zhenbianshu',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'blog/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
