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

    public function add(array $item): void
    {
        $this->list[] = $item;
    }

    public function remove(array $item): void
    {
        $filteredData = array_filter($this->list, function ($value) use ($item) {
            return $value["name"] !== $item['name'];
        });

        $this->list = array_values($filteredData);
    }

    public function list(): array
    {
        return $this->list;
    }
}

