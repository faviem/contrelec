<?php

namespace BZ\ArchiveBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Archive
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="BZ\ArchiveBundle\Entity\ArchiveRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Archive
{
    /**
    * @ORM\OneToMany(targetEntity="BZ\ArchiveBundle\Entity\DocumentArchive", mappedBy="archive", cascade={"persist"})
    * @ORM\JoinColumn(nullable=true) 
    */
    private $documentarchives;
    /**
    * @ORM\OneToMany(targetEntity="BZ\ArchiveBundle\Entity\VisibiliteArchive", mappedBy="archive", cascade={"persist"})
    * @ORM\JoinColumn(nullable=true) 
    */
    private $visibilitearchives;
     /**
    * @ORM\ManyToOne(targetEntity="BZ\BlogBundle\Entity\ObjetClassement", inversedBy="archives")
    * @ORM\JoinColumn(nullable=true) 
    */
    private $objetclassement;
     /**
    * @ORM\ManyToOne(targetEntity="BZ\UserBundle\Entity\User")
    * @ORM\JoinColumn(nullable=true) 
    */
    private $user;
     /**
    * @ORM\ManyToOne(targetEntity="BZ\BlogBundle\Entity\ObjetConservation")
    * @ORM\JoinColumn(nullable=true) 
    */
    private $objetconservation;
     /**
    * @ORM\ManyToOne(targetEntity="BZ\BlogBundle\Entity\NiveauAlerte", inversedBy="archives")
    * @ORM\JoinColumn(nullable=true) 
    */
    private $niveaualerte;
    
     /**
    * @ORM\ManyToOne(targetEntity="BZ\BlogBundle\Entity\Exercice", inversedBy="archives")
    * @ORM\JoinColumn(nullable=true) 
    */
    private $exercice;
    
     /**
    * @ORM\ManyToOne(targetEntity="BZ\UserBundle\Entity\Service", inversedBy="archives")
    * @ORM\JoinColumn(nullable=true) 
    */
    private $service;
     /**
    * @ORM\ManyToOne(targetEntity="BZ\ArchiveBundle\Entity\CategorieArchive", inversedBy="archives")
    * @ORM\JoinColumn(nullable=true) 
    */
    private $categoriearchive;
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateArchive", type="date")
     */
    private $dateArchive;

    /**
     * @var text
     *
     * @ORM\Column(name="contenu", type="text")
     */
    private $contenu;
    
     /**
     * @var string
     *
     * @ORM\Column(name="ref", type="string", length=255, nullable=true)
     */
    private $ref;
    
     /**
     * @var string
     *
     * @ORM\Column(name="loginCreate", type="string", length=255, nullable=true)
     */
    private $loginCreate;
    /**
     * @var string
     *
     * @ORM\Column(name="loginUpdate", type="string", length=255, nullable=true)
     */
    private $loginUpdate;
    /**
     * @var string
     *
     * @ORM\Column(name="loginDelete", type="string", length=255, nullable=true)
     */
    private $loginDelete;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datecreate", type="datetime", nullable=true)
     */
    private $datecreate;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateupdate", type="datetime", nullable=true)
     */
    private $dateupdate;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datedelete", type="datetime", nullable=true)
     */
    private $datedelete;
    /**
     * @var boolean
     *
     * @ORM\Column(name="estsupprimer", type="boolean")
     */
    private $estsupprimer;
    
    public function __construct() 
    {
        $this->updateDatecreate();
        $this->updateDateupdate();
        $this->documentarchives = new\Doctrine\Common\Collections\ArrayCollection();
    }
    /**
    * @ORM\PrePersist
    */
    public function updateDatecreate()
    {
        $this->setDatecreate(new \Datetime());
        $this->setEstsupprimer(false);
    }
    /**
    * @ORM\PreUpdate
    */
    public function updateDateupdate()
    {
        $this->setDateupdate(new \Datetime());
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
     * Set dateArchive
     *
     * @param \DateTime $dateArchive
     * @return Archive
     */
    public function setDateArchive($dateArchive)
    {
        $this->dateArchive = $dateArchive;

        return $this;
    }

    /**
     * Get dateArchive
     *
     * @return \DateTime 
     */
    public function getDateArchive()
    {
        return $this->dateArchive;
    }

    /**
     * Set contenu
     *
     * @param string $contenu
     * @return Archive
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
     * Get categoriearchive
     *
     * @return \BZ\ArchiveBundle\Entity\CategorieArchive 
     */
    public function getCategoriearchive()
    {
        return $this->categoriearchive;
    }
    
     /**
     * Set loginCreate
     *
     * @param string $loginCreate
     * @return Courier
     */
    public function setLoginCreate($loginCreate)
    {
        $this->loginCreate = $loginCreate;

        return $this;
    }

    /**
     * Get loginCreate
     *
     * @return string 
     */
    public function getLoginCreate()
    {
        return $this->loginCreate;
    }

    /**
     * Set loginUpdate
     *
     * @param string $loginUpdate
     * @return Courier
     */
    public function setLoginUpdate($loginUpdate)
    {
        $this->loginUpdate = $loginUpdate;

        return $this;
    }

    /**
     * Get loginUpdate
     *
     * @return string 
     */
    public function getLoginUpdate()
    {
        return $this->loginUpdate;
    }

    /**
     * Set loginDelete
     *
     * @param string $loginDelete
     * @return Courier
     */
    public function setLoginDelete($loginDelete)
    {
        $this->loginDelete = $loginDelete;

        return $this;
    }

    /**
     * Get loginDelete
     *
     * @return string 
     */
    public function getLoginDelete()
    {
        return $this->loginDelete;
    }

    /**
     * Set datecreate
     *
     * @param \DateTime $datecreate
     * @return Courier
     */
    public function setDatecreate($datecreate)
    {
        $this->datecreate = $datecreate;

        return $this;
    }

    /**
     * Get datecreate
     *
     * @return \DateTime 
     */
    public function getDatecreate()
    {
        return $this->datecreate;
    }

    /**
     * Set dateupdate
     *
     * @param \DateTime $dateupdate
     * @return Courier
     */
    public function setDateupdate($dateupdate)
    {
        $this->dateupdate = $dateupdate;

        return $this;
    }

    /**
     * Get dateupdate
     *
     * @return \DateTime 
     */
    public function getDateupdate()
    {
        return $this->dateupdate;
    }

    /**
     * Set datedelete
     *
     * @param \DateTime $datedelete
     * @return Courier
     */
    public function setDatedelete($datedelete)
    {
        $this->datedelete = $datedelete;

        return $this;
    }

    /**
     * Get datedelete
     *
     * @return \DateTime 
     */
    public function getDatedelete()
    {
        return $this->datedelete;
    }

    /**
     * Set estsupprimer
     *
     * @param boolean $estsupprimer
     * @return Courier
     */
    public function setEstsupprimer($estsupprimer)
    {
        $this->estsupprimer = $estsupprimer;

        return $this;
    }

    /**
     * Get estsupprimer
     *
     * @return boolean 
     */
    public function getEstsupprimer()
    {
        return $this->estsupprimer;
    }

    /**
     * Set exercice
     *
     * @param \BZ\BlogBundle\Entity\Exercice $exercice
     * @return Archive
     */
    public function setExercice(\BZ\BlogBundle\Entity\Exercice $exercice = null)
    {
        $this->exercice = $exercice;

        return $this;
    }

    /**
     * Get exercice
     *
     * @return \BZ\BlogBundle\Entity\Exercice 
     */
    public function getExercice()
    {
        return $this->exercice;
    }

    /**
     * Set objetclassement
     *
     * @param \BZ\BlogBundle\Entity\ObjetClassement $objetclassement
     * @return Archive
     */
    public function setObjetclassement(\BZ\BlogBundle\Entity\ObjetClassement $objetclassement = null)
    {
        $this->objetclassement = $objetclassement;

        return $this;
    }

    /**
     * Get objetclassement
     *
     * @return \BZ\BlogBundle\Entity\ObjetClassement 
     */
    public function getObjetclassement()
    {
        return $this->objetclassement;
    }

    /**
     * Set service
     *
     * @param \BZ\UserBundle\Entity\Service $service
     * @return Archive
     */
    public function setService(\BZ\UserBundle\Entity\Service $service = null)
    {
        $this->service = $service;

        return $this;
    }

    /**
     * Get service
     *
     * @return \BZ\UserBundle\Entity\Service 
     */
    public function getService()
    {
        return $this->service;
    }

    /**
     * Set categoriearchive
     *
     * @param \BZ\ArchiveBundle\Entity\CategorieArchive $categoriearchive
     * @return Archive
     */
    public function setCategoriearchive(\BZ\ArchiveBundle\Entity\CategorieArchive $categoriearchive = null)
    {
        $this->categoriearchive = $categoriearchive;

        return $this;
    }

    /**
     * Set reference
     *
     * @param string $ref
     * @return Archive
     */
    public function setRef($ref)
    {
        $this->ref= $ref;

        return $this;
    }

    /**
     * Get ref
     *
     * @return string 
     */
    public function getRef()
    {
        return $this->ref;
    }

    /**
     * Add documentarchive
     *
     * @param \BZ\ArchiveBundle\Entity\DocumentArchive $documentarchive
     * @return Archive
     */
    public function addDocumentarchive(\BZ\ArchiveBundle\Entity\DocumentArchive $documentarchive)
    {
        $documentarchive->setArchive($this);
        $this->documentarchives[] = $documentarchive;
     
        return $this;
    }

    /**
     * Remove documentarchive
     *
     * @param \BZ\ArchiveBundle\Entity\DocumentArchive $documentarchive
     */
    public function removeDocumentarchive(\BZ\ArchiveBundle\Entity\DocumentArchive $documentarchive)
    {
        $this->documentarchives->removeElement($documentarchive);
    }

    /**
     * Get documentarchives
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDocumentarchives()
    {
        return $this->documentarchives;
    }
   

    /**
     * Add visibilitearchives
     *
     * @param \BZ\ArchiveBundle\Entity\VisibiliteArchive $visibilitearchives
     * @return Archive
     */
    public function addVisibilitearchive(\BZ\ArchiveBundle\Entity\VisibiliteArchive $visibilitearchives)
    {
        $this->visibilitearchives[] = $visibilitearchives;

        return $this;
    }

    /**
     * Remove visibilitearchives
     *
     * @param \BZ\ArchiveBundle\Entity\VisibiliteArchive $visibilitearchives
     */
    public function removeVisibilitearchive(\BZ\ArchiveBundle\Entity\VisibiliteArchive $visibilitearchives)
    {
        $this->visibilitearchives->removeElement($visibilitearchives);
    }

    /**
     * Get visibilitearchives
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getVisibilitearchives()
    {
        return $this->visibilitearchives;
    }

    /**
     * Set user
     *
     * @param \BZ\UserBundle\Entity\User $user
     * @return Archive
     */
    public function setUser(\BZ\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \BZ\UserBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set objetconservation
     *
     * @param \BZ\BlogBundle\Entity\ObjetConservation $objetconservation
     * @return Archive
     */
    public function setObjetconservation(\BZ\BlogBundle\Entity\ObjetConservation $objetconservation = null)
    {
        $this->objetconservation = $objetconservation;

        return $this;
    }

    /**
     * Get objetconservation
     *
     * @return \BZ\BlogBundle\Entity\ObjetConservation 
     */
    public function getObjetconservation()
    {
        return $this->objetconservation;
    }

    /**
     * Set niveaualerte
     *
     * @param \BZ\BlogBundle\Entity\NiveauAlerte $niveaualerte
     * @return Archive
     */
    public function setNiveaualerte(\BZ\BlogBundle\Entity\NiveauAlerte $niveaualerte = null)
    {
        $this->niveaualerte = $niveaualerte;

        return $this;
    }

    /**
     * Get niveaualerte
     *
     * @return \BZ\BlogBundle\Entity\NiveauAlerte 
     */
    public function getNiveaualerte()
    {
        return $this->niveaualerte;
    }
}
