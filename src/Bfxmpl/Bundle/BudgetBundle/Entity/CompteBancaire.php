<?php

namespace Bfxmpl\Bundle\BudgetBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * CompteBancaire
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Bfxmpl\Bundle\BudgetBundle\Entity\CompteBancaireRepository")
 */
class CompteBancaire
{
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
     * @ORM\Column(name="libelle", type="string", length=50)
     */
    private $libelle;

    /**
     * @var string
     *
     * @ORM\Column(name="banque", type="string", length=100)
     */
    private $banque;

    /**
     * @ORM\OneToMany(targetEntity="Ecriture", mappedBy="compteBancaire")
     */
    protected $ecritures;


    public function __construct()
    {
        $this->ecritures = new ArrayCollection();
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
     * @return CompteBancaire
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
     * Set banque
     *
     * @param string $banque
     * @return CompteBancaire
     */
    public function setBanque($banque)
    {
        $this->banque = $banque;

        return $this;
    }

    /**
     * Get banque
     *
     * @return string 
     */
    public function getBanque()
    {
        return $this->banque;
    }

    /**
     * Add ecritures
     *
     * @param \Bfxmpl\Bundle\BudgetBundle\Entity\Ecriture $ecritures
     * @return CompteBancaire
     */
    public function addEcriture(\Bfxmpl\Bundle\BudgetBundle\Entity\Ecriture $ecritures)
    {
        $this->ecritures[] = $ecritures;

        return $this;
    }

    /**
     * Remove ecritures
     *
     * @param \Bfxmpl\Bundle\BudgetBundle\Entity\Ecriture $ecritures
     */
    public function removeEcriture(\Bfxmpl\Bundle\BudgetBundle\Entity\Ecriture $ecritures)
    {
        $this->ecritures->removeElement($ecritures);
    }

    /**
     * Get ecritures
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEcritures()
    {
        return $this->ecritures;
    }
}
