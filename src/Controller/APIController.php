<?php

namespace App\Controller;

use AltoRouter;
use App\Repository\OrderRepository;
use Config\ControllerBase;

class APIController extends ControllerBase
{
    private OrderRepository $orderRepository;

    public function __construct(AltoRouter $router)
    {
        parent::__construct($router);
        $this->orderRepository = new OrderRepository();
    }

    public function modifyQuantityBasket(array $params): string {
        $basket = $this->orderRepository->getOrder(["id_customer" => $this->user()->getId(), "status" => "0"]);
        if ($basket != NULL) {
            $products = explode(";", $basket->getIdProducts());
            $quantities = explode(";", $basket->getQuantities());
            for ($i = 0; $i < count($products); $i++) {
                if ($products[$i] == $params["id_product"]) {
                    $quantities[$i] = $params["quantity"];
                }
            }
            $basket->setQuantities(implode(";", $quantities));
            $this->orderRepository->updateOrder($basket);
            return json_encode($this->orderRepository->getOrder(["id_customer" => $this->user()->getId(), "status" => "0"]));
        }
        return json_encode(false);
    }

    public function deleteProductBasket(array $params): string {
        $basket = $this->orderRepository->getOrder(["id_customer" => $this->user()->getId(), "status" => "0"]);
        if ($basket != NULL) {
            $products = explode(";", $basket->getIdProducts());
            $quantities = explode(";", $basket->getQuantities());
            for ($i = 0; $i < count($products); $i++) {
                if ($products[$i] == $params["id_product"]) {
                    array_splice($products, $i, 1);
                    array_splice($quantities, $i, 1);
                }
            }
            $basket->setIdProducts(implode(";", $products));
            $basket->setQuantities(implode(";", $quantities));
            return json_encode($this->orderRepository->updateOrder($basket));
        }
        return json_encode(false);
    }
}