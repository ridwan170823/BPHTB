<?php

namespace Barryvdh\DomPDF;

use Barryvdh\DomPDF\Support\SimplePdfGenerator;
use Illuminate\Contracts\View\Factory as ViewFactory;

class PDF
{
    protected string $html = '';
    protected string $paper = 'a4';
    protected string $orientation = 'portrait';

    public function __construct(
        protected ViewFactory $view,
        protected ?SimplePdfGenerator $generator = null
    ) {
        $this->generator = $generator ?: new SimplePdfGenerator();
    }

    public function loadView(string $view, array $data = [], array $mergeData = [], ?string $encoding = null): static
    {
        $this->html = $this->view->make($view, $data, $mergeData)->render();

        return $this;
    }

    public function loadHTML(string $html, ?string $encoding = null): static
    {
        $this->html = $html;

        return $this;
    }

    public function setPaper(string $paper, string $orientation = 'portrait'): static
    {
        $this->paper = $paper;
        $this->orientation = $orientation;

        return $this;
    }

    public function output(): string
    {
        return $this->generator->fromHtml($this->html, $this->paper, $this->orientation);
    }
}