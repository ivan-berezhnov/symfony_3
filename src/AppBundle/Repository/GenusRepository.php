<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Genus;
use Doctrine\ORM\EntityRepository;

/**
 * Class GenusRepository
 * @package AppBundle\Repository
 */
class GenusRepository extends EntityRepository
{

  /**
   * @return Genus[]
   */
  public function findAllPublishedOrderedByRecentlyActive()
  {
    return $this->createQueryBuilder('genus')
      ->andWhere('genus.isPublished = :isPublished')
      ->setParameter('isPublished', true)
      ->leftJoin('genus.notes', 'genus_note')
      ->orderBy('genus_note.createdAt', 'DESC')
      ->getQuery()
      ->execute();
  }
}
