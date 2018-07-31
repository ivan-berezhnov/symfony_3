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
  public function findAllPublishedOrderedBySize()
  {
    return $this->createQueryBuilder('genus')
      ->andWhere('genus.isPublished = :isPublished')
      ->setParameter('isPublished', true)
      ->orderBy('genus.speciesCount', 'DESC')
      ->getQuery()
      ->execute();
  }
}
