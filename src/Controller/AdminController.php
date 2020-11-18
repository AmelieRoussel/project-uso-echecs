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

    public function addMemberAdmin()
    {
        $inscriptionManager = new InscriptionManager();
        $members = $inscriptionManager->selectAll();
        $data = [];
        $errors = [];
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $data = array_map('trim', $_POST);
            $errors = $this->memberValidation($data);
            if (empty($errors)) {
                $inscriptionManager = new InscriptionManager();
                $inscriptionManager->addMember($data);

                header('Location: /admin/members');
            }
        }

        return $this->twig->render('Admin/adminMembers.html.twig', [
            'errors' => $errors,
            'data' => $data,
            'members' => $members
        ]);
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
    private function memberValidation(array $data)
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
            $errors[] = 'L\'email est requis';
        } elseif (!filter_var($data['inputEmail'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Le format de l\'email est invalide';
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
            $errors[] = 'Le code postal est requis';
        } elseif ((!is_numeric($data['inputPostalCode'])) || (strlen($data['inputPostalCode']) != 5)) {
            $errors[] = 'Votre Code postal n\'est pas correct';
        }
        if (empty($data['inputCity'])) {
            $errors[] = 'La ville  est requise';
        }
        if (strlen($data['inputCity']) > $maxlength) {
            $errors[] = 'La ville ne doit pas avoir plus de ' . $maxlength . ' caractères.';
        }
        return $errors ?? [];
    }
}
