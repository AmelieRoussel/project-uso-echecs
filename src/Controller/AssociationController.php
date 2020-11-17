<?php

namespace App\Controller;

use App\Model\PartnersManager;

class AssociationController extends AbstractController
{
    /**
     * Display partner page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     *
     * @SuppressWarnings(PHPMD)
     */
    public function partner()
    {
        $partnersmanager = new PartnersManager();
        $partners = $partnersmanager->selectAll();

        return $this->twig->render('Association/partner.html.twig', [
            'partners' => $partners
        ]);
    }
}
