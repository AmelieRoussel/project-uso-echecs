<?php

/**
 * Created by PhpStorm.
 * User: aurelwcs
 * Date: 08/04/19
 * Time: 18:40
 */

namespace App\Controller;

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
     */
    public function index()
    {
        $newsManager = new NewsManager();
        $news = $newsManager->selectAll();
        return $this->twig->render('Home/index.html.twig', [
            'news' => $news,
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
}
