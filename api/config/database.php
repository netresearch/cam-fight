<?php
/**
 * Created by PhpStorm.
 * User: tsc
 * Date: 30.11.17
 * Time: 16:45
 */

class Database
{

    public $connection;

    public function getConnection()
    {
        $this->connection = null;

        try {
            $this->connection = new PDO(
                'mysql:host=' . $this->getHost() . ';port=' . $this->getPort() . ';dbname=' . $this->getDbName(),
                $this->getUserName(),
                $this->getPassword()
            );
            $this->connection->exec('set names utf8');
        } catch (PDOException $exception) {
            echo 'Connection error: ' . $exception->getMessage();
        }

        return $this->connection;
    }

    protected function isProd()
    {
        return isset($_ENV['ENVIRONMENT']) && $_ENV['ENVIRONMENT'] === 'prod';
    }

    public function getHost()
    {
        if ($this->isProd()) {
            return $_ENV['HOST_PROD'];
        }

        return $this->host;
    }

    public function getPort()
    {
        if ($this->isProd()) {
            return $_ENV['PORT_PROD'];
        }

        return $this->port;
    }

    public function getDbName()
    {
        if ($this->isProd()) {
            return $_ENV['DB_NAME_PROD'];
        }

        return $this->db_name;
    }

    public function getUserName()
    {
        if ($this->isProd()) {
            return $_ENV['USERNAME_PROD'];
        }

        return $this->username;
    }

    public function getPassword()
    {
        if ($this->isProd()) {
            return $_ENV['PASSWORD_PROD'];
        }

        return $this->password;
    }
}