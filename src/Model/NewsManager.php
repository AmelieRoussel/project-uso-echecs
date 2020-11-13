<?php

namespace App\Model;

class NewsManager extends AbstractManager
{
    public const TABLE = 'news';

    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    /**
     * @param array $news
     */
    public function addNews(array $news)
    {
        $statement = $this->pdo->prepare('INSERT INTO ' . self::TABLE . ' (title, excerpt, content, cover_image, `date`)
        VALUES (:title, :excerpt, :content, :cover_image, NOW())');
        $statement->bindValue(':title', $news['title'], \PDO::PARAM_STR);
        $statement->bindValue(':excerpt', $news['excerpt'], \PDO::PARAM_STR);
        $statement->bindValue(':content', $news['content'], \PDO::PARAM_STR);
        $statement->bindValue(':cover_image', $news['cover_image']);
        $statement->execute();
    }
}
