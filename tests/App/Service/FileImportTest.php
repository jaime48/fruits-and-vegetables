<?php

namespace App\Tests\App\Service;

use App\Service\FruitService;
use App\Service\ItemCollectionService;
use App\Service\VegetableService;
use PHPUnit\Framework\TestCase;

class FileImportTest extends TestCase
{
    public function testFileImport() {
        $jsonArray = [
            [
                "id" => 1,
                "name" => "Carrot",
                "type" => "vegetable",
                "quantity" => 100,
                "unit" => "g",
            ],
            [
                "id" => 2,
                "name" => "Apple",
                "type" => "fruit",
                "quantity" => 200,
                "unit" => "g",
            ],
        ];

        $tmpFilePath = tempnam(sys_get_temp_dir(), 'test_json');
        file_put_contents($tmpFilePath, json_encode($jsonArray));
        $mockItems = [
            new FruitService(),
            new VegetableService(),
        ];
        $itemCollectionService = new ItemCollectionService($mockItems);
        $importedData = $itemCollectionService->import($tmpFilePath);

        $this->assertEquals($jsonArray, $importedData);
    }
}