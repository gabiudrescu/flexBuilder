<?php
/**
 * Created by PhpStorm.
 * User: gabiudrescu
 * Date: 21.11.2017
 * Time: 00:14
 */

namespace AppBundle\Factory;


use AppBundle\Entity\Component;
use Doctrine\ORM\EntityManager;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ComponentFactory
{
    private $resolver;

    private $em;

    public function __construct(EntityManager $manager)
    {
        $this->resolver = new OptionsResolver();
        $this->em = $manager;
    }

    public function fromArray(array $data) : Component
    {
        $data = $this->configureOptions($data);
        $component = $this->retrieveObject($data['name']);

        $component->setName($data['name']);
        $component->setType($data['type']);
        $component->setPackage($data['package']);
        $component->setOutput(is_null($data['output']) ? $data['name'] : $data['output']);

        return $component;
    }

    private function retrieveObject(string $name)
    {
        $entity = $this->em->getRepository('AppBundle:Component')->findOneBy(['name' => $name]);

        if(!$entity)
        {
            return new Component();
        }

        return $entity;
    }

    public function configureOptions(array $data)
    {
        $this->resolver->setRequired(['name', 'type', 'package', 'output']);

        $this->resolver->setAllowedValues('type', ['Contrib', 'Official']);
        $this->resolver->setAllowedValues('package', function ($value){
            return filter_var($value, FILTER_VALIDATE_URL);
        });

        $this->resolver->setAllowedTypes('output', ['string', 'null']);

        return $this->resolver->resolve($data);
    }
}
