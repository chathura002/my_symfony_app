<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ClientsController extends Controller
{

    private $client_data = [
        [  'id' => 0 , 
            'title' => 'mr', 
            'name' => 'Roy', 
            'last_name' => 'Adams', 
            'address' => '2872 Marquette Street',
            'zip_code' => '10312',
            'city' => 'New York City',
            'state' => 'NY',
            'email' => 'radams1v@example.com' 
        ],
        [  'id' => 1 , 
            'title' => 'mrs', 
            'name' => 'Bonnie', 
            'last_name' => 'Clark', 
            'address' => '4 Porter Avenue',
            'zip_code' => '80028',
            'city' => 'Louisville',
            'state' => 'CO',
            'email' => 'bclark6@example.com' 
        ],
        [  'id' => 2 , 
            'title' => 'ms', 
            'name' => 'Carol', 
            'last_name' => 'Shaw', 
            'address' => '650 Grover Alley',
            'zip_code' => '30305',
            'city' => 'Atlanta',
            'state' => 'GA',
            'email' => 'cshaw@example.com' 
        ]
    ];

private $titles = ['mr', 'ms', 'mrs', 'dr', 'mx'];
    /**
     * @Route("/guests", name="index_clients")
     **/
    public function showIndex(){
        $data=[];     
        $data['clients']=$this->client_data;
        return $this->render('clients/index.html.twig',$data);
    }

    /**
     * @Route("/guests/modify/{id_client}", name="modify_clients")
     **/
    public function showDetails(Request $request, $id_client){
        $data=[];
        $data['mode'] = "modify";
        $data['clients']=$this->client_data;
        $data['form'] = $this->client_data[$id_client];
        $data['titles'] = $this->titles;
        return $this->render('clients/form.html.twig',$data);
    }

    /**
     * @Route("/guests/new", name="new_clients")
     **/
    public function showNew(Request $request){
        $data=[];
        $data['mode'] = "new_client";
        $data['titles'] = $this->titles;
        $data['form'] = [];
        $data['form']['title'] = '';
        return $this->render('clients/form.html.twig',$data);
    }
}