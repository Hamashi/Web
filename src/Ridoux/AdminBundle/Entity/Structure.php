<?php
namespace Ridoux\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Structure
 *
 * @ORM\Table(name="structure")
 * @ORM\Entity(repositoryClass="Ridoux\AdminBundle\Repository\StructureRepository")
 */
class Structure
{
	/**
     * @ORM\OneToOne(targetEntity="Ridoux\AdminBundle\Entity\Image", cascade={"persist", "remove"})
	 * @ORM\JoinColumn(nullable=false)
	 */
     private $image;
	
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
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;

	/**
     * @var int
     *
     * @ORM\Column(name="prix", type="integer")
     */
    private $prix;

    /**
     * @var string
     *
     * @ORM\Column(name="dimension", type="string", length=255)
     */
    private $dimension;

    /**
     * @var string
     *
     * @ORM\Column(name="pvc", type="string", length=255)
     */
    private $pvc;

    /**
     * @var string
     *
     * @ORM\Column(name="commentaire", type="string", length=255)
     */
    private $commentaire;

	/**
     * @var int
     *
     * @ORM\Column(name="promotion", type="integer")
     */
    private $promotion;

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
     * Set nom
     *
     * @param string $nom
     *
     * @return Structure
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
     * Set type
     *
     * @param string $type
     *
     * @return Structure
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return Structure
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set prix
     *
     * @param string $prix
     *
     * @return Structure
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return string
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set dimension
     *
     * @param string $dimension
     *
     * @return Structure
     */
    public function setDimension($dimension)
    {
        $this->dimension = $dimension;

        return $this;
    }

    /**
     * Get dimension
     *
     * @return string
     */
    public function getDimension()
    {
        return $this->dimension;
    }

    /**
     * Set pvc
     *
     * @param string $pvc
     *
     * @return Structure
     */
    public function setPvc($pvc)
    {
        $this->pvc = $pvc;

        return $this;
    }

    /**
     * Get pvc
     *
     * @return string
     */
    public function getPvc()
    {
        return $this->pvc;
    }

    /**
     * Set commentaire
     *
     * @param string $commentaire
     *
     * @return Structure
     */
    public function setCommentaire($commentaire)
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    /**
     * Get commentaire
     *
     * @return string
     */
    public function getCommentaire()
    {
        return $this->commentaire;
    }

    /**
     * Set promotion
     *
     * @param integer $promotion
     *
     * @return Structure
     */
    public function setPromotion($promotion)
    {
        $this->promotion = $promotion;

        return $this;
    }

    /**
     * Get promotion
     *
     * @return integer
     */
    public function getPromotion()
    {
        return $this->promotion;
    }

}
