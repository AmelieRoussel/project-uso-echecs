<?php

namespace App\Model;

class PartnerManager extends AbstractManager
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
