<?php

namespace App\Controller;

use AltoRouter;
use App\Model\Brand;
use App\Model\Collection;
use App\Model\Product;
use App\Repository\AboutRepository;
use App\Repository\BrandRepository;
use App\Repository\CollectionRepository;
use App\Repository\ColorRepository;
use App\Repository\OrderRepository;
use App\Repository\ProductRepository;
use Config\ControllerBase;
use Exception;

class AdministrationController extends ControllerBase
{
    private ProductRepository $productRepository;
    private OrderRepository $orderRepository;
    private AboutRepository $aboutRepository;
    private ColorRepository $colorRepository;
    private CollectionRepository $collectionRepository;
    private BrandRepository $brandRepository;

    public function __construct(AltoRouter $altoRouter)
    {
        parent::__construct($altoRouter);
        $this->productRepository = new ProductRepository();
        $this->orderRepository = new OrderRepository();
        $this->aboutRepository = new AboutRepository();
        $this->colorRepository = new ColorRepository();
        $this->collectionRepository = new CollectionRepository();
        $this->brandRepository = new BrandRepository();
    }

    /**
     * @throws Exception
     */
    public function index()
    {
        $user = $this->user();
        if ($user != NULL && ($user->getIsAdmin() || $user->getIsEmploye())) {
            $cOrders = $this->orderRepository->getOrdersCount(1);
            $this->render("App\View\Administration::index", [[$this->router], $this->user(), $cOrders]);
        } else {
            header("Location: " . $this->router->generate('home'));
        }
    }

    /**
     * @throws Exception
     */
    public function orders()
    {
        $user = $this->user();
        if ($user != NULL && ($user->getIsAdmin() || $user->getIsEmploye())) {
            if (isset($_POST['setStatus'])) {
                $order = $this->orderRepository->getOrder(["status" => htmlspecialchars($_POST["setStatus"])]);
                $order->setStatus($order->getStatus() + 1);
                $this->orderRepository->updateOrder($order);
                $this->sendEmail("App\Templates\Email\RecuperationCommande::index", ["name" => $this->user()->getName(), "to" => $this->user()->getEmail(), "subject" => "Votre commande vient d'être récupérée", "order_number" => $order->getId()]);
            }
            $orders = $this->orderRepository->getOrders(["status" => "1"]);
            $variables = [];
            if ($orders !== NULL) {
                foreach ($orders as $product) {
                    if ($product !== NULL) {
                        $productsID = explode(";", $product->getIdProducts());
                        $quantity = explode(";", $product->getQuantities());
                        foreach ($productsID as $pID) {
                            $tmp = $this->productRepository->getProduct(["EAN" => $pID]);
                            array_push($variables, [$tmp, $this->colorRepository->getColor(["id" => $tmp->getIdColor()]), $quantity]);
                        }
                    }
                }
            }

            $this->render("App\View\Administration::orders", [[$this->router], $this->user(), $orders, $variables]);
        } else {
            header('Location: ' . $this->router->generate('home'));
        }
    }

    /**
     * @throws Exception
     */
    public function products()
    {
        $user = $this->user();
        if ($user != NULL && ($user->getIsAdmin() || $user->getIsEmploye())) {
            if (isset($_POST['add_product'])) {
                $product = new Product();
                $product->setName(htmlspecialchars($_POST['name']));
                $product->setEAN(htmlspecialchars($_POST['EAN']));
                $product->setUnitPrice(htmlspecialchars($_POST['unitPrice']));
                $product->setQuantity(htmlspecialchars($_POST["quantity"]));
                $product->setSeize(htmlspecialchars($_POST["seize"]));
                $colors = $this->colorRepository->getColor(['name' => htmlspecialchars($_POST['color'])]);
                if ($colors !== false) {
                    $product->setIdColor($colors->getId());
                }
                if (!empty($_POST['collection'])) {
                    $collection = $this->collectionRepository->getCollection(['id' => htmlspecialchars($_POST['collections'])]);
                    $product->setIdCollection($collection->getId());
                } else if (isset($_POST['brand'])) {
                    $collection = new Collection();
                    $brand = $this->brandRepository->getBrand(["name" => htmlspecialchars($_POST["brand"])]);
                    if ($brand === false) {
                        $brand = new Brand();
                        $brand->setName(htmlspecialchars($_POST['brand']));
                        $brand = $this->brandRepository->addBrand($brand);
                    }
                    $collection->setIdBrand($brand->getId());
                    $collection = $this->collectionRepository->addCollection($collection);
                    $product->setIdCollection($collection->getId());
                } else {
                    throw new Exception("Missing either collection or brand");
                }
                $this->productRepository->addProduct($product);
            }

            if (isset($_PODT['deleteProduct'])) {
                $product = $this->productRepository->getProduct(["EAN" => htmlspecialchars($_POST['deleteProduct'])]);
                $this->productRepository->deleteProduct($product);
            }
            $products = $this->productRepository->getProducts();
            $this->render("App\View\Administration::products", [[$this->router], $this->user(), $products]);
        } else {
            header('Location: ' . $this->router->generate('home'));
        }
    }

