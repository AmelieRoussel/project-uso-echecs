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

    /**
     * @param int $id
     */
    public function delete(int $id): void
    {
        // prepared request
        $statement = $this->pdo->prepare("DELETE FROM " . self::TABLE . " WHERE id=:id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();
    }

    public function update(array $item)
    {
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE . " SET 
        `name` = :name,
        `date` = :date,
        `address` = :address,
        `description` = :description,
        `picture` = :picture
        WHERE id=:id");
        $statement->bindValue('id', (int)$item['id'], \PDO::PARAM_INT);
        $statement->bindValue('name', $item['name'], \PDO::PARAM_STR);
        $statement->bindValue('date', $item['date'], \PDO::PARAM_STR);
        $statement->bindValue('address', $item['address'], \PDO::PARAM_STR);
        $statement->bindValue('description', $item['description'], \PDO::PARAM_STR);
        $statement->bindValue('picture', $item['picture'], \PDO::PARAM_STR);


        return $statement->execute();
    }
}
