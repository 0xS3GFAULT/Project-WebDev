<?php

namespace App\Repository;

use App\Model\Collection;
use Config\RepositoryBase;
use PDO;

class CollectionRepository extends RepositoryBase
{
    public function getCollection(array $params): Collection|bool {
        $sql = "SELECT * FROM collection WHERE " . $this->generateWhere($params);
        $request = $this->getBDD()->prepare($sql);
        $this->bindParams($request, $params);
        $request->execute();

        $request->setFetchMode(PDO::FETCH_CLASS, Collection::class);
        return $request->fetch();
    }

    public function getCollections(array $params): Collection|bool
    {
        $sql = "SELECT * FROM collection WHERE " . $this->generateWhere($params);
        $request = $this->getBDD()->prepare($sql);
        $this->bindParams($request, $params);
        $request->execute();

        return $request->fetchAll(PDO::FETCH_CLASS, Collection::class);
    }

    public function addCollection(Collection $collection): ?Collection {
        $sql = "INSERT INTO collection (id_brand) VALUES ?";
        $request = $this->getBDD()->prepare($sql);
        $request->execute([$collection->getIdBrand()]);

        return $this->getCollection(["id" => $this->getBDD()->lastInsertId()]);
    }
}