<?php
namespace GPublicationBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
/**
 * Created by PhpStorm.
 * User: aymen
 * Date: 07/02/2017
 * Time: 19:53
 */

/**
 * @ORM\Entity(repositoryClass="GPublicationBundle\Repository\PublicationRepository")
 */
class Publication
{
    /**
     * @var int
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $likes;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $dislikes;
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="GPublicationBundle\Entity\Fichier", mappedBy="publication")
     */
    private $fichiers;

    /**
     * @ORM\OneToMany(targetEntity="GPublicationBundle\Entity\Reaction", mappedBy="publication")
     */
    private $reactions;

    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User",cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="string",length=255,nullable=true)
     */
    private $description;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nbrSignal;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateCreation;

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
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getDateCreation()
    {
        return $this->dateCreation->format('Y-m-d H:i');
    }

    /**
     * @param mixed $dateCreation
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;
    }


    /**
     * Publication constructor.
     */
    public function __construct()
    {
        $this->dateCreation = new \DateTime();
        $this->fichiers = new ArrayCollection();
        $this->reactions = new ArrayCollection();
        $this->nbrSignal =0;
        $this->likes=0;
        $this->dislikes=0;

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
    public function getFichiers()
    {
        return $this->fichiers;
    }

    /**
     * @param mixed $fichiers
     */
    public function setFichiers($fichiers)
    {
        $this->fichiers = $fichiers;
    }

    /**
     * @return mixed
     */
    public function getReactions()
    {
        return $this->reactions;
    }

    /**
     * @param mixed $reactions
     */
    public function setReactions($reactions)
    {
        $this->reactions = $reactions;
    }

    /**
     * @return mixed
     */
    public function getNbrSignal()
    {
        return $this->nbrSignal;
    }

    /**
     * @param mixed $nbrSignal
     */
    public function setNbrSignal($nbrSignal)
    {
        $this->nbrSignal = $nbrSignal;
    }
    public function setLikesDislikes()
    {
        $this->likes=0;
        $this->dislikes=0;
        foreach ($this->reactions as $r)
        {
            if ($r->getAvis()==1 )
            {
                $this->likes++;
            }
            elseif ($r->getAvis()==2){
                $this->dislikes++;
            }
        }
    }

    /**
     * @return int
     */
    public function getLikes()
    {
        return $this->likes;
    }

    /**
     * @param int $likes
     */
    public function setLikes($likes)
    {
        $this->likes = $likes;
    }

    public function addLike()
    {
        $this->likes++;
    }
    public function deleteLike()
    {
        $this->likes--;
    }

    /**
     * @return int
     */
    public function getDislikes()
    {
        return $this->dislikes;
    }
    public function addDislike()
    {
        $this->dislikes++;
    }
    public function deleteDislike()
    {
        $this->dislikes--;
    }
    /**
     * @param int $dislikes
     */
    public function setDislikes($dislikes)
    {
        $this->dislikes = $dislikes;
    }



}