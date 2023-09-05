<?php

namespace App\Service;

use App\Service\Interface\CategoryInterface;

class VegetableService implements CategoryInterface
{
    private array $list = [];

    private string $type = 'vegetable';

    public function getType(): string
    {
        return $this->type;
    }

    public function add(array $vegetable): void
    {
        $this->list[] = $vegetable;
    }

    public function remove(array $vegetable): void
    {
        $filteredData = array_filter($this->list, function ($value) use ($vegetable) {
            return $value["name"] !== $vegetable['name'];
        });

        $this->list = array_values($filteredData);
    }

    public function search(string $name): array
    {
        $results = [];
        foreach ($this->list as $vegetable) {
            if (str_contains($vegetable['name'], $name)) {
                $results[] = $vegetable;
            }
        }
        return $results;
    }

    public function list(): array
    {
        return $this->list;
    }
}

