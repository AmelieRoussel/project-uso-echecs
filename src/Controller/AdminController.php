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
    public function home()
    {
        return $this->twig->render('Admin/home.html.twig');
    }

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

        return $this->twig->render('Admin/Members/adminMembers.html.twig', [
            'members' => $members,
        ]);
    }

    public function addMemberAdmin()
    {
        $inscriptionManager = new InscriptionManager();
        $members = $inscriptionManager->selectAll();
        $data = [];
        $errorsAdd = [];
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $data = array_map('trim', $_POST);
            $errorsAdd = $this->memberValidation($data);
            if (empty($errorsAdd)) {
                $inscriptionManager = new InscriptionManager();
                $inscriptionManager->addMember($data);

                header('Location: /admin/members');
            }
        }

        return $this->twig->render('Admin/Members/adminMembers.html.twig', [
            'errorsAdd' => $errorsAdd,
            'data' => $data,
            'members' => $members
        ]);
    }

    public function editMember(int $id)
    {
        $inscriptionManager = new InscriptionManager();
        $memberEdit = $inscriptionManager->selectOneById($id);
        $errorsEdit = [];
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $memberEdit = array_map('trim', $_POST);
            $errorsEdit = $this->memberValidation($memberEdit);
            if (empty($errorsEdit)) {
                $inscriptionManager->updateMember($memberEdit);
                header('Location: /admin/members');
            }
        }
        $members = $inscriptionManager->selectAll();
        return $this->twig->render('Admin/Members/adminMembers.html.twig', [
            'errorsEdit' => $errorsEdit,
            'members' => $members,
            'memberEdit' => $memberEdit
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

        if (empty($data['firstname'])) {
            $errors[] = 'Le prénom est requis';
        }
        if (strlen($data['firstname']) > $maxlength) {
            $errors[] = 'Le prénom ne doit pas avoir plus de ' . $maxlength . ' caractères.';
        }
        if (empty($data['lastname'])) {
            $errors[] = 'Le nom est requis';
        }
        if (strlen($data['lastname']) > $maxlength) {
            $errors[] = 'Le nom ne doit pas avoir plus de ' . $maxlength . ' caractères.';
        }
        if (empty($data['email'])) {
            $errors[] = 'L\'email est requis';
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Le format de l\'email est invalide';
        }
        if (empty($data['phone'])) {
            $errors[] = 'Le numéro de téléphone est requis';
        }
        if (empty($data['birthday'])) {
            $errors[] = 'La date de naissance est requise';
        }
        if (empty($data['address'])) {
            $errors[] = 'L\'adresse est requise';
        }
        if (strlen($data['address']) > $maxlength) {
            $errors[] = 'L\'adresse ne doit pas avoir plus de ' . $maxlength . ' caractères.';
        }
        if (empty($data['postal_code'])) {
            $errors[] = 'Le code postal est requis';
        } elseif ((!is_numeric($data['postal_code'])) || (strlen($data['postal_code']) != 5)) {
            $errors[] = 'Votre Code postal n\'est pas correct';
        }
        if (empty($data['city'])) {
            $errors[] = 'La ville  est requise';
        } elseif (strlen($data['city']) > $maxlength) {
            $errors[] = 'La ville ne doit pas avoir plus de ' . $maxlength . ' caractères.';
        }
        return $errors;
    }
}
