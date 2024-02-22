<?php

namespace App\Enums;

enum Guards :string
{
    case USER='web';
    case ADMIN='admin';
}
