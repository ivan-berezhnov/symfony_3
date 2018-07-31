<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="genus_note")
 */
class GenusNote
{
  /**
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   * @ORM\Column(type="integer")
   */
  private $id;

  /**
   * @ORM\Column(type="string")
   */
  private $username;

  /**
   * @ORM\Column(type="string")
   */
  private $userAvatarFilename;

  /**
   * @ORM\Column(type="text")
   */
  private $note;

  /**
   * @ORM\Column(type="datetime")
   */
  private $createdAt;

  /**
   * @return mixed
   */
  public function getId()
  {
    return $this->id;
  }

  /**
   * @return mixed
   */
  public function getUsername()
  {
    return $this->username;
  }

  /**
   * @param mixed $username
   */
  public function setUsername($username)
  {
    $this->username = $username;
  }

  /**
   * @return mixed
   */
  public function getUserAvatarFilename()
  {
    return $this->userAvatarFilename;
  }

  /**
   * @param mixed $userAvatarFilename
   */
  public function setUserAvatarFilename($userAvatarFilename)
  {
    $this->userAvatarFilename = $userAvatarFilename;
  }

  /**
   * @return mixed
   */
  public function getNote()
  {
    return $this->note;
  }

  /**
   * @param mixed $note
   */
  public function setNote($note)
  {
    $this->note = $note;
  }

  /**
   * @return mixed
   */
  public function getCreatedAt()
  {
    return $this->createdAt;
  }

  /**
   * @param mixed $createdAt
   */
  public function setCreatedAt($createdAt)
  {
    $this->createdAt = $createdAt;
  }

}