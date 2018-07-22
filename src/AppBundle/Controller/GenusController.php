<?php

namespace AppBundle\Controller;


use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class GenusController extends Controller
{
    /**
     * @Route(path="/genus/{genusName}")
     */
    public function showAction($genusName)
    {
        $funFacts = 'Octopuses can change the color of their body in just *three-tenths* of a second!';

        $funFacts = $this->get('markdown.parser')
            ->transform($funFacts);

        return $this->render('genus/show.html.twig', [
            'name' => $genusName,
            'funFacts' => $funFacts
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
