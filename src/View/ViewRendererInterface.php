<?php

namespace SONFin\View;

use Psr\Http\Message\ResponseInterface;

interface ViewRendererInterface
{

    public function render(string $template, array $context = []): ResponseInterface;
}
