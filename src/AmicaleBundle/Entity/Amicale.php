<?php

namespace AmicaleBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Amicale
 */
class Amicale
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $nomAmicale;

    /**
     * @var string
     */
    private $typeAmicale;

    /**
     * @var int
     */
    private $montantAmicale;

    /**
     * @var string
     */
    private $descriptionAmicale;


    /**
     * @var
     */

   private $image;

    /**
     * @var integer
     */
    private $visi;

    /**
     * @return mixed
     */
    public function getVisi()
    {
        return $this->visi;
    }

    /**
     * @param mixed $visi
     */
    public function setVisi($visi)
    {
        $this->visi = $visi;
    }




    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }



    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User",cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nomAmicale
     *
     * @param string $nomAmicale
     *
     * @return Amicale
     */
    public function setNomAmicale($nomAmicale)
    {
        $this->nomAmicale = $nomAmicale;
    
        return $this;
    }

    /**
     * Get nomAmicale
     *
     * @return string
     */
    public function getNomAmicale()
    {
        return $this->nomAmicale;
    }

    /**
     * Set typeAmicale
     *
     * @param string $typeAmicale
     *
     * @return Amicale
     */
    public function setTypeAmicale($typeAmicale)
    {
        $this->typeAmicale = $typeAmicale;
    
        return $this;
    }

    /**
     * Get typeAmicale
     *
     * @return string
     */
    public function getTypeAmicale()
    {
        return $this->typeAmicale;
    }

    /**
     * Set montantAmicale
     *
     * @param integer $montantAmicale
     *
     * @return Amicale
     */
    public function setMontantAmicale($montantAmicale)
    {
        $this->montantAmicale = $montantAmicale;
    
        return $this;
    }

    /**
     * Get montantAmicale
     *
     * @return integer
     */
    public function getMontantAmicale()
    {
        return $this->montantAmicale;
    }

    /**
     * Set descriptionAmicale
     *
     * @param string $descriptionAmicale
     *
     * @return Amicale
     */
    public function setDescriptionAmicale($descriptionAmicale)
    {
        $this->descriptionAmicale = $descriptionAmicale;
    
        return $this;
    }

    /**
     * Get descriptionAmicale
     *
     * @return string
     */
    public function getDescriptionAmicale()
    {
        return $this->descriptionAmicale;
    }


    public function getFullImagePath() {
        return null === $this->image ? null : $this->getUploadRootDir(). $this->image;
    }

    public function getUploadRootDir() {
        // the absolute directory path where uploaded documents should be saved
        return $this->getTmpUploadRootDir().$this->getId()."/";
    }

    public function getTmpUploadRootDir() {
        // the absolute directory path where uploaded documents should be saved
        return __DIR__ . '/../../../../ourProjet/web/images/';
    }





}

