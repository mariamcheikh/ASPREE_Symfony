<?php
// src/AppBundle/Entity/User.php

namespace UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;


    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $nom;


    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $prenom;

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @return mixed
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @param mixed $prenom
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }


    public function __construct()
    {
        parent::__construct();
        // your own logic
    }


    /**
     * one user has Many amicales.
     * @ORM\OneToMany(targetEntity="AmicaleBundle\Entity\Amicale", mappedBy="amicales")
     */
    private $amicales;

    /**
     * @return mixed
     */
    public function getAmicales()
    {
        return $this->amicales;
    }

    /**
     * @param mixed $amicales
     */
    public function setAmicales($amicales)
    {
        $this->amicales = $amicales;
    }

    /**
     * one user has Many dons.
     * @ORM\OneToMany(targetEntity="EntraideBundle\Entity\don", mappedBy="dons")
     */
    private $dons;

    /**
     * @return mixed
     */
    public function getDons()
    {
        return $this->dons;
    }

    /**
     * @param mixed $dons
     */
    public function setDons($dons)
    {
        $this->dons = $dons;
    }
    /**
     * one user has Many event.
     * @ORM\OneToMany(targetEntity="EventsBundle\Entity\event", mappedBy="event")
     */
    private $event;

    /**
     * @return mixed
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * @param mixed $event
     */
    public function setEvent($event)
    {
        $this->event = $event;
    }



}