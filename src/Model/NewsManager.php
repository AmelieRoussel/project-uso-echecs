<?php

namespace App\Model;

class NewsManager extends AbstractManager
{
    public const TABLE = 'news';

    public function __construct()
    {
        parent::__construct(self::TABLE);
    }
}
