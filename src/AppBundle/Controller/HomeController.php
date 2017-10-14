<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends Controller
{
    /**
     * @Route("/", name="home")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {

        $animals = ["aed58e014ce4f61d66a2add5302557f0.jpg",
            "animals-rabbits.jpg",
            "free-stock-photosnature-squirrels.jpg",
            "pexels-photo-312121.jpeg",
            "trees-land-stock.jpg",
            "videoblocks-sunny.png",
            "wildlife-animals.png",];

        $houses = ["house_blue.jpg",
            "house_City_2209_hirez.jpg",
            "house_modern.jpg",
            "house_pexels-photo-261146.jpeg",
            "house_suburban.jpg",
            "house_Tiny House.jpg"];

        $nature = ["nature_maxresdefault.jpg",
            "nature_pexels-photo-284399.jpeg",
            "nature_river.jpg",
            "nature-full01.png",
            "nature-photos.jpg"];

        $images = array_merge($animals, $houses, $nature);

        shuffle($images);

        $randomisedImages = array_slice($images, 0, 8);

        return $this->render('home/index.html.twig', [
            'randomised_images' => $randomisedImages,
            'animals'          => array_slice($animals, 0, 2),
            'houses'          => array_slice($houses, 0, 2),
            'nature'          => array_slice($nature, 0, 2),

        ]);
    }
}
