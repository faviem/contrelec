<?php

namespace BZ\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PointFinancier
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="BZ\BlogBundle\Entity\PointFinancierRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class PointFinancier
{
     /**
    * @ORM\ManyToOne(targetEntity="BZ\BlogBundle\Entity\RubriqueFinance")
    * @ORM\JoinColumn(nullable=true) 
    */
    private $rubriquefinance;
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
     * @var integer
     *
     * @ORM\Column(name="montant", type="integer")
     */
    private $montant;

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
     * @return PointFinancier
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
     * Set montant
     *
     * @param integer $montant
     * @return PointFinancier
     */
    public function setMontant($montant)
    {
        $this->montant = $montant;

        return $this;
    }

    /**
     * Get montant
     *
     * @return integer 
     */
    public function getMontant()
    {
        return $this->montant;
    }

    /**
     * Set mois
     *
     * @param string $mois
     * @return PointFinancier
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
     * Set rubriquefinance
     *
     * @param \BZ\BlogBundle\Entity\RubriqueFinance $rubriquefinance
     * @return PointFinancier
     */
    public function setRubriquefinance(\BZ\BlogBundle\Entity\RubriqueFinance $rubriquefinance = null)
    {
        $this->rubriquefinance = $rubriquefinance;

        return $this;
    }

    /**
     * Get rubriquefinance
     *
     * @return \BZ\BlogBundle\Entity\RubriqueFinance 
     */
    public function getRubriquefinance()
    {
        return $this->rubriquefinance;
    }

    /**
     * Set exercice
     *
     * @param \BZ\BlogBundle\Entity\Exercice $exercice
     * @return PointFinancier
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
     * @return PointFinancier
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
