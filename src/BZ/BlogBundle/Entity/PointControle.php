<?php

namespace BZ\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PointControle
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="BZ\BlogBundle\Entity\PointControleRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class PointControle
{
    /**
    * @ORM\ManyToOne(targetEntity="BZ\BlogBundle\Entity\SousRubriqueControle")
    * @ORM\JoinColumn(nullable=true) 
    */
    private $sousrubriquecontrole;
    /**
    * @ORM\ManyToOne(targetEntity="BZ\BlogBundle\Entity\Exercice")
    * @ORM\JoinColumn(nullable=true) 
    */
    private $exercice;
    /**
    * @ORM\ManyToOne(targetEntity="BZ\UserBundle\Entity\Service")
    * @ORM\JoinColumn(nullable=true) 
    */
    private $service;
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbre", type="integer")
     */
    private $nbre;

     /**
     * @var string
     *
     * @ORM\Column(name="mois", type="string", length=100)
     */
    private $mois;

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
     * Set nbre
     *
     * @param integer $nbre
     * @return PointControle
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
    /**
     * Set mois
     *
     * @param string $mois
     * @return PointControle
     */
    public function setMois($mois)
    {
        $this->mois = $mois;

        return $this;
    }

    /**
     * Get mois
     *
     * @return string 
     */
    public function getMois()
    {
        return $this->mois;
    }

    /**
     * Set sousrubriquecontrole
     *
     * @param \BZ\BlogBundle\Entity\SousRubriqueControle $sousrubriquecontrole
     * @return PointControle
     */
    public function setSousrubriquecontrole(\BZ\BlogBundle\Entity\SousRubriqueControle $sousrubriquecontrole = null)
    {
        $this->sousrubriquecontrole = $sousrubriquecontrole;

        return $this;
    }

    /**
     * Get sousrubriquecontrole
     *
     * @return \BZ\BlogBundle\Entity\SousRubriqueControle 
     */
    public function getSousrubriquecontrole()
    {
        return $this->sousrubriquecontrole;
    }

    /**
     * Set exercice
     *
     * @param \BZ\BlogBundle\Entity\Exercice $exercice
     * @return PointControle
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
     * Set service
     *
     * @param \BZ\UserBundle\Entity\Service $service
     * @return PointControle
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
}
