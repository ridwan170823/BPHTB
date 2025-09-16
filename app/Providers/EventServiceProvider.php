<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        \App\Events\PelayananRejected::class => [
            \App\Listeners\SendRejectionNotification::class,
        ],
        \App\Events\PelayananApproved::class => [
            \App\Listeners\PelayananApprovedListener::class,
        ],
        \App\Events\PelayananSubmitted::class => [
            \App\Listeners\SendNextRoleNotification::class,
        ],
        \App\Events\PelayananStageApproved::class => [
            \App\Listeners\SendNextRoleNotification::class,
        ],
    ];
}