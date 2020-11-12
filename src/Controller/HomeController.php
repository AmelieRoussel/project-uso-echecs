<?php

/**
 * Created by PhpStorm.
 * User: aurelwcs
 * Date: 08/04/19
 * Time: 18:40
 */

namespace App\Controller;

use App\Model\InscriptionManager;
use App\Model\CompetitionManager;
use App\Model\NewsManager;

class HomeController extends AbstractController
{

    /**
     * Display home page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     *
     * @SuppressWarnings(PHPMD)
     */
    public function index()
    {
        $newsManager = new NewsManager();
        $news = $newsManager->selectAll();
        $competitionManager = new CompetitionManager();
        $competitions = $competitionManager->competitionNewDate();
        return $this->twig->render('Home/index.html.twig', [
            'news' => $news,
            'competitions' => $competitions,
        ]);
    }

    public function contact()
    {
        $errors = [];
        $message = [];
        $subjects = [
            [
                'value' => 'association',
                'name' => 'Renseignement sur l\'association'
            ],
            [
                'value' => 'registration',
                'name' => 'Adhésion'
            ],
            [
                'value' => 'competitions',
                'name' => 'Les compétitions'
            ],
            [
                'value' => 'other',
                'name' => 'Autre'
            ],
        ];

        if ($_SERVER["REQUEST_METHOD"] === 'POST') {
            $message = array_map('trim', $_POST);
            $errors = $this->validate($message);
        }

        return $this->twig->render('Contact/contact.html.twig', [
            'errors' => $errors,
            'message' => $message,
            'subjects' => $subjects,
        ]);
    }

    private function validate(array $message): array
    {
        $errors = [];

        if (empty($message['firstname'])) {
            $errors[] = 'Le prénom ne doit pas être vide';
        }
        if (empty($message['lastname'])) {
            $errors[] = 'Le nom ne doit pas être vide';
        }
        if (empty($message['email'])) {
            $errors[] = 'L\'email ne doit pas être vide';
        } elseif (!filter_var($message['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Format email invalide';
        }
        if (empty($message['message'])) {
            $errors[] = 'Veuillez écrire un message';
        }
        if (empty($errors)) {
            $errors[] = 'Merci pour votre message';
        }
        return $errors;
    }

    public function inscription()
    {
        $data = [];
        $errors = [];
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $data = array_map('trim', $_POST);
            $errors = $this->registration($data);
        }
        return $this->twig->render('Home/inscription.html.twig', [
            'errors' => $errors, 'data' => $data]);
    }
    /**
     * Display home page
     *
     * @return array
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     *
     * @SuppressWarnings(PHPMD)
     */
    private function registration(array $data): array
    {
        $errors = [];
        $maxlength = 100;

        if (empty($data['inputFirstname'])) {
            $errors[] = 'Le prénom est requis';
        }
        if (strlen($data['inputFirstname']) > $maxlength) {
            $errors[] = 'Le prénom ne doit pas avoir plus de ' . $maxlength . ' caractères.';
        }
        if (empty($data['inputLastname'])) {
            $errors[] = 'Le nom est requis';
        }
        if (strlen($data['inputLastname']) > $maxlength) {
            $errors[] = 'Le nom ne doit pas avoir plus de ' . $maxlength . ' caractères.';
        }
        if (empty($data['inputEmail'])) {
            $errors[] = 'L\'Email est requis';
        }
        if (!filter_var($data['inputEmail'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Le format de l\'Email est invalide';
        }
        if (empty($data['inputPhone'])) {
            $errors[] = 'Le numéro de téléphone est requis';
        }
        if (empty($data['inputBirthday'])) {
            $errors[] = 'La date de naissance est requise';
        }
        if (empty($data['inputAddress'])) {
            $errors[] = 'L\'adresse est requise';
        }
        if (strlen($data['inputAddress']) > $maxlength) {
            $errors[] = 'L\'adresse ne doit pas avoir plus de ' . $maxlength . ' caractères.';
        }
        if (empty($data['inputPostalCode'])) {
            $errors[] = 'Le code Postal est requis';
        }
        if ((!is_numeric($data['inputPostalCode'])) || (strlen($data['inputPostalCode']) != 5)) {
            $errors[] = 'Votre Code postal n\'est pas correct';
        }
        if (empty($data['inputCity'])) {
            $errors[] = 'La ville  est requise';
        }
        if (strlen($data['inputCity']) > $maxlength) {
            $errors[] = 'La ville ne doit pas avoir plus de ' . $maxlength . ' caractères.';
        }
        if (empty($errors)) {
            $errors[] = 'Votre inscription a bien été prise en compte !';
            $inscription = new InscriptionManager();
            $inscription->addMember($data);
        }
        return $errors;
    }
  
   public function legalNotice()
    {
        return $this->twig->render('Home/legalNotice.html.twig');
    }
}
