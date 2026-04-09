<?php

require_once __DIR__ . '/config.php';

class ProviderORM extends Model
{
    public static $_table = 'provider';
    public static $_id_column = 'id_provider';
}