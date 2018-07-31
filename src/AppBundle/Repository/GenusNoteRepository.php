<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Genus;
use Doctrine\ORM\EntityRepository;

/**
 * Class GenusNoteRepository
 * @package AppBundle\Repository
 */
class GenusNoteRepository extends EntityRepository
{

  /**
   * @return Genus[]
   */
  public function findAllRecentNotesFromGenus(Genus $genus)
  {
    return $this->createQueryBuilder('genus_note')
      ->andWhere('genus_note.genus = :genus')
      ->setParameter('genus', $genus)
      ->andWhere('genus_note.createdAt > :recentDate')
      ->setParameter('recentDate', new \DateTime('-3 months'))
      ->getQuery()
      ->execute();
  }
}
