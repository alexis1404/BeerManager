<?php

namespace BeerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ProducerController extends Controller
{
    /**
     * @Route("/get_all_producers", name="get_all_producer")
     * @Method("GET")
     */
    public function getAllProducersAction()
    {
        $all_producers = $this->get('producer_manager')->getAllProducers();

        $result = ['producers' => []];

        $row = 0;

        foreach($all_producers as $value) {
            $result['producers'][$row] = [
                'id' => $value->getId(),
                'name' => $value->getName(),
            ];

            $row++;
        }

        return new JsonResponse($result);
    }

    /**
     * @Route("/create_producer", name="create_producer")
     * @Method("POST")
     */

    /*
    Valid JSON:

    {
    "name": "any_name"
    }
    */
    public function createProducerAction(Request $request)
    {
        $content = $request->getContent();

        if(empty($content)){

            throw new HttpException(400, 'Incorrect request!');
        }

        $producerData = json_decode($content, true);

        return new JsonResponse($this->get('producer_manager')->createNewProducer($producerData['name']));
    }

    /**
     * @Route("/edit_producer", name="edit_producer")
     * @Method("POST")
     */

    /*
    Valid JSON:

    {
    "id": 1,
    "name": "any_producer_name"
    }
    */
    public function editProducerAction(Request $request)
    {
        $content = $request->getContent();

        if(empty($content)){

            throw new HttpException(400, 'Incorrect request!');
        }

        $producerData = json_decode($content, true);

        return new JsonResponse($this->get('producer_manager')->editProducer($producerData['id'], $producerData['name']));
    }

    /**
     * @Route("/delete_producer", name="delete_producer")
     * @Method("POST")
     */

    /*
    Valid JSON:

    {
    "id": 1
    }
    */
    public function deleteProducerAction(Request $request)
    {
        $content = $request->getContent();

        if(empty($content)){

            throw new HttpException(400, 'Incorrect request!');
        }

        $producerData = json_decode($content, true);

        return new JsonResponse($this->get('producer_manager')->deleteProducer($producerData['id']));
    }

    /**
     * @Route("/get_all_producers_beers/{idProducer}", name="get_all_producers_beers")
     * @Method("GET")
     */
    public function getAllBeersProducer($idProducer)
    {
        $allProducersBeers = $this->get('producer_manager')->getAllProducersBeers($idProducer);

        if($allProducersBeers){
            $result = ['beers' => []];

            $row = 0;

            foreach($allProducersBeers as $value) {
                $result['beers'][$row] = [
                    'id' => $value->getId(),
                    'name' => $value->getName(),
                    'style' => $value->getStyle(),
                    'og' => $value->getOg(),
                    'abv' => $value->getAbv(),
                    'ibu' => $value->getIbu(),
                    'volume' => $value->getVolume(),
                    'cost' => $value->getCost(),
                    'status' => $value->getStatus(),
                    'providerName' => $value->getProducer()->getName()
                ];

                $row++;
            }
            return new JsonResponse($result);

        }else{

            return new JsonResponse(false);
        }
    }
}