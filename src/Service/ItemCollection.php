<?php

namespace App\Service;
use App\Service\Interface\CategoryInterface;
use Symfony\Contracts\Service\ServiceSubscriberInterface;

class ItemCollection  implements ServiceSubscriberInterface
{
    private array $categories = [];

    public function __construct(iterable $implementations)
    {
        foreach ($implementations as $categoryService) {
            $this->categories[$categoryService->getType()] = $categoryService;
        }
    }

    public function getCategories() : array
    {
        return $this->categories;
    }

    public static function getSubscribedServices(): array
    {
        return [
            'app.category' => CategoryInterface::class,
        ];
    }

}