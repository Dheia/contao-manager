<?php
/**
 * Created by PhpStorm.
 * User: yanickwitschi
 * Date: 02.03.16
 * Time: 17:37
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Symfony\Component\HttpFoundation\Response;


class UiController implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    /**
     * Login action.
     *
     * @Route("/login")
     * @Method({"GET"})
     */
    public function loginAction()
    {
        return $this->render('AppBundle::login.html.twig');
    }

    /**
     * Install action.
     *
     * @Route("/install")
     * @Method({"GET"})
     */
    public function installAction()
    {
        return $this->render('AppBundle::install.html.twig');
    }

    /**
     * Packages action.
     *
     * @Route("/packages")
     * @Method({"GET"})
     */
    public function packagesAction()
    {
        return $this->render('AppBundle::packages.html.twig');
    }

    /**
     * Search action.
     *
     * @Route("/search")
     * @Method({"GET"})
     */
    public function searchAction()
    {
        return $this->render('AppBundle::search.html.twig');
    }

    /**
     * Render a template with given parameters and response.
     *
     * @param               $view
     * @param array         $parameters
     * @param Response|null $response
     *
     * @return Response
     */
    private function render($view, array $parameters = [], Response $response = null)
    {
        if (null === $response) {
            $response = new Response();
        }

        $response->setContent($this->container->get('twig')->render($view, $parameters));

        return $response;
    }
}