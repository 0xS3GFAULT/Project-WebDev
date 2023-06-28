<?php

namespace App\Repository;

use App\Model\Product;
use Config\RepositoryBase;
use PDO;

class ProductRepository extends RepositoryBase
{
    public function getProducts(array $params = []): ?array {
        if (isset($params["id_brand"]) && !empty($params["id_brand"])) {
            (new CollectionRepository())->getCollection(["id_brand", $params["id_brands"]]);
            unset($params["id_brand"]);
            $params["id_collection"] = $params["id_collections"];
        }
        $sql = "SELECT * FROM products ";
        if (!empty($params)) {
           $sql .= "WHERE " . $this->generateWhere($params);
        }
        $request = $this->getBDD()->prepare($sql);
        if (!empty($params)) {
            $this->bindParams($request, $params);
        }
        $request->execute();

        if ($request->rowCount() > 0) {
            $request->setFetchMode(PDO::FETCH_CLASS, Product::class);
            return $request->fetchAll();
        } else {
            return NULL;
        }
    }

    public function getProduct(array $params): ?Product {
        $sql = "SELECT * FROM products WHERE ". $this->generateWhere($params);
        $request = $this->getBDD()->prepare($sql);
        $this->bindParams($request, $params);
        $request->execute();

        if($request->rowCount() == 1) {
            $request->setFetchMode(PDO::FETCH_CLASS, Product::class);
            return $request->fetch();
        } else {
            return NULL;
        }
    }

    public function addProduct(Product $product): bool {
        $sql = "INSERT INTO products(EAN, name, id_color, id_collection, seize, quantity, unitPrice, unitPriceDiscount) VALUES ('?','?','?','?','?','?','?','?')";
        $sql = $this->getBDD()->prepare($sql);
        $sql->execute([$product->getEAN(), $product->getName(), $product->getIdColor(), $product->getIdCollection(), $product->getSeize(), $product->getQuantity(), $product->getUnitPrice(), $product->getUnitPriceDiscount()]);
        return true;
    }

    public function updateProduct(Product $product): bool {
        $sql = "UPDATE products SET quantity = ?, unitPrice = ?, unitPriceDiscount = ? WHERE EAN = ?";
        $sql = $this->getBDD()->prepare($sql);
        $sql->execute([$product->getQuantity(), $product->getUnitPrice(), $product->getUnitPriceDiscount(), $product->getEAN()]);
        return true;
    }

    public function deleteProduct(Product $product): bool {
        $sql = "DELETE FROM products WHERE EAN = ?";
        $sql = $this->getBDD()->prepare($sql);
        $sql->execute([$product->getEAN()]);
        return true;
    }
}