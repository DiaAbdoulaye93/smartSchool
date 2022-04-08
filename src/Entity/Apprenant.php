<?php

namespace App\Entity;

use App\Repository\ApprenantRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Entity(repositoryClass=ApprenantRepository::class)
 * denormalizationContext={"groups"={"apprenant:write"}}
 * @ApiResource(
     * collectionOperations ={
     *   "get"={"path"="/admin/apprenants"},
     *   "add_apprenant"=
 *     {
 *         "method"="POST",
 *         "path"="/admin/apprenant",
 *      }
     * }, 
     * itemOperations = {
     *  "get"={"path"="/admin/apprenants/{id}"},
     *  "put"={"path"="/admin/apprenant/{id}"},
     * }
     * )
 */
class Apprenant extends User
{
  
    /**
     * @ORM\Column(type="date", nullable=true)
     * @Groups({"apprenant:write"})
     */
    public $date_naissance;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"user:read", "user:write"})
     */
    public $lieu_naissance;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"user:read", "user:write"})
     */
    public $nom_parent;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"user:read", "user:write"})
     */
    public $prenom_parent;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"user:read", "user:write"})
     */
    public $profession_parent;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"user:read", "user:write"})
     */
    public $contact_parent;

    /**
     * @ORM\Column(type="blob", nullable=true)
     */
    public $avatar;

  
    /**
     * @ORM\ManyToOne(targetEntity=ClasseAnneeScolaire::class, inversedBy="apprennant")
     */
    private $classeAnneeScolaire;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->date_naissance;
    }
                   
    public function setDateNaissance(?\DateTimeInterface $date_naissance): self
    {
        $this->date_naissance = $date_naissance;

        return $this;
    }

    public function getLieuNaissance(): ?string
    {
        return $this->lieu_naissance;
    }

    public function setLieuNaissance(?string $lieu_naissance): self
    {
        $this->lieu_naissance = $lieu_naissance;

        return $this;
    }

    public function getNomParent(): ?string
    {
        return $this->nom_parent;
    }

    public function setNomParent(?string $nom_parent): self
    {
        $this->nom_parent = $nom_parent;

        return $this;
    }

    public function getPrenomParent(): ?string
    {
        return $this->prenom_parent;
    }

    public function setPrenomParent(?string $prenom_parent): self
    {
        $this->prenom_parent = $prenom_parent;

        return $this;
    }

    public function getProfessionParent(): ?string
    {
        return $this->profession_parent;
    }

    public function setProfessionParent(?string $profession_parent): self
    {
        $this->profession_parent = $profession_parent;

        return $this;
    }

    public function getContactParent(): ?int
    {
        return $this->contact_parent;
    }

    public function setContactParent(?int $contact_parent): self
    {
        $this->contact_parent = $contact_parent;

        return $this;
    }

    public function getAvatar()
    {
        if($this->avatar)
        {
            $fichier=\stream_get_contents($this->avatar);
            return base64_encode($fichier);
        }
    }

    public function setAvatar($avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }


    public function getClasseAnneeScolaire(): ?ClasseAnneeScolaire
    {
        return $this->classeAnneeScolaire;
    }

    public function setClasseAnneeScolaire(?ClasseAnneeScolaire $classeAnneeScolaire): self
    {
        $this->classeAnneeScolaire = $classeAnneeScolaire;

        return $this;
    }

}
