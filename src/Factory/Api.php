<?php

namespace InsologyStudio\FattureInCloud\Factory;

interface Api
{
    public function post(string $path, array $data): array;
}