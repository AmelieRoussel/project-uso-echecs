<?php

/**
 * Created by PhpStorm.
 * User: sylvain
 * Date: 07/03/18
 * Time: 20:52
 * PHP version 7
 */

namespace App\Model;

use App\Model\Connection;

/**
 * Abstract class handling default manager.
 */
class InscriptionManager extends AbstractManager
{
    private const TABLE = 'registration';

    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    public function addMember($data)
    {
        $query = ("INSERT INTO " . self::TABLE . " 
        (firstname, lastname, email, phone, birthday, address, postal_code, city) 
        VALUES (:inputFirstname,:inputLastname, :inputEmail, :inputPhone, :inputBirthday, :inputAddress, 
        :inputPostalCode, :inputCity)");
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':inputFirstname', $data['inputFirstname']);
        $statement->bindValue(':inputLastname', $data['inputLastname']);
        $statement->bindValue(':inputEmail', $data['inputEmail']);
        $statement->bindValue(':inputPhone', $data['inputPhone']);
        $statement->bindValue(':inputBirthday', $data['inputBirthday']);
        $statement->bindValue(':inputAddress', $data['inputAddress']);
        $statement->bindValue(':inputPostalCode', $data['inputPostalCode']);
        $statement->bindValue(':inputCity', $data['inputCity']);
        $statement->execute();
    }
}
