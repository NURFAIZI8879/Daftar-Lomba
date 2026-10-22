<?php

namespace Core;

use PDO;

class Database
{
    public $connection;
    public $statement;

    public function __construct($config, $username = 'root', $password = '')
    {
        $dsn = 'mysql:' . http_build_query($config, '', ';');

        $this->connection = new PDO($dsn, $username, $password, [
           PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    }

    public function query($query, $params = [])
    {
        $this->statement = $this->connection->prepare($query);

        $this->statement->execute($params);

        return $this;
    }

    public function getAll()
    {
        return $this->statement->fetchAll();
    }

    public function get()
    {
        return $this->statement->fetch();
    }

    public function find()
    {
        $result = $this->get();

        if (! $result) {
            abort();
        }

        return $result;
    }

    public function getLastId()
    {
        return $this->connection->lastInsertId();
    }

    public function isParticipant($team_id)
    {
        $isAnimationParticipant =  $this->query('SELECT * FROM peserta_animasi WHERE id_tim  = ?', [$team_id])->get();
        $isGameParticipant =  $this->query('SELECT * FROM peserta_game WHERE id_tim  = ?', [$team_id])->get();
        $isWebsiteParticipant =  $this->query('SELECT * FROM peserta_website WHERE id_tim  = ?', [$team_id])->get();

        if ($isAnimationParticipant || $isGameParticipant || $isWebsiteParticipant) {
            return true;
        } else {
            return false;
        }
    }
}
