<?php

namespace InsologyStudio\FattureInCloud\Factory;

interface PersonalData
{
    public function list(array $data): array;
    public function update(array $data): string;
    public function create(array $data);
    public function delete(integer $id): array;
    // public function import(array $data): array;
}