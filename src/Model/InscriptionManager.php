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
        $statement->bindValue(':inputFirstname', $data['firstname']);
        $statement->bindValue(':inputLastname', $data['lastname']);
        $statement->bindValue(':inputEmail', $data['email']);
        $statement->bindValue(':inputPhone', $data['phone']);
        $statement->bindValue(':inputBirthday', $data['birthday']);
        $statement->bindValue(':inputAddress', $data['address']);
        $statement->bindValue(':inputPostalCode', $data['postal_code']);
        $statement->bindValue(':inputCity', $data['city']);
        $statement->execute();
    }

    public function updateMember(array $member)
    {
        $query = ('UPDATE ' . self::TABLE . ' SET firstname = :firstname, lastname = :lastname, email = :email, ' .
            'phone = :phone, birthday = :birthday, address = :address, postal_code = :postal_code, city = :city ' .
            'WHERE id = :id');
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':id', $member['id'], \PDO::PARAM_INT);
        $statement->bindValue(':firstname', $member['firstname'], \PDO::PARAM_STR);
        $statement->bindValue(':lastname', $member['lastname'], \PDO::PARAM_STR);
        $statement->bindValue(':email', $member['email'], \PDO::PARAM_STR);
        $statement->bindValue(':phone', $member['phone']);
        $statement->bindValue(':birthday', $member['birthday']);
        $statement->bindValue(':address', $member['address'], \PDO::PARAM_STR);
        $statement->bindValue(':postal_code', $member['postal_code']);
        $statement->bindValue(':city', $member['city'], \PDO::PARAM_STR);
        $statement->execute();
    }

    public function delete(int $id)
    {
        $statement = $this->pdo->prepare("DELETE FROM " . self::TABLE . " WHERE id=:id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();
    }
}
