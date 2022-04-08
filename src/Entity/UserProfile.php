<?php
namespace App\Entity;
use App\Repository\UserProfileRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use ApiPlatform\Core\Annotation\ApiResource;
/**
 * @UniqueEntity(fields={"libelle"},message="Ce profil d'utilisateur existe choisir un autre")
 * @ApiResource(
 *  denormalizationContext={"groups"={"profil:write"}},
 *  
 * collectionOperations={
 *    "get"={
 *              "normalization_context"={"groups"={"profil:read"}},
 *              "path"="/admin/profils"
 *           },
 *    "POST"={"path"="/admin/profils"},
 * },
 * itemOperations={
 *    
 *       "get_profil"=
 *      {
 *         "method"="GET",
 *         "path"="/admin/profils/{id}"
 *      },
 *  "update_profile"=
 *      {
 *         "method"="put",
 *         "path"="/admin/profils/{id}"
 *      },
 *  "delete_profil"=
 *      {
 *         "method"="delete",
 *         "path"="/admin/profils/{id}"
 *      }
 *     }
 *
 * )
 * 
 * @ORM\Entity(repositoryClass=ProfileRepository::class)
 *@UniqueEntity(
 * fields={"libelle"},
 * message="Le libelle doit être unique"
 * )
 * @ORM\Entity(repositoryClass=UserProfileRepository::class)
 */
class UserProfile
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"user:read","profil:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @Groups({"user:read", "profil:read"})
     */
    public $libelle;

    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="profil")
     * @Groups({"profil:read"})
     */
    private $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
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
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setProfil($this);
        }

        return $this;
    }
    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if($user->getProfil() === $this) {
                $user->setProfil(null);
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
