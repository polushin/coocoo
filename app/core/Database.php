<?php

namespace app\core;

class Database
{
    private static $instance = null;

    private $connections = [];

    private function __construct(array $config)
    {
        if (is_null($config)) {
            return;
        }

        foreach($config as $connectionName => $connectionParams) {
            $dsn = sprintf("%s:host=%s;dbname=%s;charset=utf8",
                $connectionParams['driver'],
                $connectionParams['host'],
                $connectionParams['database']
            );

            $opt = array(
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
            );

            $connection = new \PDO($dsn, $connectionParams['username'], $connectionParams['password'], $opt);

            $this->addConnection($connectionName, $connection);
        }
    }

    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            $config = Configure::get('database');
            self::$instance = new Database($config);
        }

        return self::$instance;
    }

    private function addConnection($connectionName, $connection)
    {
        $this->connections[$connectionName] = $connection;
    }

    /**
     * @param string $connectionName
     * @return \PDO
     */
    public function getConnection($connectionName = 'default')
    {
        if (isset($this->connections[$connectionName])) {
            return $this->connections[$connectionName];
        }
        return null;
    }

}
