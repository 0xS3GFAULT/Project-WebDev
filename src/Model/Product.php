<?php

namespace App\Model;

class Product
{
    private int $EAN;

    private string $name;

    private int $id_color;

    private int $id_collection;

    private int $seize;

    private int $quantity;

    private float $unitPrice;

    private ?float $unitPriceDiscount;

    /**
     * @return int
     */
    public function getEAN(): int
    {
        return $this->EAN;
    }

    /**
     * @param int $EAN
     */
    public function setEAN(int $EAN): void
    {
        $this->EAN = $EAN;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getIdColor(): int
    {
        return $this->id_color;
    }

    /**
     * @param int $id_color
     */
    public function setIdColor(int $id_color): void
    {
        $this->id_color = $id_color;
    }

    /**
     * @return int
     */
    public function getIdCollection(): int
    {
        return $this->id_collection;
    }

    /**
     * @param int $id_collection
     */
    public function setIdCollection(int $id_collection): void
    {
        $this->id_collection = $id_collection;
    }

    /**
     * @return int
     */
    public function getSeize(): int
    {
        return $this->seize;
    }

    /**
     * @param int $seize
     */
    public function setSeize(int $seize): void
    {
        $this->seize = $seize;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     */
    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }

    /**
     * @return float
     */
    public function getUnitPrice(): float
    {
        return $this->unitPrice;
    }

    /**
     * @param float $unitPrice
     */
    public function setUnitPrice(float $unitPrice): void
    {
        $this->unitPrice = $unitPrice;
    }

    /**
     * @return ?float
     */
    public function getUnitPriceDiscount(): ?float
    {
        return $this->unitPriceDiscount;
    }

    /**
     * @param float $unitPriceDiscount
     */
    public function setUnitPriceDiscount(float $unitPriceDiscount): void
    {
        $this->unitPriceDiscount = $unitPriceDiscount;
    }
}