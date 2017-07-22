<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ChanqueController extends Controller
{
    /**
     * @Route("/", name="index")
     */
    public function index(){

        return $this->render('default/index.html.twig');
    }

}
