<?php

/**
 * Created by PhpStorm.
 * User: aurelwcs
 * Date: 08/04/19
 * Time: 18:40
 */

namespace App\Controller;

use App\Model\CompetitionManager;

class CompetitionController extends AbstractController
{
    /**
     * Display home page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function index()
    {
        $competitionManager = new CompetitionManager();
        $competitions = $competitionManager->selectAll();
        return $this->twig->render('Competition/competition.html.twig', [
            'competitions' => $competitions,
        ]);
    }
}
