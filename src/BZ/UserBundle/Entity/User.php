<?php
/*
 * This file is part of the Gestion Internet Game Center package.
 *
 * (c) Blue Zone <contact@bluezone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 */

namespace BZ\UserBundle\Entity;

/**
 * Load default users
 *
 * @author Jacques Adjahoungbo <tocicason@hotmail.fr>
 */



use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="bz_user")
 * @ORM\HasLifecycleCallbacks()
 *
 */

class User extends BaseUser
{
   
    /**
    * @ORM\ManyToOne(targetEntity="BZ\UserBundle\Entity\Service")
    * @ORM\JoinColumn(nullable=true) 
    */
    private $service;
    /**
    * @ORM\ManyToOne(targetEntity="BZ\UserBundle\Entity\Profil")
    * @ORM\JoinColumn(nullable=true) 
    */
    private $profil;
    
    /**
    * @ORM\OneToOne(targetEntity="BZ\UserBundle\Entity\Image", cascade={"persist"})
    * @ORM\JoinColumn(nullable=true) 
    */
    private $image;
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
     /**
     * @var string
     *
     * @ORM\Column(name="user_gender", type="string", length=1, nullable=true)
     * @Assert\Regex(pattern= "/M|F/")
     */
    private $gender;

    /**
     * @var string
     *
     * @ORM\Column(name="user_firstName", type="string", length=255, nullable=true)
     * @Assert\Length(min="2")
     */
    private $firstName;

     /**
     * @var string
     *
     * @ORM\Column(name="user_lastName", type="string", length=255, nullable=true)
      * @Assert\Length(min="2")
     */
    private $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="user_phone", type="string", length=45, nullable=true)
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="user_mobile", type="string", length=45, nullable=true)
     */
    private $mobile;

    /**
     * @var string
     *
     * @ORM\Column(name="user_fax", type="string", length=45, nullable=true)
     */
    private $fax;
    
    /**
     * @var string
     *
     * @ORM\Column(name="user_company", type="string", length=45, nullable=true)
     */
    private $company;
    
    /**
     * @var string
     *
     * @ORM\Column(name="user_isconnect", type="string", length=1, nullable=true)
     */
    private $isconnect;

    /**
    * @var \DateTime
    *
    * @ORM\Column(name="user_createdate", type="datetime", nullable=false)
    */   
    private $createDate;

    /**
    * @var \DateTime
    *
    * @ORM\Column(name="user_updatedate", type="datetime", nullable=true)
    */   
    private $updateDate;
    /**
     * Constructor
     */
    public function __construct()
    {
         parent::__construct();
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
     * Set gender
     *
     * @param string $gender
     * @return User
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get gender
     *
     * @return string 
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     * @return User
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string 
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     * @return User
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string 
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set phone
     *
     * @param string $phone
     * @return User
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string 
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set isconnect
     *
     * @param string $isconnect
     * @return User
     */
    public function setIsconnect($isconnect)
    {
        $this->isconnect = $isconnect;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string 
     */
    public function getIsconnect()
    {
        return $this->isconnect;
    }

    /**
     * Set mobile
     *
     * @param string $mobile
     * @return User
     */
    public function setMobile($mobile)
    {
        $this->mobile = $mobile;

        return $this;
    }

    /**
     * Get mobile
     *
     * @return string 
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * Set fax
     *
     * @param string $fax
     * @return User
     */
    public function setFax($fax)
    {
        $this->fax = $fax;

        return $this;
    }

    /**
     * Get fax
     *
     * @return string 
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * Set company
     *
     * @param string $company
     * @return User
     */
    public function setCompany($company)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return string 
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Set createDate
     *
     * @param \DateTime $createDate
     * @return User
     */
    public function setCreateDate($createDate)
    {
        $this->createDate = $createDate;

        return $this;
    }

    /**
     * Get createDate
     *
     * @return \DateTime 
     */
    public function getCreateDate()
    {
        return $this->createDate;
    }

    /**
     * Set updateDate
     *
     * @param \DateTime $updateDate
     * @return User
     */
    public function setUpdateDate($updateDate)
    {
        $this->updateDate = $updateDate;

        return $this;
    }

    /**
     * Get updateDate
     *
     * @return \DateTime 
     */
    public function getUpdateDate()
    {
        return $this->updateDate;
    }
    
    /**
    * Appeler avant la persistence d'un objet en base de donn�e
    * @ORM\PrePersist
    */
    public function onPrePersist()
    {
        $this->setCreateDate(new \DateTime('now'));
        $this->setCompany('CONTRELEC');
    }

    /**
    * Appeler avant la mise � jour d'un objet en base de donn�e
    * @ORM\PreUpdate
    */
    public function onPreUpdate()
    {
        $this->setUpdateDate(new \DateTime('now'));
        $this->setCompany('CONTRELEC');
    }
   
    /**
    * @param BZ\UserBundle\Entity\Image $image
    */
    public function setImage(\BZ\UserBundle\Entity\Image $image =null)
    {
        $this->image = $image;
    }
    /**
    * @return BZ\UserBundle\Entity\Image
    */
    public function getImage()
    {
        return $this->image;
    }
    
    public function getNomPrenom()
    {
         if(($this->getFirstName()=="") || ($this->getLastName()==""))
        {
            return $this->getUsername();
        }
        else
        {
            return $this->getFirstName().'  '.$this->getLastName();
        }
    }

    /**
     * Set profil
     *
     * @param \BZ\UserBundle\Entity\Profil $profil
     * @return User
     */
    public function setProfil(\BZ\UserBundle\Entity\Profil $profil = null)
    {
        $this->profil = $profil;

        return $this;
    }

    /**
     * Get profil
     *
     * @return \BZ\UserBundle\Entity\Profil 
     */
    public function getProfil()
    {
        return $this->profil;
    }

    /**
     * Set service
     *
     * @param \BZ\UserBundle\Entity\Service $service
     * @return User
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
    
    public function _ToString()
    {
        if($this->getFirstName()=="" || $this->getLastName()=="")
        {
            return $this->getUsername();
        }
        else
        {
            return $this->getFirstName().'  '.$this->getLastName();
        }
    }
    
}
