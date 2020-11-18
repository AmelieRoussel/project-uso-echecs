<?php

/**
 * Created by PhpStorm.
 * User: aurelwcs
 * Date: 08/04/19
 * Time: 18:40
 */

namespace App\Controller;

use App\Model\CompetitionManager;

class AdminCompetitionController extends AbstractController
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
        $competition = $competitionManager->selectAll();
        return $this->twig->render('Admin/adminCompetition.html.twig', [
            'competitions' => $competition,
        ]);
    }

    public function validate(array $item)
    {
        $errors = [];
        $mime = ['image/jpeg', 'image/png', 'image/gif'];

        if (empty($item['name'])) {
            $errors[] = 'Le champ concernant le titre ne doit pas être vide';
        }
        if (empty($item['description'])) {
            $errors[] = 'Le champ concernant le contenu ne doit pas être vide';
        }
        if (empty($item['date'])) {
            $errors[] = 'Le champ concernant la date ne doit pas être vide';
        }
        if (empty($item['address'])) {
            $errors[] = "Le champ concernant l'adrese ne doit pas être vide";
        }
        if (empty($_FILES['picture']['name'])) {
            $errors[] = "Erreur! Aucune image séléctionné.";
        }
        if ($_FILES['picture']['size'] > 1000000) {
            $errors[] = "Erreur! Image trop volumineux.";
        }

        if (!in_array($_FILES['picture']['type'], $mime)) {
            $errors[] = "Erreur! Type d'image invalide.";
        }
        return $errors;
    }

    public function delete()
    {
        if ($_SERVER["REQUEST_METHOD"] === 'POST') {
            $id = $_POST['id'];
            $competitionManager = new CompetitionManager();
            $competitionManager->delete($id);
            header('Location: /AdminCompetition/index');
        }
    }

    public function update(int $id)
    {
        $errors = [];
        $competitionManager = new CompetitionManager();
        $item = $competitionManager->selectOneById($id);
        $initialPicture = $item['picture'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $item = array_map('trim', $_POST);
            $errors = $this->validate($item);

            if (empty($errors)) {
                $uploadDir = 'uploads/';
                if (!empty($_FILES['picture'])) {
                    $extension = pathinfo($_FILES['picture']['name'], PATHINFO_EXTENSION);
                    $filename = uniqid() . '.' . $extension;
                    $uploadFile = $uploadDir . basename($filename);
                    move_uploaded_file($_FILES['picture']['tmp_name'], $uploadFile);
                    $item['picture'] = $filename;
                }
                $competitionManager = new CompetitionManager();
                $competitionManager->update($item);
                unlink('uploads/' . $initialPicture);
            }
        }
        $adminCompetition = new CompetitionManager();
        $competition = $adminCompetition->selectAll();
        return $this->twig->render('Admin/adminCompetition.html.twig', [
            'errors' => $errors,
            'competitions' => $competition,
            'item' => $item,
        ]);
    }
}
