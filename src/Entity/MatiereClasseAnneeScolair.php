<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\MatiereClasseAnneeScolairRepository;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ApiResource(
 * collectionOperations={
 * "get"={
 *   "normalization_context"={"groups"={"mat_class_an:read"}},

 * "path"="admin/matiers_class_annee/list"
 * },
 * "post"={
 * "path"="/admin/matiers_class_annee/add"
 * }}
 * )
 * @ORM\Entity(repositoryClass=MatiereClasseAnneeScolairRepository::class)
 */
class MatiereClasseAnneeScolair
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"mat_class_an:read", "class_anneescolaire:read", "annee_scolaire:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"mat_class_an:read", "class_anneescolaire:read", "annee_scolaire:read"})
     */
    private $coefficient;

    /**
     * @ORM\ManyToOne(targetEntity=Matiere::class, inversedBy="matiereClasseAnneeScolairs")
     * @Groups({"mat_class_an:read", "class_anneescolaire:read", "annee_scolaire:read"})
     * 
     */
    private $matiere;

    /**
     * @ORM\ManyToOne(targetEntity=ClasseAnneeScolaire::class, inversedBy="matiereClasseAnneeScolairs", cascade={"persist", "remove"})
     * @Groups({"mat_class_an:read"})
     */
    private $classe_anneescolaire;

    /**
     * @ORM\ManyToOne(targetEntity=Enseignant::class, inversedBy="matiereClasseAnneeScolairs")
     * @Groups({"annee_scolaire:read", "mat_class_an:read"})
     */
    private $enseignant;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCoefficient(): ?int
    {
        return $this->coefficient;
    }

    public function setCoefficient(?int $coefficient): self
    {
        $this->coefficient = $coefficient;

        return $this;
    }

    public function getMatiere(): ?Matiere
    {
        return $this->matiere;
    }

    public function setMatiere(?Matiere $matiere): self
    {
        $this->matiere = $matiere;

        return $this;
    }

    public function getClasseAnneescolaire(): ?ClasseAnneeScolaire
    {
        return $this->classe_anneescolaire;
    }

    public function setClasseAnneescolaire(?ClasseAnneeScolaire $classe_anneescolaire): self
    {
        $this->classe_anneescolaire = $classe_anneescolaire;

        return $this;
    }

    public function getEnseignant(): ?Enseignant
    {
        return $this->enseignant;
    }

    public function setEnseignant(?Enseignant $enseignant): self
    {
        $this->enseignant = $enseignant;

        return $this;
    }
}
