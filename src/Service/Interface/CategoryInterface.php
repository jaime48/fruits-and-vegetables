<?php

namespace App\Service\Interface;

interface CategoryInterface
{
    public function getType(): string;

    public function add(array $item): void;

    public function remove(array $item): void;

    public function list(): array;

}