<?php

namespace AppBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * Cotisation
 *
 * @ORM\Table(name="cotisation")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CotisationRepository")
 */
class Cotisation
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
     * @ORM\Column(name="annee", type="string", length=255, nullable=true)
     */
    private $annee;

    /**
     * @var string
     *
     * @ORM\Column(name="fonction", type="string", length=255, nullable=true)
     */
    private $fonction;

    /**
     * @var string
     *
     * @ORM\Column(name="carte", type="string", length=255, nullable=true)
     */
    private $carte;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Scout", inversedBy="cotisations")
     * @ORM\JoinColumn(name="scout_id", referencedColumnName="id")
     */
    private $scout;


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
     * Set annee
     *
     * @param string $annee
     *
     * @return Cotisation
     */
    public function setAnnee($annee)
    {
        $this->annee = $annee;

        return $this;
    }

    /**
     * Get annee
     *
     * @return string
     */
    public function getAnnee()
    {
        return $this->annee;
    }

    /**
     * Set fonction
     *
     * @param string $fonction
     *
     * @return Cotisation
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
     * Set scout
     *
     * @param \AppBundle\Entity\Scout $scout
     *
     * @return Cotisation
     */
    public function setScout(\AppBundle\Entity\Scout $scout = null)
    {
        $this->scout = $scout;

        return $this;
    }

    /**
     * Get scout
     *
     * @return \AppBundle\Entity\Scout
     */
    public function getScout()
    {
        return $this->scout;
    }

    /**
     * Set carte
     *
     * @param string $carte
     *
     * @return Cotisation
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
}
