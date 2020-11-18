<?php

namespace App\Model;

class RankingManager extends AbstractManager
{
    /**
     *
     */
    public const TABLE = 'ranking';
    public const COMPETITION_TABLE = 'competition';
    public const PLAYER_TABLE = 'player';

    /**
     * RankingManager constructor.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    /**
     * @return array
     */
    public function ranking(): array
    {
        return $this->pdo->query("
SELECT position, lastname, firstname, club, name, category, points, performance 
FROM " . self::TABLE . " 
        JOIN " . self::COMPETITION_TABLE . " competition ON competition.id = ranking.competition_id
        JOIN " . self::PLAYER_TABLE . " ON player.id = ranking.player_id")->fetchAll();
    }
}
