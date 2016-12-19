<?php
/**
 * Created by PhpStorm.
 * User: anjatomovska
 * Date: 12/16/16
 * Time: 12:44 PM
 */

namespace BikeRentBundle\Controller;


use BikeRentBundle\Entity\Reservation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class RentController
 * @package BikeRentBundle\Controller
 * @Route("/rent")
 */
class RentController extends Controller
{

    /**
     * @Route("/", name="br.rent.index")
     * @Template()
     */
    public function index(){
        $brepository = $this->getDoctrine()->getRepository('BikeRentBundle:Bike');
        $bikes = $brepository->findAll();
        $arepository = $this->getDoctrine()->getRepository('BikeRentBundle:Accessory');
        $accessories = $arepository->findAll();

        return ['bikes' => $bikes, 'accessories'=>$accessories];
    }

    /**
     * @Route("/save", name="br.rent.rent")
     * @Method("POST")
     *
     */
    public function rentAction(Request $request){


        if (!$this->isValidRentRequest($request->request->all())){

            $this->get('session')->set('postData', $request->request->all());

            return $this->redirect($this->generateUrl('br.rent.index'));
        }
        else{
            $this->get('session')->remove('postData');
        }

        $reservation = new Reservation();
        $reservation->setUser($this->getUser());
        $reservation->setStartDate(new \DateTime($request->request->get('start_date')));
        $reservation->setEndDate(new \DateTime($request->request->get('end_date')));
        $reservation->setPhone($request->request->get('phone'));


        $bikeRepository = $this->getDoctrine()->getRepository('BikeRentBundle:Bike');
        $bikes = $bikeRepository->findById($request->request->get('bikes'));
        foreach ($bikes as $bike){
            $reservation->addBike($bike);
        }

        $arepository = $this->getDoctrine()->getRepository('BikeRentBundle:Accessory');
        $accessories = $arepository->findById($request->request->get('accessories'));
        foreach ($accessories as $accessory){
            $reservation->addAccessory($accessory);
        }

        $dm = $this->getDoctrine()->getManager();
        $dm->persist($reservation);
        $dm->flush();

       return  $this->redirect($this->generateUrl('br.rent.my_rents'));

    }

    /**
     * @Route("/my-reservations", name="br.rent.my_rents")
     * @Method("GET")
     * @Template()
     *
     */
    public function myReservationsAction(Request $request){
        $repository = $this->getDoctrine()->getRepository('BikeRentBundle:Reservation');
        $reservations = $repository->findByUser($this->getUser()->getId());

        return ['reservations'=>$reservations];
    }

    private function isValidRentRequest($rentData){


        $isValid = true;

        if (empty($rentData['phone'])){
            $this->addFlash('phoneError', 'Phone is required');
            $this->addFlash('error.phone', 'Phone is required 2');
            $isValid = false;
        }
        if( empty($rentData['bikes'])){
            $this->addFlash('bikeError', 'Please select bikes you want to rent');
            $isValid = false;
        }
        if( empty($rentData['start_date'])){
            $this->addFlash('startError', 'Start date is required');
            $isValid = false;
        }
        if( empty($rentData['end_date'])){
            $this->addFlash('endError', 'End date is required');
            $isValid = false;
        }

        return $isValid;
    }
}