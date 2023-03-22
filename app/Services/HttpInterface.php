<?php

namespace App\Services;

interface HttpInterface
{
    public function get(string $url): string;
}
