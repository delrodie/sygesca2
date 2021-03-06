<?php

namespace AppBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * Scout
 *
 * @ORM\Table(name="scout")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ScoutRepository")
 */
class Scout
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
     * @Gedmo\Slug(fields={"nom","prenoms","matricule"})
     * @ORM\Column(name="slug", type="string", length=255)
     */
    private $slug;

    /**
     * @var string
     *
     * @Gedmo\Blameable(on="create")
     * @ORM\Column(name="publie_par", type="string", length=25, nullable=true)
     */
    private $publiePar;

    /**
     * @var string
     *
     * @Gedmo\Blameable(on="update")
     * @ORM\Column(name="modifie_par", type="string", length=25, nullable=true)
     */
    private $modifiePar;

    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="publie_le", type="datetimetz", nullable=true)
     */
    private $publieLe;

    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(name="modifie_le", type="datetimetz", nullable=true)
     */
    private $modifieLe;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Statut")
     * @ORM\JoinColumn(name="statut_id", referencedColumnName="id")
     */
    private $statut;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Groupe", inversedBy="scouts")
     * @ORM\JoinColumn(name="groupe_id", referencedColumnName="id")
     */
    private $groupe;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Cotisation", mappedBy="scout", cascade={"remove"})
     */
    private $cotisations;


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
     * @return Scout
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
     * @return Scout
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
     * @return Scout
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
     * @return Scout
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
     * @return Scout
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
     * @return Scout
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
     * @return Scout
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
     * @return Scout
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
     * @return Scout
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
     * @return Scout
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
     * @return Scout
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
     * Set cotisation
     *
     * @param string $cotisation
     *
     * @return Scout
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
     * Set slug
     *
     * @param string $slug
     *
     * @return Scout
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
     * Set publiePar
     *
     * @param string $publiePar
     *
     * @return Scout
     */
    public function setPubliePar($publiePar)
    {
        $this->publiePar = $publiePar;

        return $this;
    }

    /**
     * Get publiePar
     *
     * @return string
     */
    public function getPubliePar()
    {
        return $this->publiePar;
    }

    /**
     * Set modifiePar
     *
     * @param string $modifiePar
     *
     * @return Scout
     */
    public function setModifiePar($modifiePar)
    {
        $this->modifiePar = $modifiePar;

        return $this;
    }

    /**
     * Get modifiePar
     *
     * @return string
     */
    public function getModifiePar()
    {
        return $this->modifiePar;
    }

    /**
     * Set publieLe
     *
     * @param \DateTime $publieLe
     *
     * @return Scout
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
     * Set modifieLe
     *
     * @param \DateTime $modifieLe
     *
     * @return Scout
     */
    public function setModifieLe($modifieLe)
    {
        $this->modifieLe = $modifieLe;

        return $this;
    }

    /**
     * Get modifieLe
     *
     * @return \DateTime
     */
    public function getModifieLe()
    {
        return $this->modifieLe;
    }

    /**
     * Set statut
     *
     * @param \AppBundle\Entity\Statut $statut
     *
     * @return Scout
     */
    public function setStatut(\AppBundle\Entity\Statut $statut = null)
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * Get statut
     *
     * @return \AppBundle\Entity\Statut
     */
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * Set groupe
     *
     * @param \AppBundle\Entity\Groupe $groupe
     *
     * @return Scout
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
     * Set carte
     *
     * @param string $carte
     *
     * @return Scout
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
     * Constructor
     */
    public function __construct()
    {
        $this->cotisations = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add cotisation
     *
     * @param \AppBundle\Entity\Cotisation $cotisation
     *
     * @return Scout
     */
    public function addCotisation(\AppBundle\Entity\Cotisation $cotisation)
    {
        $this->cotisations[] = $cotisation;

        return $this;
    }

    /**
     * Remove cotisation
     *
     * @param \AppBundle\Entity\Cotisation $cotisation
     */
    public function removeCotisation(\AppBundle\Entity\Cotisation $cotisation)
    {
        $this->cotisations->removeElement($cotisation);
    }

    /**
     * Get cotisations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCotisations()
    {
        return $this->cotisations;
    }

    /**
     * Set urgence
     *
     * @param string $urgence
     *
     * @return Scout
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
}
