<?php

namespace App\Controller;

use AltoRouter;
use App\Repository\BrandRepository;
use App\Repository\CollectionRepository;
use App\Repository\ColorRepository;
use App\Repository\ProductRepository;
use Config\ControllerBase;
use App\Repository\OrderRepository;
use App\Model\Order;
use Exception;

class ProductsController extends ControllerBase
{

    private ProductRepository $productRepository;
    private OrderRepository $orderRepository;
    private BrandRepository $brandRepository;
    private ColorRepository $colorRepository;
    private CollectionRepository $collectionRepository;

    public function __construct(AltoRouter $altoRouter) {
        $this->productRepository = new ProductRepository();
        $this->orderRepository = new OrderRepository();
        $this->brandRepository = new BrandRepository();
        $this->colorRepository = new ColorRepository();
        $this->collectionRepository = new CollectionRepository();
        parent::__construct($altoRouter);
    }

    /**
     * @throws Exception
     */
    public function lists() {
        if (isset($_POST['applyFilters']) AND !isset($_POST['resetFilters'])) {
            $param = ["seize" => $_POST["seize"], "id_brand" => $_POST["brand"]];
            $products = $this->productRepository->getProducts($param);
        } else {
            $products = $this->productRepository->getProducts();
        }
        $brands = $this->brandRepository->getBrands();

        $this->render("App\View\Products::all", [[$this->router], $this->user(), $products, $brands]);
    }

    /**
     * @throws Exception
     */
    public function retrieve(array $params) {
        if (isset($_POST['addProductToBasket'])) {
            $this->addProductBasket(["id_product" => $_POST['id_product']]);
        }
        $product = $this->productRepository->getProduct($params);
        $collection = $this->collectionRepository->getCollection(['id' => $product->getIdCollection()]);
        $brand = $this->brandRepository->getBrand(['id' => $collection->getIdBrand()]);
        $color = $this->colorRepository->getColor(['id' => $product->getIdColor()]);
        $this->render("App\View\Products::show", [[$this->router], $this->user(), $product, $brand, $color]);
    }

    public function addProductBasket(array $params) : bool {
        $order = $this->orderRepository->getOrder(["id_customer" => $this->user()->getId(), "status" => "0"]);
        if ($order === null) {
            $order = new Order();
            $idProducts = $params['id_product'];
            $quantity = "1";
            $order->setIdCustomer($this->user()->getId());
            $order->setStatus(0);
            $order->setIdProducts($idProducts);
            $order->setQuantities($quantity);
            return $this->orderRepository->addOrder($order);
        } else {
            $idProducts = $order->getIdProducts();
            $quantity = $order->getQuantities();
            $idProducts .= ";" . $params['id_product'];
            $quantity .= ";1";
            $order->setIdProducts($idProducts);
            $order->setQuantities($quantity);
            return $this->orderRepository->updateOrder($order);
        }
    }
}