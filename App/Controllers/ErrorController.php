<?php

namespace App;

class ErrorController
{
    public function index(): void
    {
        require_once dirname(__DIR__) . '/view/error.php';
    }
}