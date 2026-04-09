<?php

require_once __DIR__ . '/config.php';

class UserORM extends Model
{
    public static $_table = 'user';
    public static $_id_column = 'id_user';
}

