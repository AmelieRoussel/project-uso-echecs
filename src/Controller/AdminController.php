<?php

namespace App\Controller;

use App\Model\InscriptionManager;

class AdminController extends AbstractController
{
    /**
     * Display members admin page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     *
     */
    public function members()
    {
        $inscriptionManager = new InscriptionManager();
        $members = $inscriptionManager->selectAll();

        return $this->twig->render('Admin/adminMembers.html.twig', [
            'members' => $members,
        ]);
    }
}
