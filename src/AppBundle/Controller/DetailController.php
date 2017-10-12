<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DetailController extends Controller
{
    /**
     * @Route("/view", name="view")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {

        $image = 'aed58e014ce4f61d66a2add5302557f0.jpg';

        return $this->render('detail/index.html.twig', [
            'image' => $image,
        ]);
    }
}
