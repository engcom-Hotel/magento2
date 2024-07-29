<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Magz\Categoryproductassign\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Magento\Catalog\Model\CategoryLinkManagement;
use Magento\Catalog\Model\CategoryLinkRepository;
use Magz\Categoryproductassign\Model\Publisher;

class Catassign extends Command
{

    const NAME_ARGUMENT = "name";
    const NAME_OPTION = "option";

    /**
     * @var CategoryLinkManagement
     */
    private $categoryLinkManagement;

    /**
     * @var CategoryLinkRepository
     */
    private $categoryLinkRepository;

    /**
     * @var Publisher
     */
    private $publisher;

    /**
     * @param CategoryLinkManagement $categoryLinkManagement
     * @param CategoryLinkRepository $categoryLinkRepository
     * @param Publisher $publisher
     */
    public function __construct(
        CategoryLinkManagement $categoryLinkManagement,
        CategoryLinkRepository $categoryLinkRepository,
        Publisher $publisher
    ) {
        $this->categoryLinkManagement = $categoryLinkManagement;
        $this->categoryLinkRepository = $categoryLinkRepository;
        $this->publisher = $publisher;
        parent::__construct();
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(
        InputInterface $input,
        OutputInterface $output
    ) {
        $name = $input->getArgument(self::NAME_ARGUMENT);
        $option = $input->getOption(self::NAME_OPTION);
        #$output->writeln("Hello " . $option . " " . $name);

        if($name == "add") {
            $message = [
                "category_id" => 3,
                "action" => "add"
            ];
            $this->publisher->publish($message);


        } else if($name == "remove") {
            $this->categoryLinkRepository->deleteByIds(4, "Simple 1");
        }
        return 1;
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->setName("magz_categoryproductassign:catassign");
        $this->setDescription("Category assign");
        $this->setDefinition([
            new InputArgument(self::NAME_ARGUMENT, InputArgument::OPTIONAL, "Name"),
            new InputOption(self::NAME_OPTION, "-a", InputOption::VALUE_NONE, "Option functionality")
        ]);
        parent::configure();
    }

    /**
     * Write Method to get all products from a category
     */
    public function getAssignedProducts($categoryId) {
        $products = $this->categoryLinkManagement->getAssignedProducts($categoryId);
        return $products;
    }
}

