<?php

namespace App\Controller;

use App\Model\NewsManager;

class NewsController extends AbstractController
{

    public const TITLE_LENGTH = 255;
    public const EXCERPT_LENGTH = 1000;
    public const CONTENT_LENGTH = 10000;

    /**
     * Display news admin page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     *
     */
    public function admin()
    {
        $newsManager = new NewsManager();
        $news = $newsManager->selectAll();
        $newsData = [];
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $newsData = array_map('trim', $_POST);
            $errors = $this->newsValidate($newsData, $_FILES['cover_image']);
            if (empty($errors)) {
                $filename = uniqid() . '.' . pathinfo($_FILES['cover_image']['name'], PATHINFO_EXTENSION);
                move_uploaded_file($_FILES['cover_image']['tmp_name'], 'uploads/' . $filename);
                $newsData['cover_image'] = 'file.jpg';
                $newsManager = new NewsManager();
                $newsManager->addNews($newsData);

                header('Location: /news/admin');
            }
        }

        return $this->twig->render('Admin/adminNews.html.twig', [
            'news' => $news,
            'newsData' => $newsData,
            'errors' => $errors,
        ]);
    }

    /**
     * @param array $newsData
     * @param array $files
     * @return array
     *
     *  @SuppressWarnings(PHPMD)
     */
    private function newsValidate(array $newsData, array $files): array
    {
        $errors = [];
        $fileSize = 1000000;
        $authorizedMimes = ['image/jpeg', 'image/png', 'image/gif'];

        if (empty($newsData['title'])) {
            $errors[] = 'Le titre ne doit pas être vide';
        }
        if (strlen($newsData['title']) > self::TITLE_LENGTH) {
            $errors[] = 'Le titre doit faire moins de 255 caractères';
        }
        if (empty($newsData['content'])) {
            $errors[] = 'Le contenu de l\'article ne doit pas être vide';
        }
        if (strlen($newsData['content']) > self::CONTENT_LENGTH) {
            $errors[] = 'Le contenu doit faire moins de 100000 caractères';
        }
        if (empty($newsData['excerpt'])) {
            $errors[] = 'Le contenu de l\'extrait ne doit pas être vide';
        }
        if (strlen($newsData['excerpt']) > self::EXCERPT_LENGTH) {
            $errors[] = 'L\'extrait doit faire moins de 1000 caractères';
        }
        if ($files['size'] > $fileSize) {
            $errors[] = 'Le fichier ne doit pas excéder ' . $fileSize / 1000000 . ' Mo';
        }
        if (empty($files['tmp_name'])) {
            $errors[] = 'Le fichier ne peux pas être manquant';
        }
        if (!empty($files['tmp_name']) && !in_array(mime_content_type($files['tmp_name']), $authorizedMimes)) {
            $errors[] = 'Ce type de fichier n\'est pas valide';
        }

        return $errors ?? [];
    }

    /**
     * Handle item deletion
     *
     * @param int $id
     */
    public function delete(int $id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $newsManager = new NewsManager();
            $newsManager->deleteNews($id);
            header('Location:/news/admin');
        }
    }
}
