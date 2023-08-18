<?php

namespace App\Service;
use App\Service\Interface\CategoryInterface;
use Symfony\Contracts\Service\ServiceSubscriberInterface;

class ItemCollectionService  implements ServiceSubscriberInterface
{
    private array $categories = [];
    private array $collections = [];

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

    public function import(string $file) : array|null
    {
        if (file_exists($file)) {
            $jsonData = file_get_contents($file);
            $decodedData = json_decode($jsonData, true);
            if ($decodedData === null) {
                return null;
            }
            return $decodedData;
        }
        return null;
    }

    public function add(array $items): void
    {
        foreach ($items as $item) {
            $matchedCategory = $this->getCategories()[$item['type']];
            $matchedCategory->add($this->convertUnit($item));
        }
    }

    public function remove(array $item): void
    {
        $matchedCategory = $this->getCategories()[$item['type']];
        $matchedCategory->remove($item);
    }

    private function convertUnit($item, $kgToGram = true): array
    {
        if ($kgToGram and $item['unit'] == 'kg') {
            $item['unit'] = 'g';
            $item['quantity'] = $item['quantity'] * 1000;
        }

        if (!$kgToGram and $item['unit'] == 'g') {
            $item['unit'] = 'kg';
            $item['quantity'] = $item['quantity'] * 0.001;
        }

        return $item;
    }

    public function collect(): array
    {
        foreach ($this->getCategories() as $category) {
            $this->collections[$category->getType()] = $category->list();
        }

        return $this->collections;
    }

    public static function getSubscribedServices(): array
    {
        return [
            'app.category' => CategoryInterface::class,
        ];
    }

}