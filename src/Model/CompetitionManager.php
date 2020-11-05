<?php

/**
 * Created by PhpStorm.
 * User: sylvain
 * Date: 07/03/18
 * Time: 18:20
 * PHP version 7
 */

namespace App\Model;

/**
 *
 */
class CompetitionManager extends AbstractManager
{
    /**
     *
     */
    public const TABLE = 'competition';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    /**
     * @return array
     */
    public function competitionDateArchive(): array
    {
        return $this->pdo->query("SELECT * FROM $this->table WHERE date < NOW()")->fetchAll();
    }

    /**
     * @return array
     */
    public function competitionNewDate(): array
    {
        return $this->pdo->query("SELECT * FROM $this->table WHERE date > NOW()")->fetchAll();
    }
}
