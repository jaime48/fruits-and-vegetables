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

    public function add(array $fruit): void
    {
        $this->list[] = $fruit;
    }

    public function remove(array $fruit): void
    {
        $filteredData = array_filter($this->list, function ($value) use ($fruit) {
            return $value["name"] !== $fruit['name'];
        });

        $this->list = array_values($filteredData);
    }

    public function search(string $name): array
    {
        $results = [];
        foreach ($this->list as $fruit) {
            if (str_contains($fruit['name'], $name)) {
                $results[] = $fruit;
            }
        }
        return $results;
    }

    public function list(): array
    {
        return $this->list;
    }
}

