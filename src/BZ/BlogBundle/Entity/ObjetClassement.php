<?php

namespace BZ\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * ObjetClassement
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="BZ\BlogBundle\Entity\ObjetClassementRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class ObjetClassement
{
    /**
    * @ORM\OneToMany(targetEntity="BZ\ArchiveBundle\Entity\Archive", mappedBy="objetclassement")
    * @ORM\JoinColumn(nullable=true) 
    */
    private $archives;
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

     /**
     * @var string
     *
     * @ORM\Column(name="lieustockage", type="string", length=75, nullable=true)
     * @Assert\Regex(pattern= "/Magasin|Bureau|Cave|Couloir|Dessous d'escaliers|Autre/")
     */
    private $lieustockage;
    /**
     * @var string
     *
     * @ORM\Column(name="ref", type="string", length=255)
     */
    private $ref;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

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
     * Set ref
     *
     * @param string $ref
     * @return ObjetClassement
     */
    public function setRef($ref)
    {
        $this->ref = $ref;

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
     * Set description
     *
     * @param string $description
     * @return ObjetClassement
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
     * Set loginCreate
     *
     * @param string $loginCreate
     * @return ObjetClassement
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
     * @return ObjetClassement
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
     * @return ObjetClassement
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
     * @return ObjetClassement
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
     * @return ObjetClassement
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
     * @return ObjetClassement
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
     * @return ObjetClassement
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
     * Set lieustockage
     *
     * @param string $lieustockage
     * @return ObjetClassement
     */
    public function setLieustockage($lieustockage)
    {
        $this->lieustockage = $lieustockage;

        return $this;
    }

    /**
     * Get lieustockage
     *
     * @return string 
     */
    public function getLieustockage()
    {
        return $this->lieustockage;
    }
    
    public function getEmplacementComplet()
    {
        return $this->getRef().'  '.$this->getLieustockage();
    }

    /**
     * Add archives
     *
     * @param \BZ\ArchiveBundle\Entity\Archive $archives
     * @return ObjetClassement
     */
    public function addArchive(\BZ\ArchiveBundle\Entity\Archive $archives)
    {
        $this->archives[] = $archives;

        return $this;
    }

    /**
     * Remove archives
     *
     * @param \BZ\ArchiveBundle\Entity\Archive $archives
     */
    public function removeArchive(\BZ\ArchiveBundle\Entity\Archive $archives)
    {
        $this->archives->removeElement($archives);
    }

    /**
     * Get archives
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getArchives()
    {
        return $this->archives;
    }
}
