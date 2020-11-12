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
     */
    public function admin()
    {
        $newsManager = new NewsManager();
        $news = $newsManager->selectAll();

        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $news = array_map('trim', $_POST);
            $errors = $this->newsValidate($news);
            if (empty($errors)) {
                $newsManager = new NewsManager();
                $newsManager->addNews($news);

                header('Location: /news/admin');
            }
        }

        return $this->twig->render('Admin/adminNews.html.twig', [
            'news' => $news,
            'errors' => $errors,
        ]);
    }

    private function newsValidate(array $news): array
    {
        $errors = [];

        if (empty($news['title'])) {
            $errors[] = 'Le titre ne doit pas être vide';
        }
        if (strlen($news['title']) > self::TITLE_LENGTH) {
            $errors[] = 'Le titre doit faire moins de 255 caractères';
        }
        if (empty($news['content'])) {
            $errors[] = 'Le contenu de l\'article ne doit pas être vide';
        }
        if (strlen($news['content']) > self::CONTENT_LENGTH) {
            $errors[] = 'Le contenu doit faire moins de 100000 caractères';
        }
        if (empty($news['excerpt'])) {
            $errors[] = 'Le contenu de l\'extrait ne doit pas être vide';
        }
        if (strlen($news['excerpt']) > self::EXCERPT_LENGTH) {
            $errors[] = 'L\'extrait doit faire moins de 1000 caractères';
        }
        if (empty($news['cover_image'])) {
            $errors[] = 'Le contenu de l\'image ne doit pas être vide';
        }
        return $errors ?? [];
    }
}
