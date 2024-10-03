<?php

require_once "../util/Misc.php";

enum Division: string
{
    case Administrative = 'Administrative';
    case Client_Support = 'Client Support';
    case Technical_Support = 'Technical Support';
    case Developers = 'Developers';
    case GIS = 'GIS';

    public static function all()
    {
        return Misc::displayEnums(self::cases());
    }
}
