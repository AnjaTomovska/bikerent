<?php
/**
 * Created by PhpStorm.
 * User: anjatomovska
 * Date: 12/15/16
 * Time: 4:23 PM
 */

namespace BikeRentBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;


/**
 * Class BikesController
 * @package BikeRentBundle\Controller
 * @Route("/bikes")
 */
class BikesController extends  Controller
{

    /**
     * @Route("/", name="br.bikes.list")
     * @Template()
     */
    public function listAction(){
        $repository = $this->getDoctrine()->getRepository('BikeRentBundle:Bike');

        $bikes = $repository->findAll();
        $bcrepository = $this->getDoctrine()->getRepository('BikeRentBundle:BikeCategory');
        $categories = $bcrepository->findAll();

        return ['bikes' => $bikes, 'categories'=>$categories];
    }



    /**
     * @Route("/pricing", name="br.bikes.pricing")
     * @Template()
     */
    public function pricingAction(){


        return [];
    }


    /**
     * @Route("/favorites", name="br.bikes.favorites")
     * @Template()
     */
    public function favoritesAction(){

        $favorites = $this->getUser()->getFavorites();


        return ['favorites'=>$favorites];
    }


    /**
     * @Route("/add-as-favorite", name="br.bikes.add_favorite")
     * @Method("POST")
     */
    public function addAsFavorite(Request $request){

        $repository = $this->getDoctrine()->getRepository('BikeRentBundle:Bike');
        $bike = $repository->find($request->request->get('id'));
        $addFavorite = $repository->find($request->request->get('isFavorite'));
        $user = $this->getUser();
        if ($addFavorite){
            $user->addFavorite($bike);
        }
        else{
            $user->removeFavorite($bike);
        }

        $dm = $this->getDoctrine()->getManager();
        $dm->persist($user);
        $dm->flush();
        return new JsonResponse('Success');
    }
}