<?php

namespace EventsBundle\Entity;

/**
 * agenda
 */
class agenda
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $descriptionAgenda;

    /**
     * @var \DateTime
     */
    private $dateCreation;

    private  $evennement;

    /**
     * @return mixed
     */
    public function getEvennement()
    {
        return $this->evennement;
    }

    /**
     * @param mixed $evennement
     */
    public function setEvennement($evennement)
    {
        $this->evennement = $evennement;
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
     * Set descriptionAgenda
     *
     * @param string $descriptionAgenda
     *
     * @return agenda
     */
    public function setDescriptionAgenda($descriptionAgenda)
    {
        $this->descriptionAgenda = $descriptionAgenda;
    
        return $this;
    }

    /**
     * Get descriptionAgenda
     *
     * @return string
     */
    public function getDescriptionAgenda()
    {
        return $this->descriptionAgenda;
    }

    /**
     * Set dateCreation
     *
     * @param \DateTime $dateCreation
     *
     * @return agenda
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;
    
        return $this;
    }

    /**
     * Get dateCreation
     *
     * @return \DateTime
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }
}

