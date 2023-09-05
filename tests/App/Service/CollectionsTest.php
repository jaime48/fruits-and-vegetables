<?php

namespace App\Tests\App\Service;

use App\Service\FruitService;
use App\Service\ItemCollectionService;
use App\Service\VegetableService;
use PHPUnit\Framework\TestCase;

class CollectionsTest extends TestCase
{
    private ItemCollectionService $itemCollectionService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->itemCollectionService = new ItemCollectionService([new FruitService(), new VegetableService()]);
    }

    public function testUnitConvert()
    {
        $reflection = new \ReflectionClass($this->itemCollectionService);
        $convertUnitMethod = $reflection->getMethod('convertUnit');
        $convertUnitMethod->setAccessible(true);

        $arg = ['unit' => 'g', 'quantity' => 1000];
        $expected = ['unit' => 'kg', 'quantity' => 1];
        $result = $convertUnitMethod->invoke($this->itemCollectionService, $arg, false);
        $this->assertEquals($expected, $result);

        $arg = ['unit' => 'kg', 'quantity' => 1];
        $expected = ['unit' => 'g', 'quantity' => 1000];
        $result = $convertUnitMethod->invoke($this->itemCollectionService, $arg, true);
        $this->assertEquals($expected, $result);
    }

    public function testCollections()
    {
        $jsonArray = [
            [
                'id' => 1,
                'name' => 'Carrot',
                'type' => 'vegetable',
                'quantity' => 100,
                'unit' => 'g',
            ],
            [
                'id' => 2,
                'name' => 'Apple',
                'type' => 'fruit',
                'quantity' => 200,
                'unit' => 'g',
            ],
        ];

        $expected = [
            'vegetable' => [
                [
                    'id' => 1,
                    'name' => 'Carrot',
                    'type' => 'vegetable',
                    'quantity' => 100,
                    'unit' => 'g',
                ],
            ],
            'fruit' => [
                    [
                        'id' => 2,
                        'name' => 'Apple',
                        'type' => 'fruit',
                        'quantity' => 200,
                        'unit' => 'g',
                    ],
                ],
        ];

        $this->itemCollectionService->add($jsonArray);
        $result = $this->itemCollectionService->collect();
        $this->assertEquals($expected, $result);
    }

    public function testRemoveItems()
    {
        $jsonArray = [
            [
                'id' => 1,
                'name' => 'Carrot',
                'type' => 'vegetable',
                'quantity' => 100,
                'unit' => 'g',
            ],
            [
                'id' => 2,
                'name' => 'Apple',
                'type' => 'fruit',
                'quantity' => 200,
                'unit' => 'g',
            ],
        ];

        $expected = [
            'vegetable' => [
            ],
            'fruit' => [
                    [
                        'id' => 2,
                        'name' => 'Apple',
                        'type' => 'fruit',
                        'quantity' => 200,
                        'unit' => 'g',
                    ],
                ],
        ];

        $this->itemCollectionService->add($jsonArray);
        $this->itemCollectionService->remove($jsonArray[0]);
        $result = $this->itemCollectionService->collect();
        $this->assertEquals($expected, $result);
    }

    public function testSearchItem()
    {
        $jsonArray = [
            [
                'id' => 1,
                'name' => 'Carrot',
                'type' => 'vegetable',
                'quantity' => 100,
                'unit' => 'g',
            ],
            [
                'id' => 2,
                'name' => 'Apple',
                'type' => 'fruit',
                'quantity' => 200,
                'unit' => 'g',
            ],
        ];

        $expected = [
            [
                'id' => 2,
                'name' => 'Apple',
                'type' => 'fruit',
                'quantity' => 200,
                'unit' => 'g',
            ],
        ];

        $this->itemCollectionService->add($jsonArray);
        $result = $this->itemCollectionService->search('fruit', 'Apple');
        $this->assertEquals($expected, $result);
    }
}
