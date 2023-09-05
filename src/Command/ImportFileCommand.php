<?php
// src/Command/ImportFileCommand.php
namespace App\Command;

use App\Service\ItemCollectionService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\HttpKernel\KernelInterface;

#[AsCommand(name: 'import:file')]
class ImportFileCommand extends Command
{
    private $kernel;
    private $collectionService;

    public function __construct(KernelInterface $kernel, ItemCollectionService $collectionService)
    {
        $this->kernel = $kernel;
        $this->collectionService = $collectionService;
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $jsonFilePath = $this->kernel->getProjectDir() . '/'.'request.json';
        $importedItems = $this->collectionService->import($jsonFilePath);
        if (!$importedItems) {
            return Command::INVALID;
        }
        $this->collectionService->add($importedItems);

        $this->collectionService->remove($importedItems[0]);

        dd($this->collectionService->collect(false));

        return Command::SUCCESS;
    }
}