<?php

namespace App\Service;

use App\Service\Interface\CategoryInterface;

class VegetableService implements CategoryInterface
{
    private array $list = [];

    private string $type = 'vegetable';

    public function getId(): int
    {
        return 1;
    }

    public function getName(): string
    {
        return '';
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getQuantity(): int
    {
        return 1;
    }
    public function getUnit(): string
    {
        return '';
    }

    public function add(array $item): int
    {
        return 1;
    }

    public function remove(array $item): int
    {
        return 1;
    }

    public function list(): array
    {
        return $this->list;
    }
}

