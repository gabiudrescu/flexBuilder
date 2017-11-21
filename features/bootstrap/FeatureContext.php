<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Doctrine\ORM\EntityManager;
use AppBundle\Factory\ComponentFactory;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context
{

    private $entityManager;

    private $factory;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct(EntityManager $entityManager, ComponentFactory $factory)
    {
        $this->entityManager = $entityManager;
        $this->factory = $factory;
    }

    /**
     * @Given there are the following components:
     */
    public function thereAreTheFollowingComponents(TableNode $table)
    {
        foreach ($table->getColumnsHash() as $item)
        {
            $this->factory->fromArray($item);
        }
    }
}
