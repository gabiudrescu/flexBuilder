<?php

namespace AppBundle\Entity;

use Symfony\Component\Validator\Constraints\Count;

/**
 * Configuration
 */
class Configuration
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @Count(min = 1, minMessage = "Please select at least one component")
     * @var \Doctrine\Common\Collections\Collection
     */
    private $components;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->components = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Configuration
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Add component
     *
     * @param \AppBundle\Entity\Component $component
     *
     * @return Configuration
     */
    public function addComponent(\AppBundle\Entity\Component $component)
    {
        $this->components[] = $component;

        return $this;
    }

    /**
     * Remove component
     *
     * @param \AppBundle\Entity\Component $component
     */
    public function removeComponent(\AppBundle\Entity\Component $component)
    {
        $this->components->removeElement($component);
    }

    /**
     * Get components
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getComponents()
    {
        return $this->components;
    }
}

