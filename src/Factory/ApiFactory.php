<?php

namespace InsologyStudio\FattureInCloud\Factory;

interface ApiFactory
{
    public function post(string $path, array $data): array;
}