<?php
namespace GPublicationBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Created by PhpStorm.
 * User: aymen
 * Date: 07/02/2017
 * Time: 20:56
 */

/**
 * @ORM\Entity(repositoryClass="GPublicationBundle\Repository\PublicationRepository")
 */
class Fichier
{


    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="GPublicationBundle\Entity\Publication",cascade={"persist"},inversedBy="fichiers")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE",name="publication_id", referencedColumnName="id")
     */
    private $publication;

    /**
     * @ORM\Column(type="string",length=255,nullable=true)
     */
    private $lien;

    /**
     * @ORM\Column(type="string")
     *
     *
     *
     * @Assert\File(maxSize = "50M", mimeTypes={ "image/jpeg" , "application/pdf","image/bmp","image/png", "image/vnd.sealedmedia.softseal-jpg", "image/vnd.sealedmedia.softseal-gif", "application/mp4", "video/quicktime", "video/x-ms-wmv", "video/x-msvideo", "video/x-flv"},
     *     mimeTypesMessage = "ce format de fichier est inconnu",
     * uploadIniSizeErrorMessage = "uploaded file is larger than the upload_max_filesize PHP.ini setting",
     * uploadFormSizeErrorMessage = "uploaded file is larger than allowed by the HTML file input field",
     * uploadErrorMessage = "uploaded file could not be uploaded for some unknown reason",
     * maxSizeMessage = "fichier trop volumineux")
     *
     */
    private $fichier;

    /**
     * Fichier constructor.
     * @internal param $publication
     * @internal param $id
     * @internal param $fichier
     * @internal param $lien
     */
    public function __construct()
    {

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
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getFichier()
    {
        return $this->fichier;
    }

    /**
     * @param mixed $fichier
     */
    public function setFichier($fichier)
    {
        $this->fichier = $fichier;
    }

    /**
     * @return mixed
     */
    public function getLien()
    {
        return $this->lien;
    }

    /**
     * @param mixed $lien
     */
    public function setLien($lien)
    {
        $this->lien = $lien;
    }




}