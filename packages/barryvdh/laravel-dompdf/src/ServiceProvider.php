<?php

namespace Barryvdh\DomPDF;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Illuminate\Contracts\View\Factory as ViewFactory;

class ServiceProvider extends BaseServiceProvider
{
    public function register(): void
    {
        $this->app->singleton('dompdf', function ($app) {
            /** @var ViewFactory $view */
            $view = $app->make(ViewFactory::class);

            return new PDF($view);
        });
    }
}