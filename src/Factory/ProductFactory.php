<?php

namespace InsologyStudio\FattureInCloud\Factory;

interface ProductFactory
{
    public function list(): array;
    public function create(array $data);
    public function update(array $data): array;
    public function delete(array $data): array;
}