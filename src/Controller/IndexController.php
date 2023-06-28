<?php

namespace App\Controller;

use AltoRouter;
use App\Repository\AboutRepository;
use App\Repository\ProductRepository;
use Config\ControllerBase;
use Exception;

class IndexController extends ControllerBase
{
    private ProductRepository $productRepository;
    private AboutRepository $aboutRepository;

    public function __construct(AltoRouter $router)
    {
        parent::__construct($router);
        $this->productRepository = new ProductRepository();
        $this->aboutRepository = new AboutRepository();
    }
    /**
     * @throws Exception
     */
    public function index(): void {
        if ($products = $this->productRepository->getProducts(["unitPriceDiscount"=> "NOT NULL"]) == NULL) {
            $products = $this->productRepository->getProducts();
        }
        $this->render("App\View\Index::index", [[$this->router], $this->user(), $products]);
    }

    /**
     * @throws Exception
     */
    public function generalTerms(): void {
        $generalTerms = $this->aboutRepository->getInfos()->getGeneralTerms();
        $generalTerms = str_replace("&lt;", "<", $generalTerms);
        $generalTerms = str_replace("&gt;", ">", $generalTerms);
        $this->render("App\View\Index::generalTerms", [[$this->router], $this->user(), $generalTerms]);
    }

}