<?php

namespace App\Entity;

use App\Repository\EnseignantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Entity(repositoryClass=EnseignantRepository::class)
 * @ApiResource(
 * collectionOperations = {
 * "get" = {"path" = "/admin/enseignants/list"},
 * "post" = {"path" ="/admin/enseignant/add"}
 * },
 * itemOperations = {
 * "get" ={"path" = "/admin/enseignant/{id}"},
 * "put" ={"path" = "/admin/enseignant/{id}"},
 * "delete" ={"path" = "/admin/enseignant/{id}"}
 * })
 */
class Enseignant extends User
{

   

    /**
     * @ORM\OneToMany(targetEntity=MatiereClasseAnneeScolair::class, mappedBy="enseignant")
     */
    private $matiereClasseAnneeScolairs;

    public function __construct()
    {
        $this->matiereClasseAnneeScolairs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|MatiereClasseAnneeScolair[]
     */
    public function getMatiereClasseAnneeScolairs(): Collection
    {
        return $this->matiereClasseAnneeScolairs;
    }

    public function addMatiereClasseAnneeScolair(MatiereClasseAnneeScolair $matiereClasseAnneeScolair): self
    {
        if (!$this->matiereClasseAnneeScolairs->contains($matiereClasseAnneeScolair)) {
            $this->matiereClasseAnneeScolairs[] = $matiereClasseAnneeScolair;
            $matiereClasseAnneeScolair->setEnseignant($this);
        }

        return $this;
    }

    public function removeMatiereClasseAnneeScolair(MatiereClasseAnneeScolair $matiereClasseAnneeScolair): self
    {
        if ($this->matiereClasseAnneeScolairs->removeElement($matiereClasseAnneeScolair)) {
            // set the owning side to null (unless already changed)
            if ($matiereClasseAnneeScolair->getEnseignant() === $this) {
                $matiereClasseAnneeScolair->setEnseignant(null);
            }
        }

        return $this;
    }

  
  }
