<?php

namespace App\Entity;

use App\Repository\ComptableRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;


/**
 * @ORM\Entity(repositoryClass=ComptableRepository::class)
 * @ApiResource(
 * collectionOperations = {
 * "get" = {"path" = "/admin/comptable/list"},
 * "post" = {"path" ="/admin/comptable/add"}
 * },
 * itemOperations = {
 * "get" ={"path" = "/admin/comptable/{id}"},
 * "put" ={"path" = "/admin/comptable/{id}"},
 * "delete" ={"path" = "/admin/comptable/{id}"}
 * })
 */

class Comptable extends User
{
   
    public function getId(): ?int
    {
        return $this->id;
    }
}
