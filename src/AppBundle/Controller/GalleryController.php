<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class GalleryController extends Controller
{
    /**
     * @Route("/gallery", name="gallery")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        $images = [
            'aed58e014ce4f61d66a2add5302557f0.jpg',
            'animals-rabbits.jpg',
            'free-stock-photosnature-squirrels.jpg',
            'pexels-photo-312121.jpeg',
            'trees-land-stock.jpg',
            'videoblocks-sunny.png',
            'wildlife-animals.png',
        ];

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $images, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            4/*limit per page*/
        );


        return $this->render('gallery/index.html.twig', [
            'images' => $pagination,
        ]);
    }
}
