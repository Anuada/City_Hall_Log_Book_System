<?php

require_once "../util/Misc.php";

enum Type: string
{
    case Employee = 'Employee';
    case Visitor = 'Visitor';

    public static function all()
    {
        return Misc::displayEnums(self::cases());
    }
}