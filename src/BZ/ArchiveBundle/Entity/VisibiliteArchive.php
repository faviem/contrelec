<?php

namespace BZ\ArchiveBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * VisibiliteArchive
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="BZ\ArchiveBundle\Entity\VisibiliteArchiveRepository")
 */
class VisibiliteArchive
{
     /**
    * @ORM\ManyToOne(targetEntity="BZ\ArchiveBundle\Entity\Archive", inversedBy="visibilitearchives")
    * @ORM\JoinColumn(nullable=false) 
    */
    private $archive;
    /**
    * @ORM\ManyToOne(targetEntity="BZ\UserBundle\Entity\User")
    * @ORM\JoinColumn(nullable=false) 
    */
    private $user;
    /**
     * @var boolean
     *
     * @ORM\Column(name="estlu", type="boolean")
     */
    private $estestlu;
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

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
     * Set archive
     *
     * @param \BZ\ArchiveBundle\Entity\Archive $archive
     * @return VisibiliteArchive
     */
    public function setArchive(\BZ\ArchiveBundle\Entity\Archive $archive)
    {
        $this->archive = $archive;

        return $this;
    }

    /**
     * Get archive
     *
     * @return \BZ\ArchiveBundle\Entity\Archive 
     */
    public function getArchive()
    {
        return $this->archive;
    }

   

    /**
     * Set estestlu
     *
     * @param boolean $estestlu
     * @return VisibiliteArchive
     */
    public function setEstestlu($estestlu)
    {
        $this->estestlu = $estestlu;

        return $this;
    }

    /**
     * Get estestlu
     *
     * @return boolean 
     */
    public function getEstestlu()
    {
        return $this->estestlu;
    }

    /**
     * Set user
     *
     * @param \BZ\UserBundle\Entity\User $user
     * @return VisibiliteArchive
     */
    public function setUser(\BZ\UserBundle\Entity\User $user)
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
}
