<?php
session_start();
require "../vendor/autoload.php";

use Config\Router;

$router = new Router(new AltoRouter());
$router->dynamic("/", "App\Controller\IndexController::index", "home");
$router->dynamic("/produits", "App\Controller\ProductsController::lists", "products");
$router->dynamic("/produit/[i:EAN]", "App\Controller\ProductsController::retrieve", "product");
$router->dynamic("/connexion", "App\Controller\AuthController::login", "login");
$router->dynamic("/inscription", "App\Controller\AuthController::signup", "signup");
$router->dynamic("/deconnexion", "App\Controller\AuthController::logout", "logout");
$router->dynamic("/mot-de-passe-oublie", "App\Controller\AuthController::forgotPassword", "forgotPassword");
$router->dynamic("/administration", "App\Controller\AdministrationController::index", "administration");
$router->dynamic("/administration/produits", "App\Controller\AdministrationController::products", "administrationProducts");
$router->dynamic("/administration/commandes", "App\Controller\AdministrationController::orders", "administrationOrders");
$router->dynamic("/administration/employes", "App\Controller\AdministrationController::employees", "administrationEmployees");
$router->dynamic("/administration/cgv", "App\Controller\AdministrationController::generalTerms", "administrationGeneralTerms");
$router->dynamic("/administration/produits/modifier[i:EAN]", "App\Controller\AdministrationController::modifyProducts", "administrationModifyProducts");
$router->dynamic("/mon-panier", "App\Controller\ProfileController::seeBasket", "basket");
$router->dynamic("/profil/commandes", "App\Controller\ProfileController::seePastOrders", "orders");
$router->dynamic("/profil/infos", "App\Controller\ProfileController::profileInfos", "profile");
$router->dynamic("/cgv", "App\Controller\IndexController::generalTerms", "generalTerms");

// API routes
$router->dynamic("/api/produits", "App\Controller\APIController::getProducts", "apiProducts");
$router->dynamic("/api/orders", "App\Controller\APIController::getOrders", "apiOrders");
$router->dynamic("/api/modifyQuantityBasket", "App\Controller\APIController::modifyQuantityBasket", "apiModifyQuantityBasket");
$router->dynamic("/api/deleteProductBasket", "App\Controller\APIController::deleteProductBasket", "apiDeleteProductBasket");
$router->run();
