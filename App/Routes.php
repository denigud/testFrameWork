<?php

return [
    'home' => [
        'url'        => '/',
        'controller' => 'Index',
        'action'     => 'Index',
    ],
    'about' => [
        'url'        => 'About',
        'controller' => 'About',
        'action'     => 'Index',
    ],
    'page' => [
        'url'        => 'text?page={page}',
        'controller' => 'Text',
        'action'     => 'Index',
    ],
    'about-handle' => [
        'url'        => 'about-handle',
        'controller' => 'About',
        'action'     => 'Handle',
    ],
    '404' => [
        'url'        => 'page-not-found',
        'controller' => 'PageNotFound',
        'action'     => 'Index',
    ],
];
