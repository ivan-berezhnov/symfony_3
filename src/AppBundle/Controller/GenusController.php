<?php

namespace AppBundle\Controller;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use AppBundle\Entity\Genus;

class GenusController extends Controller
{

  /**
   * @Route(path="/genus/new")
   */
  public function newAction()
  {
    $genus = new Genus();
    $genus->setName('Octopus'.rand(1, 100));
    $genus->setSubFamily('Octopodinea');
    $genus->setSpeciesCount(rand(100, 99999));

    $em = $this->getDoctrine()->getManager();
    $em->persist($genus);
    $em->flush();

    return new Response('<html><body>Genus created!</body></html>');
  }

  /**
   * @Route(path="/genus")
   */
  public function listAction()
  {
      $em = $this->getDoctrine()->getManager();
      $genuses = $em->getRepository('AppBundle:Genus')
        ->findAllPublishedOrderedBySize();

      return $this->render('genus/list.html.twig', [
        'genuses' => $genuses,
      ]);
  }

    /**
     * @Route(path="/genus/{genusName}", name="genus_show")
     */
    public function showAction($genusName)
    {

        $em = $this->getDoctrine()->getManager();
        $genus = $em->getRepository('AppBundle:Genus')
          ->findOneBy(['name' => $genusName]);

        if (!$genus) {
          throw $this->createNotFoundException('No genus found!');
        }

      /*
        $funFacts = 'Octopuses can change the color of their body in just *three-tenths* of a second!';

        $cache = $this->get('doctrine_cache.providers.my_cache');

        $key = md5($funFacts);

        if ($cache->contains($key)) {
            $funFacts = $cache->fetch($key);
        } else {
            sleep(1);
            $funFacts = $this->get('markdown.parser')
                ->transform($funFacts);
            $cache->save($key, $funFacts);
        }
      */

        return $this->render('genus/show.html.twig', [
            'genus' => $genus,
        ]);
    }

    /**
     * @Route(path="/genus/{genusName}/notes", methods={"GET"}, name="genus_show_notes")
     */
    public function getNotesAction($genusName)
    {
        $notes = [
            ['id' => 1, 'username' => 'AquaPelham', 'avatarUri' => '/images/leanna.jpeg', 'note' => 'Octopus asked me a riddle, outsmarted me', 'date' => 'Dec. 10, 2015'],
            ['id' => 2, 'username' => 'AquaWeaver', 'avatarUri' => '/images/ryan.jpeg', 'note' => 'I counted 8 legs... as they wrapped around me', 'date' => 'Dec. 1, 2015'],
            ['id' => 3, 'username' => 'AquaPelham', 'avatarUri' => '/images/leanna.jpeg', 'note' => 'Inked!', 'date' => 'Aug. 20, 2015'],
        ];

        $data = [
            'notes' => $notes
        ];

        return new JsonResponse($data);
    }
}
