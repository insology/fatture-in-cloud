<?php

namespace InsologyStudio\FattureInCloud\Factory;

interface DocumentsFactory
{
    public function list(array $data): array;
    public function details(array $data): array;
    public function info(array $data): array;
    public function infoMail(array $data): array;
    public function sendMail(array $data): array;
    public function update(array $data): array;
    public function create(array $data): array;
    public function delete(array $data): array;
    // public function import(array $data): array;
}