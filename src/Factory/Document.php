<?php

namespace InsologyStudio\FattureInCloud\Factory;

interface Document
{
    public function list(array $data): array;
    public function details(array $data): array;
    public function info(array $data): array;
    public function infoMail(array $data): array;
    public function sendMail(array $data): array;
    public function update(array $data): array;
    public function create(array $data);
    public function delete(integer $id): array;
    // public function import(array $data): array;
}