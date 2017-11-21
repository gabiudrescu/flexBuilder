<?php
/**
 * Created by PhpStorm.
 * User: gabiudrescu
 * Date: 21.11.2017
 * Time: 00:14
 */

namespace AppBundle\Factory;


use AppBundle\Entity\Component;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ComponentFactory
{
    private $resolver;

    public function __construct()
    {
        $this->resolver = new OptionsResolver();
    }

    public function fromArray(array $data) : Component
    {
        $component = new Component();
        $data = $this->configureOptions($data);

        $component->setName($data['name']);
        $component->setOutput($data['output']);

        return $component;
    }

    public function configureOptions(array $data)
    {
        $this->resolver->setRequired(['name', 'output']);

        return $this->resolver->resolve($data);
    }
}
