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
class LicenseHobbyManager extends AbstractManager
{
    /**
     *
     */
    public const TABLE = 'license_B';

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
        return $this->pdo->query("SELECT * FROM $this->table")->fetchAll();
    }
}
