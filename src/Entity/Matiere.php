<?php

namespace App\Entity;

use App\Repository\MatiereRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use ApiPlatform\Core\Annotation\ApiResource;
/**
 * @ORM\Entity(repositoryClass=MatiereRepository::class)
 * denormalizationContext={"groups"={"matiere:write"}}
 * @UniqueEntity(fields={"libelle"},message="Cette matiere existe choisir un autre libelle")
 * @ApiResource(
 * collectionOperations = {
 * "get" = {
 *           "path" = "admin/matieres/list",
 *           "normalization_context"={"groups"={"matiere:read", "mat_class_an"}}
 * },
 * "post" = {"path" = "admin/matieres/add"},
 * },
 * itemOperations = {
 * "get"= {"path" ="admin/matiere/{id}"},
 * "put" = {"path" = "admin/matiere/{id}"},
 * "delete" = {"path" = "admin/matiere/{id}"} 
 * }
 * )
 */
class Matiere
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"matiere:read","annee_scolaire:read", "mat_class_an:read", "class_anneescolaire:read"})
     */
    private $libelle;

    /**
     * @ORM\OneToMany(targetEntity=MatiereClasseAnneeScolair::class, mappedBy="matiere")
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
            $matiereClasseAnneeScolair->setMatiere($this);
        }

        return $this;
    }

    public function removeMatiereClasseAnneeScolair(MatiereClasseAnneeScolair $matiereClasseAnneeScolair): self
    {
        if ($this->matiereClasseAnneeScolairs->removeElement($matiereClasseAnneeScolair)) {
            // set the owning side to null (unless already changed)
            if ($matiereClasseAnneeScolair->getMatiere() === $this) {
                $matiereClasseAnneeScolair->setMatiere(null);
            }
        }

        return $this;
    }

  
}
