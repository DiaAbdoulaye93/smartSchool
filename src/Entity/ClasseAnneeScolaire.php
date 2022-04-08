<?php

namespace App\Entity;
use App\Entity\AnneeScolaire;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ClasseAnneeScolaireRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=ClasseAnneeScolaireRepository::class)
 * @UniqueEntity(fields={"libelle"},message="Cette classe existe deja, choisir un autre libelle ")
 * @ApiResource(
 * collectionOperations = {
 * "get"={
 * "normalization_context"={"groups"={"class_anneescolaire:read"}},
 * "path" = "/admin/classeAnneeScolaires/liste",
 * },
 * "post" = {
 * "path" = "/admin/classeAnneeScolaires/add"}
 * },
 * itemOperations = {
 * "get"    =  {
 * "path" = "/admin/classeAnneeScolaire/{id}"},
 * "put"    =  {"path" = "/admin/classeAnneeScolaire/{id}"},
 * "delete" =  {"path" = "/admin/classeAnneeScolaire/{id}"}
 * })
 */
class ClasseAnneeScolaire
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"class_anneescolaire:read"})
     */
    public $id;
    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"annee_scolaire: read", "class_anneescolaire:read", "mat_class_an:read"})
     */
    public $libelle;

    /**
     * @ORM\ManyToOne(targetEntity=Classe::class, inversedBy="classeAnneeScolaires")
     */
    public $classe;
    /**
     * @ORM\Column(type="integer")
     * @Groups({"annee_scolaire: read", "class_anneescolaire:read"})
     */
    public $effectif;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Groups({"annee_scolaire: read", "class_anneescolaire:read"})
     */
    private $moyenne_general;

    /**
     * @ORM\OneToMany(targetEntity=MatiereClasseAnneeScolair::class, mappedBy="classe_anneescolaire")
     * @Groups({"annee_scolaire:read", "class_anneescolaire:read"})
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

    public function getAnneescolaire(): ?AnneeScolaire
    {
        return $this->anneescolaire;
    }

    public function setAnneescolaire(?AnneeScolaire $anneescolaire): self
    {
        $this->anneescolaire = $anneescolaire;

        return $this;
    }

    public function getClasse(): ?Classe
    {
        return $this->classe;
    }

    public function setClasse(?Classe $classe): self
    {
        $this->classe = $classe;

        return $this;
    }

    public function getEffectif(): ?int
    {
        return $this->effectif;
    }

    public function setEffectif(int $effectif): self
    {
        $this->effectif = $effectif;

        return $this;
    }

    public function getMoyenneGeneral(): ?float
    {
        return $this->moyenne_general;
    }

    public function setMoyenneGeneral(?float $moyenne_general): self
    {
        $this->moyenne_general = $moyenne_general;

        return $this;
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
            $matiereClasseAnneeScolair->setClasseAnneescolaire($this);
        }

        return $this;
    }

    public function removeMatiereClasseAnneeScolair(MatiereClasseAnneeScolair $matiereClasseAnneeScolair): self
    {
        if ($this->matiereClasseAnneeScolairs->removeElement($matiereClasseAnneeScolair)) {
            // set the owning side to null (unless already changed)
            if ($matiereClasseAnneeScolair->getClasseAnneescolaire() === $this) {
                $matiereClasseAnneeScolair->setClasseAnneescolaire(null);
            }
        }

        return $this;
    }   

}
