<?php

namespace App\Controller;

use App\Model\PartnerManager;

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
        $partnermanager = new PartnerManager();
        $partners = $partnermanager->selectAll();

        return $this->twig->render('Association/partner.html.twig', [
            'partners' => $partners
        ]);
    }
}
