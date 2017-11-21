<?php

namespace AppBundle\Controller;

use AppBundle\Form\FlexType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Router;
use Symfony\Component\Templating\EngineInterface;

class DefaultController
{

    private $formFactory;

    private $engine;

    private $router;

    public function __construct(FormFactory $formFactory, EngineInterface $engine, Router $router)
    {
        $this->formFactory = $formFactory;
        $this->engine = $engine;
        $this->router = $router;
    }

    /**
     * @Route("/", name="homepage")
     * @Method({"GET"})
     */
    public function indexAction(Request $request)
    {
        $form = $this->buildForm();

        $content = $this->engine->render('default/index.html.twig', [
            'form' => $form->createView()
        ]);

        return $this->buildResponse($content);
    }

    /**
     *
     * @Route("/handle", name="handle")
     * @Method({"POST"})
     *
     * @param Request $request
     *
     * @return RedirectResponse|Response
     */
    public function handleAction(Request $request)
    {
        $form = $this->buildForm();

        $form->handleRequest($request);

        if(!$form->isSubmitted() && !$form->isValid())
        {
            return new RedirectResponse($this->router->generate('homepage'));
        }

        $content = $this->engine->render('default/index.html.twig', [
            'flex' => $form->getData()
        ]);

        return $this->buildResponse($content);
    }

    private function buildForm()
    {
        $form = $this->formFactory->createBuilder(FlexType::class);

        $form
            ->add('submit', SubmitType::class, [
                'label' => 'Generate'
            ])
            ->setAction($this->router->generate('handle'))
        ;

        return $form->getForm();
    }

    private function buildResponse(string $content)
    {
        return new Response($content);
    }
}
