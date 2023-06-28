<?php

namespace Config;

use Exception;
use PDO;
use PDOStatement;

class RepositoryBase extends Env
{
    private PDO $bdd;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        parent::__construct();
        $dsn = $this->get('DATABASE_PROTOCOL') . ":host=" . $this->get('DATABASE_HOST') . ";dbname=" . $this->get('DATABASE_NAME') . ";charset=" .$this->get('DATABASE_CHARSET') . ";port=" .$this->get('DATABASE_PORT');
        $this->bdd = new PDO($dsn, $this->get('DATABASE_USERNAME'), $this->get('DATABASE_PASSWORD'));
    }

    public function getBDD(): PDO
    {
        return $this->bdd;
    }

    public function generateWhere(array $params): string
    {
        $where = "";
        if (!empty($params)) {
            $i = count($params);
            foreach ($params as $key => $param) {
                $i--;
                if ($param === NULL) {
                    $where .= $key . " IS NULL ";
                } elseif ($param === "NOT NULL") {
                    $where .= $key . " IS NOT NULL ";
                } else {
                    $where .= $key . " = :" . $key;
                }
                if ($i > 0) {
                    $where = $where . " AND ";
                }
            }
        }
        return $where;
    }

    public function bindParams(PDOStatement $sql, array $params): void
    {
        foreach ($params as $key => $param) {
            if ($param != NULL && $param != "NOT NULL") {
                $param = str_replace($key . " => ", "", $param);
                $param = str_replace("'", "", $param);
                $sql->bindParam(":" . $key, $param);
                $sql->bindValue(":" . $key, $param);
            }
        }
    }

    public function generateSet(array $params): array
    {
        $set = [];
        $set[0] = "";
        $set[1] = "";
        foreach ($params as $key => $param) {
            if (empty($set[0])) {
                $set[0] = $key;
                $set[1] = ":" . $key;
            } else {
                $set[0] = $set[0] . ', ' . $key;

                $set[1] = $set[1] . ", :" . $key;
            }
        }
        return $set;
    }
}