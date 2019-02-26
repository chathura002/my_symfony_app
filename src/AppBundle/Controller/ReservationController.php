<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ReservationController extends Controller
{
    /**
     * @Route("/reservations", name="reservations")
     **/
    public function showIndex(){
        return $this->render('reservation/index.html.twig');
    }

    /**
     * @Route("/reservation/{id_client}", name="booking")
     **/
    public function book(Request $request, $id_client){
        $data['id_client'] = $id_client;
        return $this->render('reservation/book.html.twig',$data);
    }
}