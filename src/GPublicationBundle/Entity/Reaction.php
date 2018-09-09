<?php

namespace GPublicationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reaction
 *
 * @ORM\Table(name="reaction")
 * @ORM\Entity(repositoryClass="GPublicationBundle\Repository\ReactionRepository")
 */
class Reaction
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User",cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */

    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="GPublicationBundle\Entity\Publication",cascade={"persist"},inversedBy="reactions")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE",name="publication_id", referencedColumnName="id")
     */
    private $publication;

    /**
     * @var string
     *
     * @ORM\Column(name="contenu", type="string", length=255, nullable=true)
     */
    private $contenu;

    /**
     * @var int
     *
     * @ORM\Column(name="avis", type="integer", nullable=true)
     */
    private $avis;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nbrSignal;

    /**
     * Reaction constructor.
     */
    public function __construct()
    {
        $this->date = new \DateTime();
        $this->nbrSignal =0;

    }

    /**
     * Set id
     *
     * @param integer $id
     *
     * @return Reaction
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;

    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set contenu
     *
     * @param string $contenu
     *
     * @return Reaction
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;

        return $this;
    }

    /**
     * Get contenu
     *
     * @return string
     */
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * Set avis
     *
     * @param integer $avis
     *
     * @return Reaction
     */
    public function setAvis($avis)
    {
        $this->avis = $avis;

        return $this;
    }

    /**
     * Get avis
     *
     * @return int
     */
    public function getAvis()
    {
        return $this->avis;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Reaction
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date->format('Y-m-d H:i:s');
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getPublication()
    {
        return $this->publication;
    }

    /**
     * @param mixed $publication
     */
    public function setPublication($publication)
    {
        $this->publication = $publication;
    }

    /**
     * @return int
     */
    public function getNbrSignal()
    {
        return $this->nbrSignal;
    }

    /**
     * @param int $nbrSignal
     */
    public function setNbrSignal($nbrSignal)
    {
        $this->nbrSignal = $nbrSignal;
    }
    public function getIdPublication()
    {
        return $this->publication->getId();
    }
    public function getNbrLike()
    {
        return $this;
    }


}

