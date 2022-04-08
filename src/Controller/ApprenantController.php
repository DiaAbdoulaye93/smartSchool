<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UserProfileRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Apprenant;
use App\Entity\UserProfile;
use App\Repository\ApprenantRepository;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class ApprenantController extends AbstractController
{
    public function __construct(
        ApprenantRepository $apprenant,
        UserProfileRepository $profil,
        SerializerInterface $serializer,
        UserPasswordHasherInterface $passwordHasher,
        EntityManagerInterface $manager
    ) {
        $this->profil = $profil;
        $this->passwordHasher = $passwordHasher;
        $this->manager = $manager;
        $this->apprenant = $apprenant;
        $this->serializer = $serializer;
    }
    /**
     *@Route(
     *     path="/api/admin/apprenants",
     *     methods={"POST"},
     *     defaults={
     *          "__controller"="App\Controller\ApprenantController::addApprenant",
     *          "__api_resource_class"=Apprenant::class,
     *          "__api_collection_operation_name"="add_apprenant"
     *     }
     * ),
     */
    public function addApprenant(Request $request)
    {
        $apprenant = new  Apprenant();
        $user = $request->request->all();
        foreach ($user as $key => $value) {
            if (array_key_exists($key,  (array)$apprenant)) {
                if (($key != "profil") && ($key != "avatar")) {
                    if (strpos($key, '_')) {
                        if ($key == 'date_naissance') {
                            $apprenant->setDateNaissance(\DateTime::createFromFormat('Y-m-d', $value));
                        }else {
                            $setProperty = 'set' . ucfirst(str_replace(array("_", ""), '', $key));
                            $apprenant->$setProperty($value);
                        }
                    } 
                    else {
                        $setProperty = 'set' . ucfirst($key);
                        $apprenant->$setProperty($value);
                    }
                }
                else{
                    if ($request->files->get("avatar")) {
                        $avatar =   $request->files->get("avatar");
                        $avatar = fopen($avatar->getRealPath(), "rb");
                        $apprenant->setAvatar($avatar);
                    }
                    $user_profil = $this->serializer->denormalize($user["profil"], "App\Entity\UserProfile");
                    $profil_libelle = $user_profil->libelle;
                    $usertype = $this->serializer->denormalize($user, "App\Entity\Apprenant");
                    $apprenant->setRoles(['Role_' . $profil_libelle]);
                    $apprenant->setprofil($user_profil);
                    $apprenant->setDateNaissance(\DateTime::createFromFormat('Y-m-d', $user['date_naissance']));
                    $apprenant->setPassword($this->passwordHasher->hashPassword($usertype, $user['password']));
                }
            }
        }
        dd($apprenant);
        if($user['nom'])
        $apprenant->setNom($user['nom']);

        if($user['prenom'])
        $apprenant->setPrenom($user['prenom']);

        if($user['sex'])
        $apprenant->setSex($user['sex']);

        if($user['username'])
        $apprenant->setUsername($user['username']);

        if($user['date_naissance'])
        $apprenant->setNom($user['date_naissance']);

        if($user['lieu_naissance'])
        $apprenant->setNom($user['lieu_naissance']);

        if($user['telephone'])
        $apprenant->setPrenom($user['telephone']);

        if($user['sex'])
        $apprenant->setSex($user['sex']);

        if($user['nom'])
        $apprenant->setUsername($user['username']);

        if($user['nom_parent'])
        $apprenant->setNomParent($user['nom_parent']);

        if($user['nom_parent'])
        $apprenant->setPrenomParent($user['prenom_parent']);

        if($user['profession_parent'])
        $apprenant->setSex($user['profession_parent']);
     
        if ($request->files->get("avatar")) {
            $avatar =   $request->files->get("avatar");
            $avatar = fopen($avatar->getRealPath(), "rb");
            $apprenant->setAvatar($avatar);
        }
        $user_profil = $this->serializer->denormalize($user["profil"], "App\Entity\UserProfile");
        $profil_libelle = $user_profil->libelle;
        $usertype = $this->serializer->denormalize($user, "App\Entity\Apprenant");
        $apprenant->setRoles(['Role_' . $profil_libelle]);
        $apprenant->setprofil($user_profil);
        $apprenant->setDateNaissance(\DateTime::createFromFormat('Y-m-d', $user['date_naissance']));
        $apprenant->setPassword($this->passwordHasher->hashPassword($usertype, $user['password']));







        
        $this->manager->persist($apprenant);
        $this->manager->flush();
        return $this->json($apprenant, Response::HTTP_CREATED);
    }
}
