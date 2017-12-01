<?php

namespace AppBundle\Command;

use AppBundle\Crawler\SymfonySh;
use AppBundle\Factory\ComponentFactory;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ExtractDataCommand extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('app:extract_data_command')
            ->setDescription('Hello PhpStorm');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $data = $this->getContainer()->get(SymfonySh::class)->extractComponentData();
        $em = $this->getContainer()->get('doctrine.orm.entity_manager');
        $repo = $em->getRepository('AppBundle:Component');

        foreach ($data as $item)
        {
            $object = $this->getContainer()->get(ComponentFactory::class)->fromArray($item);

            if(!$object->getId())
            {
                $em->persist($object);
            }

            $em->flush($object);
        }
    }
}
