<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ScoutDeleted
 *
 * @ORM\Table(name="scout_deleted")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ScoutDeletedRepository")
 */
class ScoutDeleted
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
     * @ORM\Column(name="matricule", type="string", length=255)
     */
    private $matricule;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenoms", type="string", length=255)
     */
    private $prenoms;

    /**
     * @var string
     *
     * @ORM\Column(name="datenaiss", type="string", length=255)
     */
    private $datenaiss;

    /**
     * @var string
     *
     * @ORM\Column(name="lieunaiss", type="string", length=255)
     */
    private $lieunaiss;

    /**
     * @var string
     *
     * @ORM\Column(name="sexe", type="string", length=255)
     */
    private $sexe;

    /**
     * @var string
     *
     * @ORM\Column(name="branche", type="string", length=255, nullable=true)
     */
    private $branche;

    /**
     * @var string
     *
     * @ORM\Column(name="fonction", type="string", length=255, nullable=true)
     */
    private $fonction;

    /**
     * @var string
     *
     * @ORM\Column(name="contact", type="string", length=255, nullable=true)
     */
    private $contact;

    /**
     * @var string
     *
     * @ORM\Column(name="contactParent", type="string", length=255, nullable=true)
     */
    private $contactParent;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="carte", type="string", length=255, nullable=true)
     */
    private $carte;

    /**
     * @var string
     *
     * @ORM\Column(name="cotisation", type="string", length=255, nullable=true)
     */
    private $cotisation;

    /**
     * @var string
     *
     * @ORM\Column(name="urgence", type="string", length=255, nullable=true)
     */
    private $urgence;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255)
     */
    private $slug;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="publie_le", type="datetimetz", nullable=true)
     */
    private $publieLe;

    /**
     * @var string
     *
     * @ORM\Column(name="supprime_le", type="string", nullable=true)
     */
    private $supprimeLe;

    /**
     * @var string
     *
     * @ORM\Column(name="statut", type="string", nullable=true)
     */
    private $statut;

    /**
     * @var string
     *
     * @ORM\Column(name="groupe", type="string", nullable=true)
     */
    private $groupe;

    /**
     * @var string
     *
     * @ORM\Column(name="district", type="string", nullable=true)
     */
    private $district;

    /**
     * @var string
     *
     * @ORM\Column(name="region", type="string", nullable=true)
     */
    private $region;

    /**
     * @var int
     *
     * @ORM\Column(name="montant", type="integer", nullable=true)
     */
    private $montant;

    /**
     * @var int
     *
     * @ORM\Column(name="montant_sans_frais", type="integer", nullable=true)
     */
    private $montantSansFrais;

    /**
     * @var int
     *
     * @ORM\Column(name="ristourne", type="integer", nullable=true)
     */
    private $ristourne;


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
     * Set matricule
     *
     * @param string $matricule
     *
     * @return ScoutDeleted
     */
    public function setMatricule($matricule)
    {
        $this->matricule = $matricule;

        return $this;
    }

    /**
     * Get matricule
     *
     * @return string
     */
    public function getMatricule()
    {
        return $this->matricule;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return ScoutDeleted
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenoms
     *
     * @param string $prenoms
     *
     * @return ScoutDeleted
     */
    public function setPrenoms($prenoms)
    {
        $this->prenoms = $prenoms;

        return $this;
    }

    /**
     * Get prenoms
     *
     * @return string
     */
    public function getPrenoms()
    {
        return $this->prenoms;
    }

    /**
     * Set datenaiss
     *
     * @param string $datenaiss
     *
     * @return ScoutDeleted
     */
    public function setDatenaiss($datenaiss)
    {
        $this->datenaiss = $datenaiss;

        return $this;
    }

    /**
     * Get datenaiss
     *
     * @return string
     */
    public function getDatenaiss()
    {
        return $this->datenaiss;
    }

    /**
     * Set lieunaiss
     *
     * @param string $lieunaiss
     *
     * @return ScoutDeleted
     */
    public function setLieunaiss($lieunaiss)
    {
        $this->lieunaiss = $lieunaiss;

        return $this;
    }

    /**
     * Get lieunaiss
     *
     * @return string
     */
    public function getLieunaiss()
    {
        return $this->lieunaiss;
    }

    /**
     * Set sexe
     *
     * @param string $sexe
     *
     * @return ScoutDeleted
     */
    public function setSexe($sexe)
    {
        $this->sexe = $sexe;

        return $this;
    }

    /**
     * Get sexe
     *
     * @return string
     */
    public function getSexe()
    {
        return $this->sexe;
    }

    /**
     * Set branche
     *
     * @param string $branche
     *
     * @return ScoutDeleted
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
     * Set fonction
     *
     * @param string $fonction
     *
     * @return ScoutDeleted
     */
    public function setFonction($fonction)
    {
        $this->fonction = $fonction;

        return $this;
    }

    /**
     * Get fonction
     *
     * @return string
     */
    public function getFonction()
    {
        return $this->fonction;
    }

    /**
     * Set contact
     *
     * @param string $contact
     *
     * @return ScoutDeleted
     */
    public function setContact($contact)
    {
        $this->contact = $contact;

        return $this;
    }

    /**
     * Get contact
     *
     * @return string
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * Set contactParent
     *
     * @param string $contactParent
     *
     * @return ScoutDeleted
     */
    public function setContactParent($contactParent)
    {
        $this->contactParent = $contactParent;

        return $this;
    }

    /**
     * Get contactParent
     *
     * @return string
     */
    public function getContactParent()
    {
        return $this->contactParent;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return ScoutDeleted
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set carte
     *
     * @param string $carte
     *
     * @return ScoutDeleted
     */
    public function setCarte($carte)
    {
        $this->carte = $carte;

        return $this;
    }

    /**
     * Get carte
     *
     * @return string
     */
    public function getCarte()
    {
        return $this->carte;
    }

    /**
     * Set cotisation
     *
     * @param string $cotisation
     *
     * @return ScoutDeleted
     */
    public function setCotisation($cotisation)
    {
        $this->cotisation = $cotisation;

        return $this;
    }

    /**
     * Get cotisation
     *
     * @return string
     */
    public function getCotisation()
    {
        return $this->cotisation;
    }

    /**
     * Set urgence
     *
     * @param string $urgence
     *
     * @return ScoutDeleted
     */
    public function setUrgence($urgence)
    {
        $this->urgence = $urgence;

        return $this;
    }

    /**
     * Get urgence
     *
     * @return string
     */
    public function getUrgence()
    {
        return $this->urgence;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return ScoutDeleted
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set publieLe
     *
     * @param \DateTime $publieLe
     *
     * @return ScoutDeleted
     */
    public function setPublieLe($publieLe)
    {
        $this->publieLe = $publieLe;

        return $this;
    }

    /**
     * Get publieLe
     *
     * @return \DateTime
     */
    public function getPublieLe()
    {
        return $this->publieLe;
    }

    /**
     * Set supprimeLe
     *
     * @param \DateTime $supprimeLe
     *
     * @return ScoutDeleted
     */
    public function setSupprimeLe($supprimeLe)
    {
        $this->supprimeLe = $supprimeLe;

        return $this;
    }

    /**
     * Get supprimeLe
     *
     * @return \DateTime
     */
    public function getSupprimeLe()
    {
        return $this->supprimeLe;
    }

    /**
     * Set statut
     *
     * @param string $statut
     *
     * @return ScoutDeleted
     */
    public function setStatut($statut)
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * Get statut
     *
     * @return string
     */
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * Set groupe
     *
     * @param string $groupe
     *
     * @return ScoutDeleted
     */
    public function setGroupe($groupe)
    {
        $this->groupe = $groupe;

        return $this;
    }

    /**
     * Get groupe
     *
     * @return string
     */
    public function getGroupe()
    {
        return $this->groupe;
    }

    /**
     * Set district
     *
     * @param string $district
     *
     * @return ScoutDeleted
     */
    public function setDistrict($district)
    {
        $this->district = $district;

        return $this;
    }

    /**
     * Get district
     *
     * @return string
     */
    public function getDistrict()
    {
        return $this->district;
    }

    /**
     * Set region
     *
     * @param string $region
     *
     * @return ScoutDeleted
     */
    public function setRegion($region)
    {
        $this->region = $region;

        return $this;
    }

    /**
     * Get region
     *
     * @return string
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * Set montant
     *
     * @param integer $montant
     *
     * @return ScoutDeleted
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
     * Set montantSansFrais
     *
     * @param integer $montantSansFrais
     *
     * @return ScoutDeleted
     */
    public function setMontantSansFrais($montantSansFrais)
    {
        $this->montantSansFrais = $montantSansFrais;

        return $this;
    }

    /**
     * Get montantSansFrais
     *
     * @return integer
     */
    public function getMontantSansFrais()
    {
        return $this->montantSansFrais;
    }

    /**
     * Set ristourne
     *
     * @param integer $ristourne
     *
     * @return ScoutDeleted
     */
    public function setRistourne($ristourne)
    {
        $this->ristourne = $ristourne;

        return $this;
    }

    /**
     * Get ristourne
     *
     * @return integer
     */
    public function getRistourne()
    {
        return $this->ristourne;
    }
}
