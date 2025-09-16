<?php

namespace Barryvdh\DomPDF\Facade;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Barryvdh\DomPDF\PDF loadView(string $view, array $data = [], array $mergeData = [], string $encoding = null)
 * @method static \Barryvdh\DomPDF\PDF loadHTML(string $html, string $encoding = null)
 * @method static \Barryvdh\DomPDF\PDF setPaper(string $paper, string $orientation = 'portrait')
 * @method static string output()
 */
class Pdf extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'dompdf';
    }
}