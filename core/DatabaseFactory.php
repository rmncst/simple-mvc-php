<?php
/**
 * Created by PhpStorm.
 * User: rmncs
 * Date: 19/05/2019
 * Time: 21:48
 */

namespace Core;

class DatabaseFactory
{
    /***
     * @var \PDO
     */
    private static $_databaseInstance;

    /***
     * @return \PDO
     */
    public static function getDatabaseInstance() {
        if(! self::$_databaseInstance) {
            $parameters = json_decode(file_get_contents(__DIR__ . '/../conf/settings.json'),true)
                ['database']['default'];
            $db = new Database($parameters['user'], $parameters['password'], $parameters['dbname'], $parameters['host']);

            self::$_databaseInstance =  $db->__connect();

            echo 'asdasd'; die();
        }

        return self::$_databaseInstance;
    }
}