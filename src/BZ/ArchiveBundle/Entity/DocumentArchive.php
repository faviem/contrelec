<?php

namespace BZ\ArchiveBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DocumentArchive
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="BZ\ArchiveBundle\Entity\DocumentArchiveRepository")
 */
class DocumentArchive
{
     /**
    * @ORM\ManyToOne(targetEntity="BZ\ArchiveBundle\Entity\Archive", inversedBy="documentarchives")
    * @ORM\JoinColumn(nullable=false) 
    */
    private $archive;
    /**
    * @ORM\OneToOne(targetEntity="BZ\UserBundle\Entity\Image", cascade={"persist","remove"})
    * @ORM\JoinColumn(nullable=false) 
    */
    private $image;
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
     * @return DocumentArchive
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
     * Set image
     *
     * @param \BZ\UserBundle\Entity\Image $image
     * @return DocumentArchive
     */
    public function setImage(\BZ\UserBundle\Entity\Image $image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \BZ\UserBundle\Entity\Image 
     */
    public function getImage()
    {
        return $this->image;
    }
}
