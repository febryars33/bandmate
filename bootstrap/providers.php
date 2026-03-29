<?php

use App\Providers\AppServiceProvider;
use App\Providers\FortifyServiceProvider;
use App\Providers\UsernameServiceProvider;
use Spatie\Permission\PermissionServiceProvider;

return [
    App\Lib\Username\UsernameServiceProvider::class,
    AppServiceProvider::class,
    FortifyServiceProvider::class,
    UsernameServiceProvider::class,
    PermissionServiceProvider::class,
];
