<?php

namespace App\Repository;

use App\Model\Color;
use Config\RepositoryBase;
use PDO;

class ColorRepository extends RepositoryBase
{
    public function getColor(array $params): ?Color {
        $sql = "SELECT * FROM colors WHERE " . $this->generateWhere($params);
        $request = $this->getBDD()->prepare($sql);
        $this->bindParams($request, $params);
        $request->execute();

        $request->setFetchMode(PDO::FETCH_CLASS, Color::class);
        return $request->fetch();
    }

    public function getColors(): Color|bool
    {
        $sql = "SELECT * FROM colors";
        $request = $this->getBDD()->query($sql);

        return $request->fetchAll(PDO::FETCH_CLASS, Color::class);
    }
}