<?php

namespace App\DataPersister;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\Entity\BlogPost;
use App\Entity\Admin;
use App\Repository\AdminRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
final class AdminDataPersister implements ContextAwareDataPersisterInterface
{
    private $manager;
    public function __construct(EntityManagerInterface $manager, AdminRepository $admin, UserPasswordHasherInterface $passwordEncoder)
    {
        $this->manager = $manager;
        $this->admin = $admin;
        $this->passwordEncoder = $passwordEncoder;
    }
    public function supports($data, array $context = []): bool
    {
        return $data instanceof Admin;
    }

    public function persist($data, array $context = [])
    {
        if (!($data->id)) {
            $profil = $data->profil->libelle;
            $password = $data->password;
            $data->setPassword($this->passwordEncoder->hashPassword($data, $password));
            $data->setRoles(array("ROLE_".$profil));
            $this->manager->persist($data);
        }
        $this->manager->flush();
       return $data;

    }

    public function remove($data, array $context = [])
    {
        // call your persistence layer to delete $data
    }
}
