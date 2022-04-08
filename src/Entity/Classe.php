<?php

namespace App\Entity;
use App\Repository\ClasseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=ClasseRepository::class)
 * @UniqueEntity(fields={"libelle"},message="Cette classe existe deja, choisir un autre libelle ")
 * @ApiResource(
 * collectionOperations = {
 * "get"={
 * "path"= "/admin/class/list",
 * "normalization_context" = {"groups"={"class:read"}}
 * },
 * "post" ={"path"="/admin/class/add"}
 * },
 * itemOperations = {
 * "get"={
 * "path"= "/admin/class/{id}",
 * "normalization_context" = {"groups"={"class:read"}}
 * },
 * "put" ={"path"="/admin/class/{id}"}
 * })
 */
class Classe
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    public $libelle;

    /**
     * @ORM\OneToMany(targetEntity=ClasseAnneeScolaire::class, mappedBy="classe")
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
            $classeAnneeScolaire->setClasse($this);
        }

        return $this;
    }

    public function removeClasseAnneeScolaire(ClasseAnneeScolaire $classeAnneeScolaire): self
    {
        if ($this->classeAnneeScolaires->removeElement($classeAnneeScolaire)) {
            // set the owning side to null (unless already changed)
            if ($classeAnneeScolaire->getClasse() === $this) {
                $classeAnneeScolaire->setClasse(null);
            }
        }

        return $this;
    }

}
