<?php

/**
 * Created by PhpStorm.
 * User: aurelwcs
 * Date: 08/04/19
 * Time: 18:40
 */

namespace App\Controller;

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
        return $this->twig->render('Home/index.html.twig');
    }

    public function contact()
    {
        $errors = [];

        if ($_SERVER["REQUEST_METHOD"] === 'POST') {
            $message = array_map('trim', $_POST);
            $errors = $this->validate($message);

            header('Location: /home/contact/#message');
        }

        return $this->twig->render('Contact/contact.html.twig', [
            'errors' => $errors,
        ]);
    }

    private function validate(array $message): array
    {
        $errors = [];

        if (empty(htmlentities($message['firstname']))) {
            $errors[] = 'Le prénom ne doit pas être vide';
        }
        if (empty(htmlentities($message['lastname']))) {
            $errors[] = 'Le nom ne doit pas être vide';
        }
        if (empty(htmlentities($message['email']))) {
            $errors[] = 'L\'email ne doit pas être vide';
        }
        if (!filter_var($message['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Format email invalide';
        }
        if (empty($message['message'])) {
            $errors[] = 'Veuillez écrire un message';
        }
        return $errors ?? [];
    }
}
