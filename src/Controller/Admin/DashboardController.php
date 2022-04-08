<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use App\Entity\User;
use App\Entity\Admin;
use App\Entity\UserProfile;
use App\Entity\Apprenant;
use App\Entity\Comptable;
use App\Entity\Inscription;
use App\Entity\Enseignant;
use App\Entity\Surveillant;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('SmartSchool');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Gestion utilisateurs', 'fas fa-user', User::class);
        yield MenuItem::linkToCrud('Gestion profils', 'fas fa-users', UserProfile::class);
        yield MenuItem::linkToCrud('Gestion Admins', 'fas fa-users-cog', Admin::class);
        yield MenuItem::linkToCrud('Gestion Apprenants', 'fas fa-user-graduate', Apprenant::class);
        yield MenuItem::linkToCrud('Gestion Comptables', 'fas fa-file-invoice-dollar', Comptable::class);
        yield MenuItem::linkToCrud('Gestion Enseignants', 'fas fa-user-tie', Enseignant::class);
        yield MenuItem::linkToCrud('Gestion Surveillants', 'fas fa-school', Surveillant::class);
        yield MenuItem::linkToCrud('Gestion Inscriptions', 'fas fa-prescription', Inscription::class);
    }
}
