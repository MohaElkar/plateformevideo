<?php

namespace PV\PlateformeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Video
 *
 * @ORM\Table(name="pv_video")
 * @ORM\Entity(repositoryClass="PV\PlateformeBundle\Repository\VideoRepository")
 */
class Video
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
     * @ORM\Column(name="titre", type="string", length=255)
     *
     * Validation :
     * @Assert\NotBlank(message="Le titre ne peut pas être vide.")
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     *
     * Validation :
     * @Assert\NotBlank(message="La description ne peut pas être vide.")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="lienVideo", type="string", length=255).
     *
     * Validation :
     * @Assert\NotBlank(message="Le lien vidéo ne peut pas être vide.")
     */
    private $lienVideo;

    /**
     * @ORM\ManyToOne(targetEntity="PV\PlateformeBundle\Entity\Categorie")
     * @ORM\JoinColumn(nullable=false)
     *
     * Validation : On demande à ce que l'obj catégorie soit validé suivant ses règles.
     * @Assert\Valid()
     */
    private $categorie;


    /**
     * @ORM\OneToOne(targetEntity="PV\PlateformeBundle\Entity\Image", cascade={"persist"})
     */
    private $image;

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
     * Set titre
     *
     * @param string $titre
     *
     * @return Video
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Video
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set lienVideo
     *
     * @param string $lienVideo
     *
     * @return Video
     */
    public function setLienVideo($lienVideo)
    {
        $this->lienVideo = $lienVideo;

        return $this;
    }

    /**
     * Get lienVideo
     *
     * @return string
     */
    public function getLienVideo()
    {
        return $this->lienVideo;
    }


    /**
     * Set categorie
     *
     * @param \PV\PlateformeBundle\Entity\Categorie $categorie
     *
     * @return Video
     */
    public function setCategorie(\PV\PlateformeBundle\Entity\Categorie $categorie)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return \PV\PlateformeBundle\Entity\Categorie
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * Set image
     *
     * @param \PV\PlateformeBundle\Entity\Image $image
     *
     * @return Video
     */
    public function setImage(\PV\PlateformeBundle\Entity\Image $image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \PV\PlateformeBundle\Entity\Image
     */
    public function getImage()
    {
        return $this->image;
    }
}
