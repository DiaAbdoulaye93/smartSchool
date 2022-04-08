<?php

namespace App\Entity;

use App\Entity\UserProfile;
use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * denormalizationContext={"groups"={"user:write"}}
 * @UniqueEntity(fields={"username"},message="Veuillez choisir un autre nom d'\utilisateur ")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({"user" = "User", "administrateur" = "Admin", "comptable" = "Comptable", "apprenant" = "Apprenant", "enseignant" = "Enseignant", "surveillant" = "Surveillant"})
 * @ApiResource(
 * collectionOperations={
 *   "get"={
 *   "normalization_context"={"groups"={"user:read"}},
 *   "path"="/admin/users"
 * },
 *   "add_users"=
 *     {
 *       
 *         "method"="POST",
 *         "path"="/admin/users",
 *      }
 *    
 *  },
 * itemOperations={
 *   "get"={
 *        "normalization_context"={"groups"={"user:read"}},
 *        "path"="/admin/user/{id}"
 *   },
 *   "edit_user"={
 *        "method"= "put",
 *        "path"= "/admin/users/{id}"
 *   },
 *  "delete_user"=
 *      {
 *         "method"="delete",
 *         "path"="/admin/user/{id}"
 *      }
 * }
 *)
 * )
 */
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"user:read", "user:write", "matiere:read", "profil:read", "mat_class_an:read","annee_scolaire:read"})
     * 
     */
    public $id;


    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"user:read", "user:write", "matiere:read", "profil:read", "mat_class_an:read","annee_scolaire:read"})
     */
    public $nom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"user:read", "user:write", "matiere:read", "mat_class_an:read","annee_scolaire:read"})
     */
    public $prenom;

    /**
     * @ORM\Column(type="string", length=15)
     * @Groups({"user:read", "user:write", "matiere:read", "mat_class_an:read","annee_scolaire:read"})
     */
    public $sex;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"user:read", "user:write", "matiere:read", "mat_class_an:read", "annee_scolaire:read"})
     */
    public $adresse;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"user:read", "user:write", "matiere:read", "mat_class_an:read", "annee_scolaire:read"})
     */
    public $telephone;
    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Groups({"user:read", "user:write", "matiere:read", "annee_scolaire:read"})
     */
    public $username;

    /**
     * @ORM\Column(type="json")
     */
    public $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    public $password;

    /**
     * @ORM\ManyToOne(targetEntity=UserProfile::class, inversedBy="users" , cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"user:read", "user:write"})
     */
    public $profil;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    public $etat;

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getSex(): ?string
    {
        return $this->sex;
    }

    public function setSex(string $sex): self
    {
        $this->sex = $sex;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(?string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->username;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }


    public function getProfil(): ?UserProfile
    {
        return $this->profil;
    }

    public function setProfil(?UserProfile $profil): self
    {
        $this->profil = $profil;

        return $this;
    }

    public function getEtat(): ?bool
    {
        return $this->etat;
    }

    public function setEtat(?bool $etat): self
    {
        $this->etat = $etat;

        return $this;
    }
}
