<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserInfos
 *
 * @ORM\Table(name="user_infos")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserInfosRepository")
 */
class UserInfos
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="first_name", type="string", length=255, nullable=true)
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=255, nullable=true)
     */
    private $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="birthday", type="string", length=255, nullable=true)
     */
    private $birthday;

    /**
     * @var string
     *
     * @ORM\Column(name="birth_location", type="string", length=255, nullable=true)
     */
    private $birthLocation;

    /**
     * @var string
     *
     * @ORM\Column(name="sexe_adh", type="string", length=255, nullable=true)
     */
    private $sexeAdh;

    /**
     * @var string
     *
     * @ORM\Column(name="contact_name", type="string", length=255, nullable=true)
     */
    private $contactName;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=255, nullable=true)
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="num_perso", type="string", length=255, nullable=true)
     */
    private $numPerso;

    /**
     * @var string
     *
     * @ORM\Column(name="id_transaction", type="string", length=255, nullable=true)
     */
    private $idTransaction;

    /**
     * @var string
     *
     * @ORM\Column(name="status_paiement", type="string", length=255, nullable=true)
     */
    private $statusPaiement;

    /**
     * @var string
     *
     * @ORM\Column(name="created_at", type="string", length=255, nullable=true)
     */
    private $createdAt;

    /**
     * @var string
     *
     * @ORM\Column(name="updated_at", type="string", length=255, nullable=true)
     */
    private $updatedAt;

    /**
     * @var string
     *
     * @ORM\Column(name="branche", type="string", length=255, nullable=true)
     */
    private $branche;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Fonctions")
     * @ORM\JoinColumn(name="fonction_id", referencedColumnName="id")
     */
    private $fonctions;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\District")
     * @ORM\JoinColumn(name="district_id", referencedColumnName="id")
     */
    private $district;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Region")
     * @ORM\JoinColumn(name="region_id", referencedColumnName="id")
     */
    private $region;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Groupe")
     * @ORM\JoinColumn(name="groupe_id", referencedColumnName="id")
     */
    private $groupe;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     *
     * @return UserInfos
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
     *
     * @return UserInfos
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
     * Set birthday
     *
     * @param string $birthday
     *
     * @return UserInfos
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;

        return $this;
    }

    /**
     * Get birthday
     *
     * @return string
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * Set birthLocation
     *
     * @param string $birthLocation
     *
     * @return UserInfos
     */
    public function setBirthLocation($birthLocation)
    {
        $this->birthLocation = $birthLocation;

        return $this;
    }

    /**
     * Get birthLocation
     *
     * @return string
     */
    public function getBirthLocation()
    {
        return $this->birthLocation;
    }

    /**
     * Set sexeAdh
     *
     * @param string $sexeAdh
     *
     * @return UserInfos
     */
    public function setSexeAdh($sexeAdh)
    {
        $this->sexeAdh = $sexeAdh;

        return $this;
    }

    /**
     * Get sexeAdh
     *
     * @return string
     */
    public function getSexeAdh()
    {
        return $this->sexeAdh;
    }

    /**
     * Set contactName
     *
     * @param string $contactName
     *
     * @return UserInfos
     */
    public function setContactName($contactName)
    {
        $this->contactName = $contactName;

        return $this;
    }

    /**
     * Get contactName
     *
     * @return string
     */
    public function getContactName()
    {
        return $this->contactName;
    }

    /**
     * Set phone
     *
     * @param string $phone
     *
     * @return UserInfos
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
     * Set idTransaction
     *
     * @param string $idTransaction
     *
     * @return UserInfos
     */
    public function setIdTransaction($idTransaction)
    {
        $this->idTransaction = $idTransaction;

        return $this;
    }

    /**
     * Get idTransaction
     *
     * @return string
     */
    public function getIdTransaction()
    {
        return $this->idTransaction;
    }

    /**
     * Set statusPaiement
     *
     * @param string $statusPaiement
     *
     * @return UserInfos
     */
    public function setStatusPaiement($statusPaiement)
    {
        $this->statusPaiement = $statusPaiement;

        return $this;
    }

    /**
     * Get statusPaiement
     *
     * @return string
     */
    public function getStatusPaiement()
    {
        return $this->statusPaiement;
    }

    /**
     * Set createdAt
     *
     * @param string $createdAt
     *
     * @return UserInfos
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return string
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param string $updatedAt
     *
     * @return UserInfos
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return string
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set fonctions
     *
     * @param \AppBundle\Entity\Fonctions $fonctions
     *
     * @return UserInfos
     */
    public function setFonctions(\AppBundle\Entity\Fonctions $fonctions = null)
    {
        $this->fonctions = $fonctions;

        return $this;
    }

    /**
     * Get fonctions
     *
     * @return \AppBundle\Entity\Fonctions
     */
    public function getFonctions()
    {
        return $this->fonctions;
    }

    /**
     * Set district
     *
     * @param \AppBundle\Entity\District $district
     *
     * @return UserInfos
     */
    public function setDistrict(\AppBundle\Entity\District $district = null)
    {
        $this->district = $district;

        return $this;
    }

    /**
     * Get district
     *
     * @return \AppBundle\Entity\District
     */
    public function getDistrict()
    {
        return $this->district;
    }

    /**
     * Set region
     *
     * @param \AppBundle\Entity\Region $region
     *
     * @return UserInfos
     */
    public function setRegion(\AppBundle\Entity\Region $region = null)
    {
        $this->region = $region;

        return $this;
    }

    /**
     * Get region
     *
     * @return \AppBundle\Entity\Region
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * Set groupe
     *
     * @param \AppBundle\Entity\Groupe $groupe
     *
     * @return UserInfos
     */
    public function setGroupe(\AppBundle\Entity\Groupe $groupe = null)
    {
        $this->groupe = $groupe;

        return $this;
    }

    /**
     * Get groupe
     *
     * @return \AppBundle\Entity\Groupe
     */
    public function getGroupe()
    {
        return $this->groupe;
    }

    /**
     * Set branche
     *
     * @param string $branche
     *
     * @return UserInfos
     */
    public function setBranche($branche)
    {
        $this->branche = $branche;

        return $this;
    }

    /**
     * Get branche
     *
     * @return string
     */
    public function getBranche()
    {
        return $this->branche;
    }

    /**
     * Set numPerso
     *
     * @param string $numPerso
     *
     * @return UserInfos
     */
    public function setNumPerso($numPerso)
    {
        $this->numPerso = $numPerso;

        return $this;
    }

    /**
     * Get numPerso
     *
     * @return string
     */
    public function getNumPerso()
    {
        return $this->numPerso;
    }
}
