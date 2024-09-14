<?php

require_once "../util/Misc.php";

enum Status: string
{
    case Pending = 'Pending';
    case Accepted = 'Accepted';
    case Cancelled = 'Cancelled';

    public static function all()
    {
        return Misc::displayEnums(self::cases());
    }
}