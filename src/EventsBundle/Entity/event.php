<?php

namespace EventsBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * event
 */
class event
{


    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $nomEvent;

    /**
     * @var string
     */
    private $description;

    /**
     * @var \DateTime
     * @Assert\Date()
     */
    private $dateDebut;

    /**
     * @var \DateTime
     * @Assert\Date()
     * @Assert\Expression(
     *     "this.getDateDebut()< this.getDateFin()",
     *     message="Date debut doit etre inferieur a la date du fin"
     * )
     */
    private $dateFin;

    /**
     * @var string
     */
    private $image;

    /**
     * @var string
     */
    private $lieu;

    /**
     * @var float
     * @Assert\Length(
     *     min =1,
     *     max=3,
     *     minMessage="Longeur minimal doit etre egale a un",
     *     maxMessage="Longeur maximal doit etre egale a 3",
     *     )
     */
    private $prix;

    private $agenda;

    private $rating;

    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User",cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;






    /**
     * @var integer
     */
    private $visibilite;

    public function getUploadRootDir() {
        // the absolute directory path where uploaded documents should be saved
        return $this->getTmpUploadRootDir().$this->getId()."/";
    }

    public function getTmpUploadRootDir() {
        // the absolute directory path where uploaded documents should be saved
        return __DIR__ . '/../../../../ourProjet/web/images/';
    }

    /**
     * @return mixed
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * @param mixed $rating
     */
    public function setRating($rating)
    {
        $this->rating = $rating;
    }

    /**
     * @return mixed
     */
    public function getAgenda()
    {
        return $this->agenda;
    }

    /**
     * @param mixed $agenda
     */
    public function setAgenda($agenda)
    {
        $this->agenda = $agenda;
    }


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nomEvent
     *
     * @param string $nomEvent
     *
     * @return event
     */
    public function setNomEvent($nomEvent)
    {
        $this->nomEvent = $nomEvent;
    
        return $this;
    }

    /**
     * Get nomEvent
     *
     * @return string
     */
    public function getNomEvent()
    {
        return $this->nomEvent;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return event
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set dateDebut
     *
     * @param \DateTime $dateDebut
     *
     * @return event
     */
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;
    
        return $this;
    }

    /**
     * Get dateDebut
     *
     * @return \DateTime
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    /**
     * Set dateFin
     *
     * @param \DateTime $dateFin
     *
     * @return event
     */
    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;
    
        return $this;
    }

    /**
     * Get dateFin
     *
     * @return \DateTime
     */
    public function getDateFin()
    {
        return $this->dateFin;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return event
     */
    public function setImage($image)
    {
        $this->image = $image;
    
        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set lieu
     *
     * @param string $lieu
     *
     * @return event
     */
    public function setLieu($lieu)
    {
        $this->lieu = $lieu;
    
        return $this;
    }

    /**
     * Get lieu
     *
     * @return string
     */
    public function getLieu()
    {
        return $this->lieu;
    }

    /**
     * Set prix
     *
     * @param float $prix
     *
     * @return event
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;
    
        return $this;
    }

    /**
     * Get prix
     *
     * @return float
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * @return int
     */
    public function getVisibilite()
    {
        return $this->visibilite;
    }

    /**
     * @param int $visibilite
     */
    public function setVisibilite($visibilite)
    {
        $this->visibilite = $visibilite;
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



}

