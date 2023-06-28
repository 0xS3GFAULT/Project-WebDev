<?php

namespace App\Controller;

use AltoRouter;
use App\Model\Order;
use App\Repository\BrandRepository;
use App\Repository\OrderRepository;
use App\Repository\ProductRepository;
use App\Repository\CollectionRepository;
use App\Repository\ColorRepository;
use Config\ControllerBase;
use Exception;

class ProfileController extends ControllerBase
{

    private OrderRepository $orderRepository;
    private ProductRepository $productRepository;
    private ColorRepository $colorRepository;
    private CollectionRepository $collectionRepository;
    private BrandRepository $brandRepository;

    public function __construct(AltoRouter $router)
    {
        parent::__construct($router);
        $this->orderRepository = new OrderRepository();
        $this->productRepository = new ProductRepository();
        $this->colorRepository = new ColorRepository();
        $this->collectionRepository = new CollectionRepository();
        $this->brandRepository = new BrandRepository();
    }

    /**
     * @throws Exception
     */
    public function profileInfos()
    {
        $user = $this->user();
        if (isset($_POST) and !empty($_POST)) {
            foreach ($_POST as $key => $val) {
                switch ($key) {
                    case 'name':
                        $user->setName($val);
                        break;

                    case 'surname':
                        $user->setSurname($val);
                        break;

                    case 'email':
                        $user->setEmail($val);
                        break;

                    case 'password':
                        $user->setPassword($val);
                        break;
                }
            }
            $this->userRepository->updateUser($user);
        }
        $this->render("App\View\Profile::seeProfile", [[$this->router], $user]);
    }

    /**
     * @throws Exception
     */
    public function seeBasket()
    {
        if ($this->user()) {
            $basket = $this->orderRepository->getOrder(["id_customer" => $this->user()->getId(), "status" => "0"]);
            if(isset($_POST['toOrder']) && $basket != NULL) {
                $basket->setStatus(1);
                $this->orderRepository->updateOrder($basket);
                $this->sendEmail("App\Templates\Emails\ConfirmationCommande::index", ["to" => $this->user()->getEmail(), "subject" => "Votre commande a bien été enregistrée", "order_number" => $basket->getId(), "name" => $this->user()->getName()]);
                $basket = $this->orderRepository->getOrder(["id_customer" => $this->user()->getId(), "status" => "0"]);
            }
            $products = [];
            $brands = [];
            $colors = [];
            $quantities = [];
            if ($basket !== NULL) {
                $productsID = explode(";", $basket->getIdProducts());
                $quantities = explode(";", $basket->getQuantities());
                foreach ($productsID as $pID) {
                    $tmp = $this->productRepository->getProduct(["EAN" => $pID]);
                    array_push($products, $tmp);
                    array_push($brands, $this->brandRepository->getBrand(["id" => $this->collectionRepository->getCollection(["id" => $tmp->getIdCollection()])->getIdBrand()]));
                    array_push($colors, $this->colorRepository->getColor(["id" => $tmp->getIdColor()]));
                }
            }
            $this->render("App\View\Profile::seeBasket", [[$this->router], $this->user(), $basket, $products, $brands, $colors, $quantities]);
        } else {
            header("Location: " . $this->router->generate('login'));
        }
    }

    /**
     * @throws Exception
     */
    public function seePastOrders()
    {
        if ($this->user()) {
            $orderInProgress = $this->orderRepository->getOrders(["id_customer" => $this->user()->getId(), "status" => "1"]);
            $orderCompleted = $this->orderRepository->getOrders(["id_customer" => $this->user()->getId(), "status" => "2"]);
            $products = [];
            $collections = [];
            $colors = [];
            if (!is_null($orderInProgress)) {
                $r = $this->getInfosForDisplay($orderInProgress, $products, $collections, $colors);
                $products = $r[0];
                $collections = $r[1];
                $colors = $r[2];
            } if(!is_null($orderCompleted)) {
                $r = $this->getInfosForDisplay($orderCompleted, $products, $collections, $colors);
                $products = $r[0];
                $collections = $r[1];
                $colors = $r[2];
            }

            $this->render("App\View\Profile::seePastOrders", [[$this->router], $this->user(), $products, $collections, $colors, $orderInProgress, $orderCompleted]);
        } else {
            header("Location: " . $this->router->generate('login'));
        }
    }

    private function getInfosForDisplay(array $orders, array $products, array $collections, array $colors): array {
        foreach ($orders as $p) {
            if ($p !== NULL) {
                $productsID = explode(";", $p->getIdProducts());
                foreach ($productsID as $pID) {
                    $tmp = $this->productRepository->getProduct(["EAN" => $pID]);
                    array_push($products, $tmp);
                    array_push($collections, $this->collectionRepository->getCollection(["id" => $tmp->getIdCollection()]));
                    array_push($colors, $this->colorRepository->getColor(["id" => $tmp->getIdColor()]));
                }
            }
        }
        return [$products, $collections, $colors];
    }
}
