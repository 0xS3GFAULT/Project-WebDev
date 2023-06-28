<?php

namespace App\Repository;

use App\Model\Order;
use Config\RepositoryBase;
use PDO;

class OrderRepository extends RepositoryBase
{
    public function getOrders(array $params = []): ?array {
        $sql = "SELECT * FROM orders WHERE ". $this->generateWhere($params);
        $request = $this->getBDD()->prepare($sql);
        $this->bindParams($request, $params);
        try {
            $request->execute();
            if ($request->rowCount() > 0) {
                $request->setFetchMode(PDO::FETCH_CLASS, Order::class);
                return $request->fetchAll();
            } else {
                return NULL;
            }
        } catch (\Exception $e) {
            print_r($e->getMessage());
            return NULL;
        }
    }

    public function getOrder(array $params): ?Order {
        $sql = "SELECT * FROM orders WHERE ". $this->generateWhere($params);
        $request = $this->getBDD()->prepare($sql);
        $this->bindParams($request, $params);
        $request->execute();

        if($request->rowCount() == 1) {
            $request->setFetchMode(PDO::FETCH_CLASS, Order::class);
            return $request->fetch();
        } else {
            return NULL;
        }
    }

    public function addOrder(Order $order): bool {
        $sql = "INSERT INTO orders(id_products, quantities, id_customer, `status`) VALUES (?, ?, ?, ?)";
        $sql = $this->getBDD()->prepare($sql);
        $sql->execute([$order->getIdProducts(), $order->getQuantities(), $order->getIdCustomer(), $order->getStatus()]);
        return true;
    }

    public function updateOrder(Order $order): bool
    {
        $sql = $this->getBDD()->prepare("UPDATE orders SET id_products = :idProducts, quantities = :quantities, id_customer = :idCustomer, status = :status WHERE id = :id");
        $idProducts = $order->getIdProducts();
        $quantities = $order->getQuantities();
        $idCustomer = $order->getIdCustomer();
        $status = $order->getStatus();
        $id = $order->getId();
        $sql->bindParam(':idProducts', $idProducts);
        $sql->bindParam(':quantities', $quantities);
        $sql->bindParam(':idCustomer', $idCustomer);
        $sql->bindParam(':status', $status);
        $sql->bindParam(':id', $id);
        $sql->execute();
        return true;
    }

    public function getOrdersCount(int $status): int {
        $sql = $this->getBDD()->prepare("SELECT * FROM orders WHERE status = :status");
        $sql->bindParam(":status", $status);
        $sql->execute();
        return $sql->rowCount();
    }
}