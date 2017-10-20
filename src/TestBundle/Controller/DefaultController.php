<?php

namespace TestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use TestBundle\Entity\City;
use TestBundle\Entity\Person;
use TestBundle\Form\PersonType;

class DefaultController extends Controller {

    public function indexAction(Request $request) {
        $person = new Person();

        $form = $this->createForm(PersonType::class, $person);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();



            $em->persist($person);
            try {
                $em->flush();
            } catch (\Exception $exeption) {
              
            }
        }
        return $this->render('TestBundle:Default:index.html.twig', array(
                    'form' => $form->createView()));
    }

    public function searchAction() {
        $cities = $this->getDoctrine()
                ->getRepository(City::class)
                ->findAll();

        $citiesNames = array();
        foreach ($cities as $city) {
            $citiesNames[] = $city->getName();
        }
        return $this->render('TestBundle:Default:search.html.twig', array("cities" => $citiesNames));
    }

    public function getPersonsAction() {
        $em = $this->getDoctrine()->getManager();
        $city = $_POST["city"];
        $tag = $_POST["tags"];
        $arraySearch = array();
        $query=$em->createQuery('
            SELECT p FROM TestBundle:Person p
            
            JOIN p.tags tag
            LEFT JOIN tag.parentTag parent
            where p.city= :city and (tag.name = :name or parent.name= :name )
            
            
            
            
           '
            
         
                
        )->setParameters(array('city'=>$city,'name'=>$tag));
$persons=$query->getResult();

        return $this->render('TestBundle:Default:searchResult.html.twig', array("persons" => $persons));
    }

}
