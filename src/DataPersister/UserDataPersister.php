<?php
namespace App\DataPersister;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\Entity\BlogPost;
use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

final class UserDataPersister implements ContextAwareDataPersisterInterface
{
    private $manager;
    public function __construct(EntityManagerInterface $manager, UserRepository $user, UserPasswordHasherInterface $passwordHasher)
    {
        $this->manager= $manager;
        $this->user= $user;
        $this->passwordHasher= $passwordHasher;
        
        
    }
    public function supports($data, array $context = []): bool
    {
        return $data instanceof User;
    }

    public function persist($data, array $context = [])
    {
        if(!($data->id))
        {
            $profil= $data->profil->libelle;
            $password=$data->password;
            $data->setPassword($this->passwordHasher->hashPassword( $data, $password));
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
?>