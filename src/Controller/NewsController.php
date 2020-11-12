<?php

namespace App\Controller;

use App\Model\NewsManager;

class NewsController extends AbstractController
{
    /**
     * Display home page
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
        return $this->twig->render('Admin/adminNews.html.twig', [
            'news' => $news,
        ]);
    }
}