    /**
     * @throws Exception
     */
    public function employees()
    {
        $user = $this->user();
        if ($user != NULL && ($user->getIsAdmin() || $user->getIsEmploye())) {
            $employeesList = [];
            $employees = $this->userRepository->getUsers(["isEmploye" => 1]);
            if (!is_null($employees)) {
                foreach ($employees as $employee) {
                    array_push($employeesList, $employee);
                }
            }
            $employees = $this->userRepository->getUsers(["isAdmin" => 1]);
            if (!is_null($employees)) {
                foreach ($employees as $employee) {
                    array_push($employeesList, $employee);
                }
            }
            if ($user->getIsAdmin()) {
                if (isset($_POST["addEmploye"])) {
                    $employee = $this->userRepository->getUser(["email" => htmlspecialchars($_POST["mail"])]);
                    $employee->setIsEmploye(true);
                    $this->userRepository->updateUser($employee);
                }

                if (isset($_POST["setAdmin"])) {
                    $employee = $this->userRepository->getUser(["id" => htmlspecialchars($_POST["id"])]);
                    $employee->setIsEmploye(false);
                    $employee->setIsAdmin(true);
                    $this->userRepository->updateUser($employee);
                }

                if (isset($_POST["deleteEmploye"])) {
                    $employee = $this->userRepository->getUser(["id" => htmlspecialchars($_POST["id"])]);
                    $employee->setIsEmploye(false);
                    $employee->setIsAdmin(false);
                    $this->userRepository->updateUser($employee);
                }
                $this->render("App\View\Administration::employees", [[$this->router], $this->user(), $employeesList]);
            }
        } else {
            header('Location: ' . $this->router->generate('home'));
        }
    }

    /**
     * @throws Exception
     */
    public function generalTerms()
    {
        $user = $this->user();
        if ($user != NULL && ($user->getIsAdmin() || $user->getIsEmploye())) {
            $about = $this->aboutRepository->getInfos();
            var_dump($_POST);
            if (isset($_POST['saveCGV'])) {
                $about->setGeneralTerms(htmlspecialchars($_POST['cgv']));
                $this->aboutRepository->setGeneralTerms($about);
            }
            $general_terms = $about->getGeneralTerms();
            $this->render("App\View\Administration::generalTerms", [[$this->router], $this->user(), $general_terms]);
        } else {
            header('Location: ' . $this->router->generate('home'));
        }
    }

    /**
     * @throws Exception
     */
    public function modifyProduct(array $args)
    {
        $user = $this->user();
        if ($user != NULL && ($user->getIsAdmin() || $user->getIsEmploye())) {
            if (isset($_POST['modify'])) {
                $product = $this->productRepository->getProduct(["EAN" => $args[0]]);
                $product->setUnitPrice(htmlspecialchars($_POST['unitPriceDiscount'] ?? 0));
                if (!empty($_POST['unitPrice'])) {
                    $product->setUnitPrice(htmlspecialchars($_POST['unitPrice']));
                }
                if (!empty($_POST['quantity'])) {
                    $product->setQuantity(htmlspecialchars($_POST['quantity']));
                }
                $this->productRepository->updateProduct($product);
                header("Location: " . $this->router->generate('administrationProducts'));
            }
            $this->render("App\View\Administration::modifyProducts", [[$this->router], $this->user()]);
        } else {
            header('Location: ' . $this->router->generate('home'));
        }
    }
}
