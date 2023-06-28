<?php

namespace App\Model;

class Collection
{
    private int $id;

    private string $id_brand;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getIdBrand(): int
    {
        return $this->id_brand;
    }

    /**
     * @param int $id_brand
     */
    public function setIdBrand(int $id_brand): void
    {
        $this->id_brand = $id_brand;
    }
}