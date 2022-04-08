<?php
namespace App\DataPersister;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\Entity\BlogPost;
use App\Entity\ClasseAnneeScolaire;
use App\Repository\ClasseAnneeScolaireRepository;
use Doctrine\ORM\EntityManagerInterface;

final class ClasseAnneeScolaireDataPersister implements ContextAwareDataPersisterInterface
{
    private $manager;
    public function __construct(EntityManagerInterface $manager, ClasseAnneeScolaireRepository $classeAnneScolaire)
    {
        $this->manager= $manager;
        $this->classeAnneScolaire= $classeAnneScolaire;    
    }
    public function supports($data, array $context = []): bool
    {
        return $data instanceof ClasseAnneeScolaire;
    }

    public function persist($data, array $context = [])
    {
        if(!($data->id))
        {
        $libelle = $data->classe->libelle.' '.$data->anneescolaire->libelle;
        $data->setLibelle($libelle);
       // dd($data);
        if(!($data->effectif)){
            $data->setEffectif(0);
        }
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