<?php
/**
 * Created by PhpStorm.
 * User: gabiudrescu
 * Date: 21.11.2017
 * Time: 21:45
 */

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\Component;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ComponentFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $web = new Component();
        $web->setName('web bundle');
        $web->setOutput('web');
        $web->setPackage('https://packagist.org/packages/symfony/web-server-bundle');
        $web->setType('Official');

        $cli = new Component();
        $cli->setName('command line');
        $cli->setOutput('cli');
        $cli->setPackage('https://packagist.org/packages/symfony/console');
        $cli->setType('Official');

        $manager->persist($web);
        $manager->persist($cli);

        $manager->flush();
    }
}
