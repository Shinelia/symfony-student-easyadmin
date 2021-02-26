<?php

namespace App\Controller\Admin;

use App\Entity\Student;
use App\Entity\Project;
use App\Entity\SchoolYear;
use App\Entity\Tag;
use App\Entity\User;
use App\Entity\Article;

use App\Controller\Admin\StudentCrudController;

use EasyCorp\Bundle\EasyAdminBundle\Router\CrudUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        // return parent::index();

        // // redirect to some CRUD controller
        $routeBuilder = $this->get(CrudUrlGenerator::class)->build();

        return $this->redirect($routeBuilder->setController(StudentCrudController::class)->generateUrl());

        // // you can also redirect to different pages depending on the current user
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // // you can also render some template to display a proper Dashboard
        // // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        // return $this->render('dashboard.html.twig');

    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Tableau de bord de la mort qui tue');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');

        yield MenuItem::linkToCrud('Students', 'fas fa-user-graduate', Student::class);
        yield MenuItem::linkToCrud('Projects', 'fas fa-project-diagram', Project::class);
        yield MenuItem::linkToCrud('SchoolYears', 'fas fa-calendar-alt', SchoolYear::class);
        yield MenuItem::linkToCrud('Tags', 'fas fa-tags', Tag::class);
        yield MenuItem::linkToCrud('Users', 'fas fa-user', User::class);
        yield MenuItem::linkToCrud('Articles', 'far fa-newspaper', Article::class);


    }
}
