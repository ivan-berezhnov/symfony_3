<?php

namespace AppBundle\Controller;


use AppBundle\Entity\GenusNote;
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

    $genusNote = new GenusNote();
    $genusNote->setUsername('AquaWeaver');
    $genusNote->setUserAvatarFilename('ryan.jpeg');
    $genusNote->setNote('I counted 8 legs... as they wrapped around me');
    $genusNote->setCreatedAt(new \DateTime('-1 month'));
    $genusNote->setGenus($genus);

    $em = $this->getDoctrine()->getManager();
    $em->persist($genus);
    $em->persist($genusNote);
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
        ->findAllPublishedOrderedByRecentlyActive();

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

      $recentNotes = $em->getRepository('AppBundle:GenusNote')
        ->findAllRecentNotesFromGenus($genus);

        return $this->render('genus/show.html.twig', [
            'genus' => $genus,
            'recentNoteCount' => count($recentNotes)
        ]);
    }

  /**
   * @Route(path="/genus/{name}/notes", methods={"GET"}, name="genus_show_notes")
   * @param Genus $genus
   * @return JsonResponse
   */
  public function getNotesAction(Genus $genus)
  {

    $notes = [];
    foreach ($genus->getNotes() as $note) {
      $notes[] = [
        'id' => $note->getId(),
        'username' => $note->getUsername(),
        'avatarUri' => '/images/' . $note->getUserAvatarFilename(),
        'note' => $note->getNote(),
        'date' => $note->getCreatedAt()->format('M d, Y'),
      ];
    }

    $data = [
      'notes' => $notes
    ];

    return new JsonResponse($data);
  }
}
