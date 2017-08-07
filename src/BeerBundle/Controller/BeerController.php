<?php

namespace BeerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\HttpException;

class BeerController extends Controller
{
    /**
     * @Route("/get_all_beers", name="get_all_beers")
     * @Method("GET")
     */
    public function getAllBeerAction()
    {
        $allBeers = $this->get('beer_manager')->getAllBeers();

        $result = ['beers' => []];

        $row = 0;

        foreach($allBeers as $value) {
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
    }

    /**
     * @Route("/create_beer/{id_producer}", name="create_beer")
     * @Method("POST")
     */

    /*
    Example Valid JSON:

    {
    "name": "name_beer",
    "style": "styleBeer",
    "og": 13,
    "abv": 12,
    "ibu": 60,
    "volume": 1000.30,
    "cost": 12.30,
    "status": 1 (1 - beer in stock, 0 - beer expected)
    }
    */
    public function createNewBeerAction(Request $request, $id_producer)
    {
        $content = $request->getContent();

        if(empty($content)){

            throw new HttpException(400, 'Incorrect request!');
        }

        $beerData = json_decode($content, true);

        return new JsonResponse($this->get('beer_manager')->createNewBeer(
            $beerData['name'],
            $beerData['style'],
            $beerData['og'],
            $beerData['abv'],
            $beerData['ibu'],
            $beerData['volume'],
            $beerData['cost'],
            $beerData['status'],
            $id_producer));
    }

    /**
     * @Route("/edit_beer", name="edit_beer")
     * @Method("POST")
     */

    /*
    Example Valid JSON:

    {
    "id": 2,
    "name": "name_beer",
    "style": "styleBeer",
    "og": 13,
    "abv": 12,
    "ibu": 60,
    "volume": 1000.30,
    "cost": 12.30,
    "status": 1 (1 - beer in stock, 0 - beer expected)
    }
    The quantity of fields may be any
    */
    public function editBeerAction(Request $request)
    {
        $content = $request->getContent();

        if(empty($content)){

            throw new HttpException(400, 'Incorrect request!');
        }

        $beerData = json_decode($content, true);

        return new JsonResponse($this->get('beer_manager')->editBeer(
            isset($beerData['name']) ? $beerData['name'] : null,
            isset($beerData['style']) ? $beerData['style']: null,
            isset($beerData['og']) ? $beerData['og'] : null,
            isset($beerData['abv']) ? $beerData['abv'] : null,
            isset($beerData['ibu']) ? $beerData['ibu'] : null,
            isset($beerData['volume']) ? $beerData['volume'] : null,
            isset($beerData['cost']) ? $beerData['cost'] : null,
            isset($beerData['status']) ? $beerData['status'] : null,
            $beerData['id']
        ));
    }

    /**
     * @Route("/delete_beer", name="delete_beer")
     * @Method("POST")
     */

    /*
    Valid JSON:

    {
    "id": 1
    }
    */
    public function deleteBeerAction(Request $request)
    {
        $content = $request->getContent();

        if(empty($content)){

            throw new HttpException(400, 'Incorrect request!');
        }

        $beerData = json_decode($content, true);

        return new JsonResponse($this->get('beer_manager')->deleteBeer($beerData['id']));
    }
}