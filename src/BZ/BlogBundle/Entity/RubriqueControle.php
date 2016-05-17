<?php

namespace BZ\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RubriqueControle
 * 
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="BZ\BlogBundle\Entity\RubriqueControleRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class RubriqueControle
{
      /**
    * @ORM\OneToMany(targetEntity="BZ\BlogBundle\Entity\SousRubriqueControle", mappedBy="rubriquecontrole")
    * @ORM\JoinColumn(nullable=true) 
    */
    private $sousrubriquecontroles;
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
     * @ORM\Column(name="libelle", type="string", length=255, nullable=true)
     */
    private $libelle;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbre", type="integer",  nullable=true)
     */
    private $nbre;
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
        $this->setNbre(0);
    }
    /**
    * @ORM\PreUpdate
    */
    public function updateDateupdate()
    {
        $this->setDateupdate(new \Datetime());
       
        if($this->getSousrubriquecontroles()==null ){
             $this->setNbre(0);
        }else{
             $i=0;
             foreach ($this->getSousrubriquecontroles() as $j){
            if($j->getEstsupprimer()==false){
            $i++;}
            }
            $this->setNbre($i);
        }
        
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
     * Set libelle
     *
     * @param string $libelle
     * @return RubriqueControle
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle
     *
     * @return string 
     */
    public function getLibelle()
    {
        return $this->libelle;
    }
    
    /**
     * Set loginCreate
     *
     * @param string $loginCreate
     * @return CategorieCourier
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
     * @return CategorieCourier
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
     * @return CategorieCourier
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
     * @return CategorieCourier
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
     * @return CategorieCourier
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
     * @return CategorieCourier
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
     * @return CategorieCourier
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
     * Add sousrubriquecontroles
     *
     * @param \BZ\BlogBundle\Entity\SousRubriqueControle $sousrubriquecontroles
     * @return RubriqueControle
     */
    public function addSousrubriquecontrole(\BZ\BlogBundle\Entity\SousRubriqueControle $sousrubriquecontroles)
    {
        $this->sousrubriquecontroles[] = $sousrubriquecontroles;

        return $this;
    }

    /**
     * Remove sousrubriquecontroles
     *
     * @param \BZ\BlogBundle\Entity\SousRubriqueControle $sousrubriquecontroles
     */
    public function removeSousrubriquecontrole(\BZ\BlogBundle\Entity\SousRubriqueControle $sousrubriquecontroles)
    {
        $this->sousrubriquecontroles->removeElement($sousrubriquecontroles);
    }

    /**
     * Get sousrubriquecontroles
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSousrubriquecontroles()
    {
        return $this->sousrubriquecontroles;
    }

    /**
     * Set nbre
     *
     * @param integer $nbre
     * @return RubriqueControle
     */
    public function setNbre($nbre)
    {
        $this->nbre = $nbre;

        return $this;
    }

    /**
     * Get nbre
     *
     * @return integer 
     */
    public function getNbre()
    {
        return $this->nbre;
    }
}
