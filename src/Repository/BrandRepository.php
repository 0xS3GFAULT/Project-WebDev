<?php

namespace App\Repository;

use App\Model\Brand;
use Config\RepositoryBase;
use PDO;

class BrandRepository extends RepositoryBase
{
    public function getBrand(array $params): ?Brand {
        $sql = "SELECT * FROM brands WHERE " . $this->generateWhere($params);
        $request = $this->getBDD()->prepare($sql);
        $this->bindParams($request, $params);
        $request->execute();

        $request->setFetchMode(PDO::FETCH_CLASS, Brand::class);
        return $request->fetch();
    }

    public function getBrands(): array|bool
    {
        $sql = "SELECT * FROM brands ";
        $request = $this->getBDD()->query($sql);

        return $request->fetchAll(PDO::FETCH_CLASS, Brand::class);
    }

    public function addBrand(Brand $brand): ?Brand {
        $sql = "INSERT INTO brands (name) VALUES ?";
        $request = $this->getBDD()->prepare($sql);
        $request->execute([$brand->getName()]);

        return $this->getBrand(["id" => $this->getBDD()->lastInsertId()]);
    }
}