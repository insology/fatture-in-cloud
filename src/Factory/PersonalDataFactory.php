<?php

namespace InsologyStudio\FattureInCloud\Factory;

interface PersonalDataFactory
{
    public function list(): array;
    public function update(array $data): array;
    public function create(array $data): array;
    public function delete(array $data): array;
    // public function import(array $data): array;
}