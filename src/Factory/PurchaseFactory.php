<?php

namespace InsologyStudio\FattureInCloud\Factory;

interface PurchaseFactory
{
    public function list(array $data): array;
    public function create(array $data);
    public function update(array $data): array;
    public function delete(array $data): array;
}