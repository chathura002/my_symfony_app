<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Client;

class ClientsController extends Controller
{

private $titles = ['mr', 'ms', 'mrs', 'dr', 'mx'];
    /**
     * @Route("/guests", name="index_clients")
     **/
    public function showIndex(){
        $data=[];     
        $data['clients']=$this->getDoctrine()->getRepository('AppBundle:Client')->findAll();
        //var_dump($data['clients']);
        return $this->render('clients/index.html.twig',$data);
    }

    /**
     * @Route("/guests/modify/{id_client}", name="modify_clients")
     **/
    public function showDetails(Request $request, $id_client){
        $data=[];
        $data['mode'] = "modify";
        $client_repo=$this->getDoctrine()->getRepository('AppBundle:Client');
        $form = $this->createFormBuilder()
                    ->add('name')
                    ->add('last_name')
                    ->add('title')
                    ->add('address')
                    ->add('zip_code')
                    ->add('city')
                    ->add('state')
                    ->add('email')
                    ->getForm()
        ;
        $form->handleRequest( $request );
        if($form->isSubmitted()){
            $form_data = $form->getData();
            $data['form'] = $form_data;
            $data['titles'] = $this->titles;
            $client = $client_repo->find($id_client);

            $client->setTitle($form_data['title']);
            $client->setName($form_data['name']);
            $client->setLastName($form_data['last_name']);
            $client->setAddress($form_data['address']);
            $client->setZipCode($form_data['zip_code']);
            $client->setCity($form_data['city']);
            $client->setState($form_data['state']);
            $client->setEmail($form_data['email']);
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('index_clients');

        } else {

            $client = $client_repo->find($id_client);

            $client_data['id']=$client->getId();
            $client_data['title']=$client->getTitle();
            $client_data['name']=$client->getName();
            $client_data['last_name']=$client->getLastName();
            $client_data['address']=$client->getAddress();
            $client_data['zip_code']=$client->getZipCode();
            $client_data['city']=$client->getCity();
            $client_data['state']=$client->getState();
            $client_data['email']=$client->getEmail();

            $data['form'] = $client_data;
            $data['titles'] = $this->titles;
        }
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
        $form = $this->createFormBuilder()
                    ->add('name')
                    ->add('last_name')
                    ->add('title')
                    ->add('address')
                    ->add('zip_code')
                    ->add('city')
                    ->add('state')
                    ->add('email')
                    ->getForm()
        ;
        $form->handleRequest( $request );
        if($form->isSubmitted()){
            $form_data = $form->getData();
            $data['form'] = $form_data;
            
            $client = new Client();
            $client->setTitle($form_data['title']);
            $client->setName($form_data['name']);
            $client->setLastName($form_data['last_name']);
            $client->setAddress($form_data['address']);
            $client->setZipCode($form_data['zip_code']);
            $client->setCity($form_data['city']);
            $client->setState($form_data['state']);
            $client->setEmail($form_data['email']);

            $em = $this->getDoctrine()->getManager();
            $em->persist($client);
            $em->flush();
            return $this->redirectToRoute('index_clients');

        }
        return $this->render('clients/form.html.twig',$data);
    }

    /** 
    * @Route("/github")
    **/
    public function gitHub()
    {
        $client = new \GuzzleHttp\Client();
        $res = $client->request("GET","https://api.github.com/users/chathura002");
        return new Response("<pre>" . $res->getBody() . "</pre>");
    }
}