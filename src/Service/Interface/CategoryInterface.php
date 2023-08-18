<?php

namespace App\Service\Interface;

interface CategoryInterface
{
    public function getId(): int;
    public function getName(): string;
    public function getType(): string;
    public function getQuantity(): int;
    public function getUnit(): string;

    public function add(array $item): int;

    public function remove(array $item): int;

    public function list(): array;

}