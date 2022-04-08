<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Repository\AnneeScolaireRepository;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Entity(repositoryClass=AnneeScolaireRepository::class)
 * @UniqueEntity(fields={"libelle"},message="Cette année scolaire existe deja choisir une autre")
 * @ApiResource(
 * normalizationContext={"groups"={"annee_scolaire:read"}},
 * collectionOperations = {
 * "get"={
 * "path"="/admin/annees_scolaire"},
 * "post"={ "path"="/admin/annees_scolaire"}
 * },
 * itemOperations= {
 * "get"={
 *  "path"="/admin/annee_scolaire/{id}"}
 * }
 * )
 */
class AnneeScolaire
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"annee_scolaire:read"})    
     */
    public $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"annee_scolaire:read"})
     */
    public $libelle;

    /**
     * @ORM\OneToMany(targetEntity=ClasseAnneeScolaire::class, mappedBy="anneescolaire", cascade={"persist", "remove"})
     * @Groups({"annee_scolaire:read"})
     */
    private $classeAnneeScolaires;

    public function __construct()
    {
        $this->classeAnneeScolaires = new ArrayCollection();
      
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }
    /**
     * @return Collection|ClasseAnneeScolaire[]
     */
    public function getClasseAnneeScolaires(): Collection
    {
        return $this->classeAnneeScolaires;
    }

    public function addClasseAnneeScolaire(ClasseAnneeScolaire $classeAnneeScolaire): self
    {
        if (!$this->classeAnneeScolaires->contains($classeAnneeScolaire)) {
            $this->classeAnneeScolaires[] = $classeAnneeScolaire;
            $classeAnneeScolaire->setAnneescolaire($this);
        }

        return $this;
    }

    public function removeClasseAnneeScolaire(ClasseAnneeScolaire $classeAnneeScolaire): self
    {
        if ($this->classeAnneeScolaires->removeElement($classeAnneeScolaire)) {
            // set the owning side to null (unless already changed)
            if ($classeAnneeScolaire->getAnneescolaire() === $this) {
                $classeAnneeScolaire->setAnneescolaire(null);
            }
        }

        return $this;
    }
      /**
     * Generates the magic method
     * 
     */
    public function __toString(){
        return $this->libelle;
    }
}
