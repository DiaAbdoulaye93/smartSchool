<?php

namespace App\Entity;

use App\Repository\AdminRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AdminRepository::class)
 * * @ApiResource(
 * collectionOperations={
      *   "get"={
      *   "path"="/admin/adminsList"
      * },
      *   "add_admin"=
      *     {
      *         "method"="POST",
      *         "path"="/admin/add/admin",
      *      }
      *    
      *  },
      * itemOperations={
      *   "get"={
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
class Admin extends User
{
   

    public function getId(): ?int
    {
        return $this->id;
    }
}
