<?php

namespace App\Model;

class PartnersManager extends AbstractManager
{
    /**
     *
     */
    public const TABLE = 'partner';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }
}
