<?php

namespace App\Entity;

use App\Repository\SurveillantRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;


/**
 * @ORM\Entity(repositoryClass=SurveillantRepository::class)
 *  @ApiResource(
 * collectionOperations = {
 * "get" = {"path" = "/admin/surveillant/list"},
 * "post" = {"path" ="/admin/surveillant/add"}
 * },
 * itemOperations = {
 * "get" ={"path" = "/admin/surveillant/{id}"},
 * "put" ={"path" = "/admin/surveillant/{id}"},
 * "delete" ={"path" = "/admin/surveillant/{id}"}
 * })
 */
class Surveillant extends User
{
   

    public function getId(): ?int
    {
        return $this->id;
    }
}
