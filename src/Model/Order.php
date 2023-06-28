<?php

namespace App\Model;

class Order
{
    private int $id;

    private string $id_products;

    private string $quantities;

    private int $id_customer;

    private int $status;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getIdProducts(): string
    {
        return $this->id_products;
    }

    /**
     * @param string $id_products
     */
    public function setIdProducts(string $id_products): void
    {
        $this->id_products = $id_products;
    }

    /**
     * @return string
     */
    public function getQuantities(): string
    {
        return $this->quantities;
    }

    /**
     * @param string $quantities
     */
    public function setQuantities(string $quantities): void
    {
        $this->quantities = $quantities;
    }

    /**
     * @return int
     */
    public function getIdCustomer(): int
    {
        return $this->id_customer;
    }

    /**
     * @param int $id_customer
     */
    public function setIdCustomer(int $id_customer): void
    {
        $this->id_customer = $id_customer;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param int $status
     */
    public function setStatus(int $status): void
    {
        $this->status = $status;
    }
}