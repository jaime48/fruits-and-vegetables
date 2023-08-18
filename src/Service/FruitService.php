<?php

namespace App\Service;

use App\Service\Interface\CategoryInterface;

class FruitService implements CategoryInterface
{
    private array $list = [];

    private string $type = 'fruit';

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

    public function add(array $item): void
    {
        $this->list[] = $item;
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

