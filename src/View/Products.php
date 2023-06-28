<?php

namespace App\View;

use AltoRouter;

class Products
{
    public function all(array $args): void
    { ?>
            <div class="relative mb-8 bg-no-repeat bg-cover dark:bg-darkblue-900" style="background-position: 50%;height: 100px;">
                <div class="absolute top-0 right-0 bottom-0 left-0 w-full h-full bg-fixed">
                    <div class="justify-center text-center items-center">
                        <form method="POST" class="m-0">
                            <div class="grid grid-cols-3 px-4 w-full">
                                <select class="cursor-default rounded-lg bg-white py-2 pl-3 pr-20 text-left shadow-md focus:outline-none focus-visible:border-indigo-500 focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75 focus-visible:ring-offset-2 focus-visible:ring-offset-orange-300 sm:text-sm" name="seize">
                                    <option selected disabled>Pointure</option>
                                    <?php for ($i = 18; $i < 46; $i++) { ?>
                                        <option value="<?= $i ?>" class="relative cursor-default select-none py-2 pl-10 pr-4"><?= $i ?></option>
                                    <?php } ?>
                                </select>
.
                                <select class="cursor-default rounded-lg bg-white py-2 pl-3 pr-20 text-left shadow-md focus:outline-none focus-visible:border-indigo-500 focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75 focus-visible:ring-offset-2 focus-visible:ring-offset-orange-300 sm:text-sm" name="brand">
                                    <option selected disabled>Marque</option>
                                    <?php foreach ($args[3] as $brand) { ?>
                                        <option value="<?= $brand->getName() ?>" class="relative cursor-default select-none py-2 pl-10 pr-4"><?= $brand->getName() ?></option>
                                    <?php } ?>
                                </select>
                            </div><br>
                            <button type="submit" class="btn bg-blue-700 text-white font-extrabold h-12 w-24 rounded-xl" name="applyFilters">Appliquer</button>
                            <button type="submit" class="btn bg-gray-500 text-white font-extrabold h-12 w-24 rounded-xl" name="resetFilters">Réinitialiser</button>
                        </form>
                    </div>
                </div>
            </div>
            <?php
            if(empty($args[2])){ 
                echo "<h1 class='text-3xl text-center text-white align-middle justify-center my-16'>Aucun produit trouvé</h1>";
            } else { ?>
                <div id="products" class="container flex inline-flex gap-2 mx-auto">
                <?php foreach ($args[2] as $val) { ?>
                    <div class="w-full <?php if ($val->getEAN() % 2 != 0) {echo 'rounded-full';} else {echo 'rounded';} ?>">
                        <div class="space-y-5 max-w-sm text-center rounded-3xl p-3 overflow-hidden shadow-lg dark:bg-darkblue-900 border-2 border-blue-800 dark:text-white">
                            <img class="product_image object-cover h-48 w-96 rounded-3xl" src="<?= $args[0][0]->generate('home') ?>/images/products/<?= $val->getEAN() ?>.jpg" alt="<?= $val->getName() ?>">
                            <div class="px-6 py-4 dark:bg-darkblue-900 rounded-3xl">
                                <div class="product_name font-bold text-base dark:text-white text-center mb-4"><?php echo $val->getName(); ?></div>
                                <div class="flex text-center">
                                    <div class="flex-1 font-bold text-blue-400 dark:text-white h-5">Prix</div>
                                    <div class="product_price <?php if ($val->getUnitPriceDiscount() != NULL) {echo 'line-through';} ?> flex-1 dark:text-white h-5"><?php echo $val->getUnitPrice(); ?> €</div>
                                    <?php if($val->getUnitPriceDiscount() != NULL) { ?> <div class="product_pricediscount dark:text-red-400 text-lg h-5"> <?= $val->getUnitPriceDiscount(); ?> €</div><?php } ?>
                                </div>
                            </div>
                            <a href="<?php echo $args[0][0]->generate('product',  ['EAN' => $val->getEAN()]); ?>">
                                <button class="bg-blue-700 hover:bg-blue-600 text-white font-bold py-2 px-4 border-b-4 border-blue-900 hover:border-blue-700 rounded">Accéder au informations du produit</button>
                            </a>
                        </div>
                    </div>
                <?php } ?>
                </div>
            <?php } ?>
            </div>
            <br>
    <?php }
    public function show(array $args): void
    { ?>
        <div class="flex justify-center">
            <div class="md:flex-row md:max-w-xl rounded-lg bg-white shadow-lg w-full">
                <img class="rounded-t-lg md:rounded-none md:rounded-l-lg product_image object-coverrounded-3xl" src="<?= $args[0][0]->generate('home') ?>/images/products/<?= $args[2]->getEAN() ?>.jpg" alt="<?= $args[2]->getName() ?>>" />
                <div class="p-6 dark:bg-darkblue-900 justify-center gap-2">
                    <h2 class="text-2xl font-medium mb-2 product_name font-bold uppercase text-white text-center"><?php echo $args[2]->getName(); ?></h2>
                    <div class="flex text-center">
                        <div class="flex-1 font-bold text-blue-400 text-white h-5">Couleur</div>
                        <div class="product_color flex-1 text-white h-5"><?php echo $args[4]->getName(); ?></div>
                    </div>
                    <div class="flex text-center">
                        <div class="flex-1 font-bold text-blue-400 text-white h-5">Pointure</div>
                        <div class="product_size flex-1 text-white h-5"><?php echo $args[2]->getSeize(); ?></div>
                    </div>
                    <div class="flex text-center">
                        <div class="flex-1 font-bold text-blue-400 text-white h-5">Collection</div>
                        <div class="product_collection flex-1 text-white h-5"><?php echo $args[3]->getName(); ?></div>
                    </div>
                    <div class="flex text-center">
                        <div class="flex-1 font-bold text-blue-400 text-white h-5">Prix</div>
                        <div class="product_price <?php if ($args[2]->getUnitPriceDiscount() != NULL) {echo 'line-through';} ?> flex-1 text-white h-5"><?php echo $args[2]->getUnitPrice(); ?> €</div>
                        <?php if($args[2]->getUnitPriceDiscount() != NULL) { ?> <div class="product_pricediscount dark:text-red-400 text-lg h-5"> <?= $args[2]->getUnitPriceDiscount(); ?> €</div><?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex justify-center mt-10 text-center">
            <form method='POST' id='addProductToBasket'>
                <input type='hidden' value="<?= $args[2]->getEAN() ?>" name="id_product">
            <button name='addProductToBasket' type='submit' class="bg-blue-700 p-5 mb-8 flex-center hover:bg-blue-600 text-white font-bold py-2 px-4 border-b-4 border-blue-900 hover:border-blue-700 rounded">Mettre dans mon panier</button>
            </form>
        </div>
<?php }
} ?>
