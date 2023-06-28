<?php

namespace App\View;

class Administration
{
    public function tabs(array $args, string $active): void
    { ?>
        <div class="w-full px-2 py-16 sm:px-0">
            <div class="flex space-x-1 rounded-xl p-1 text-center align-middle">
                <a class="w-full rounded-lg py-2.5 text-sm font-medium leading-5 text-blue-700 ring-white ring-opacity-60 ring-offset-2 ring-offset-blue-400 focus:outline-none focus:ring-2 bg-white shadow<?php if ($active == "index") : ?>tab-active<?php endif; ?>" href="<?= $args[0][0]->generate('administration'); ?>">Accueil</a>
                <a class="w-full rounded-lg py-2.5 text-sm font-medium leading-5 text-blue-700 ring-white ring-opacity-60 ring-offset-2 ring-offset-blue-400 focus:outline-none focus:ring-2 bg-white shadow<?php if ($active == "orders") : ?>tab-active<?php endif; ?>" href="<?= $args[0][0]->generate('administrationOrders'); ?>">Commandes en cours</a>
                <a class="w-full rounded-lg py-2.5 text-sm font-medium leading-5 text-blue-700 ring-white ring-opacity-60 ring-offset-2 ring-offset-blue-400 focus:outline-none focus:ring-2 bg-white shadow<?php if ($active == "products") : ?>tab-active<?php endif; ?>" href="<?= $args[0][0]->generate('administrationProducts'); ?>">Ajouter/&Eacute;diter un produit</a>
                <a class="w-full rounded-lg py-2.5 text-sm font-medium leading-5 text-blue-700 ring-white ring-opacity-60 ring-offset-2 ring-offset-blue-400 focus:outline-none focus:ring-2 bg-white shadow<?php if ($active == "employees") : ?>tab-active<?php endif; ?>" href="<?= $args[0][0]->generate('administrationEmployees'); ?>">Liste des employ&eacute;s</a>
                <a class="w-full rounded-lg py-2.5 text-sm font-medium leading-5 text-blue-700 ring-white ring-opacity-60 ring-offset-2 ring-offset-blue-400 focus:outline-none focus:ring-2 bg-white shadow<?php if ($active == "cgv") : ?>tab-active<?php endif; ?>" href="<?= $args[0][0]->generate('administrationGeneralTerms'); ?>">Modifier les Conditions Générales de Vente</a>
            </div>
        </div>
    <?php
    }

    public function index(array $args): void { ?>
        <div class="ml-8 mr-8 dark:text-white">
            <div class="w-full rounded-lg py-2.5 text-sm font-medium leading-5 text-blue-700 ring-white ring-opacity-60 ring-offset-2 ring-offset-blue-400 focus:outline-none focus:ring-2 shadow">
                <?php $this->tabs($args, "index"); ?>
            </div>

            <h1 class="text-4xl">Bonjour <?= $args[1]->getName(); ?></h1>

            <div class="shadow-lg rounded-lg overflow-hidden">
                <div class="py-3 px-5 text-center">Evolutions des commandes sur l'année</div>
                <canvas class="p-10" id="chartLine"></canvas>
            </div>
        </div>
    <?php


    }
    public function orders(array $args): void {
    ?>

        <div class="ml-8 mr-8 dark:text-white">
            <div class="w-full rounded-lg py-2.5 text-sm font-medium leading-5 text-blue-700 ring-white ring-opacity-60 ring-offset-2 ring-offset-blue-400 focus:outline-none focus:ring-2 shadow">
                <?php $this->tabs($args, "orders"); ?>

                <table class="table-auto w-full">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 dark:text-slate-200">Nom</th>
                            <th class="px-4 py-2 dark:text-slate-200">Produits</th>
                            <th class="px-4 py-2 dark:text-slate-200">Pointure</th>
                            <th class="px-4 py-2 dark:text-slate-200">Couleur</th>
                            <th class="px-4 py-2 dark:text-slate-200">Quantité</th>
                            <th class="px-4 py-2 dark:text-slate-200">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="dark:bg-slate-800">
                        <?php
                        if (!empty($args[3])) {
                            foreach ($args[3] as $product) { 
                                $i = 0;?>
                                <tr>
                                    <td class=" text-slate-900 text-xl text-center align-middle font-medium dark:text-slate-200 mr-10"><?= $args[1]->getName() ?></td>
                                    <td class="text-slate-900 text-xl text-center align-middle font-medium dark:text-slate-200"><?= $product[0]->getName() ?></td>
                                    <td class="text-slate-900 text-xl text-center align-middle font-medium dark:text-slate-200"><?= $product[0]->getSeize() ?></td>
                                    <td class="text-slate-900 text-xl text-center align-middle font-medium dark:text-slate-200"><?= $product[1]->getName() ?></td>
                                    <td class="text-slate-900 text-xl text-center align-middle font-medium dark:text-slate-200"><?= $product[2][$i] ?></td>
                                    <td class="flex justify-center mt-5">
                                        <form action="" method="post">
                                            <button type="submit" class="inline-block px-6 py-2.5 bg-red-600 text-white font-medium text-xm leading-tight uppercase rounded shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-red-800 active:shadow-lg transition duration-150 ease-in-out" name="setStatus" value="<?= $product[0]->getEAN(); ?>">Commande récupérée</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php $i++;
                            }
                        } else { ?>
                            <tr>
                                <td colspan=6 class="text-slate-900 text-xl text-center align-middle font-medium dark:text-slate-200">Il n'y a pas de commandes en cours</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php

    }
    public function products(array $args): void {
    ?>

        <div class="ml-8 mr-8 dark:text-white">
            <div class="w-full rounded-lg py-2.5 text-sm font-medium leading-5 text-blue-700 ring-white ring-opacity-60 ring-offset-2 ring-offset-blue-400 focus:outline-none focus:ring-2 shadow">
                <?php $this->tabs($args, "products"); ?>

                <!-- Button trigger modal -->
                <button type="button" class="px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0
                    active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Ajouter un produit
                </button>
                <table class="table-auto w-full text-white">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 dark:text-slate-200">Nom</th>
                            <th class="px-4 py-2 dark:text-slate-200">Prix</th>
                            <th class="px-4 py-2 dark:text-slate-200">Collection</th>
                            <th class="px-4 py-2 dark:text-slate-200">Stock</th>
                            <th class="px-4 py-2 dark:text-slate-200">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="dark:bg-slate-800">
                        <?php foreach ($args[2] as $product) { ?>
                            <tr>
                                <td class="text-slate-900 text-xl text-center align-middle font-medium dark:text-slate-200 mr-10"><?= $product->getName(); ?></td>
                                <td class="text-slate-900 text-xl text-center align-middle font-medium dark:text-slate-200 mr-10"><?= $product->getIdCollection() ?></td>
                                <td class="text-slate-900 text-xl text-center align-middle font-medium dark:text-slate-200 mr-10"><?= $product->getunitPrice(); ?></td>
                                <td class="text-slate-900 text-xl text-center align-middle font-medium dark:text-slate-200 mr-10"><?= $product->getQuantity(); ?></td>
                                <td class="flex justify-center mt-5">
                                    <a class="p-2 mr-2 h-10 bg-blue-600 text-white rounded-md" href="<?= $args[0][0]->generate("administrationModifyProducts", ["EAN" => $product->getEAN()]) ?>">Modifier</a><br><br>
                                    <form action="" method="post">
                                        <button type="submit" class="p-2 h-10 bg-red-600 text-white rounded-md" name="deleteProduct" value="<?= $product->getEAN(); ?>">Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog relative w-auto pointer-events-none">
                <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">
                    <div class="modal-header flex flex-shrink-0 items-center justify-between p-4 border-b border-gray-200 rounded-t-md">
                        <h5 class="text-xl font-medium leading-normal text-gray-800" id="exampleModalLabel">Ajouter un produit</h5>
                        <button type="button" class="btn-close box-content w-4 h-4 p-1 text-black border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:text-black hover:opacity-75 hover:no-underline" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body relative p-4">
                        <form method="POST" class="mt-5 md:mt-0 md:col-span-2">
                            <input class="form-control mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" type="number" name="EAN" placeholder="Code-barres du produit" required><br>
                            <input class="form-control mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" type="text" name="name" placeholder="Nom du produit" required><br>
                            <input class="form-control mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" type="number" name="price" placeholder="Prix du produit" required><br>
                            <input class="form-control mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" type="number" name="quantity" placeholder="Quantité du produit" required><br>
                            <input class="form-control mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" type="text" name="color" placeholder="Couleur du produit" required><br>
                            <input class="form-control mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" type="number" name="seize" placeholder="Pointure de la paire" required><br>
                            <input class="form-control mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" type="number" name="collection" placeholder="Numéro de collection du produit (si vide, nouvelle collection)"><br>
                            <input class="form-control mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" type="text" name="brand" placeholder="Marque du produit (laissez vide si collection existante)"><br>
                            <button type="submit" class="px-6 py-2.5 bg-purple-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-purple-700 hover:shadow-lg focus:bg-purple-700 focus:shadow-lg focus:outline-none focus:ring-0
                        active:bg-purple-800 active:shadow-lg transition duration-150 ease-in-out" name="addProduct">Enregistrer</button>
                        </form>
                    </div>
                    <div class="modal-footer flex flex-shrink-0 flex-wrap items-center justify-end p-4 border-t border-gray-200 rounded-b-md">
                        <button type="button" class="px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0
                        active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out ml-1" data-bs-dismiss="modal">Fermer</button>
                    </div>
                </div>
            </div>
        </div>


        <!-- Modal -->
        <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto" id="modifyModal" tabindex="-1" aria-labelledby="modifyModalLabel" aria-hidden="true">
            <div class="modal-dialog relative w-auto pointer-events-none">
                <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">
                    <div class="modal-header flex flex-shrink-0 items-center justify-between p-4 border-b border-gray-200 rounded-t-md">
                        <h5 class="text-xl font-medium leading-normal text-gray-800" id="modifyModalLabel">Modifier un produit</h5>
                        <button type="button" class="btn-close box-content w-4 h-4 p-1 text-black border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:text-black hover:opacity-75 hover:no-underline" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body relative p-4">
                        <form method="POST" class="mt-5 md:mt-0 md:col-span-2">

                            <input class="form-control mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" type="number" name="collection" placeholder="Numéro de collection du produit (si vide, nouvelle collection)"><br>
                            <input class="form-control mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" type="text" name="brand" placeholder="Marque du produit (laissez vide si collection existante)"><br>
                            <button type="submit" class="px-6 py-2.5 bg-purple-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-purple-700 hover:shadow-lg focus:bg-purple-700 focus:shadow-lg focus:outline-none focus:ring-0
                        active:bg-purple-800 active:shadow-lg transition duration-150 ease-in-out" name="modifyProduct">Enregistrer</button>
                        </form>
                    </div>
                    <div class="modal-footer flex flex-shrink-0 flex-wrap items-center justify-end p-4 border-t border-gray-200 rounded-b-md">
                        <button type="button" class="px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0
                        active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out ml-1" data-bs-dismiss="modal">Fermer</button>
                    </div>
                </div>
            </div>
        </div>
    <?php

    }
    public function employees(array $args): void {
    ?>
        <div class="ml-8 mr-8 dark:text-white">
            <div class="w-full rounded-lg py-2.5 text-sm font-medium leading-5 text-blue-700 ring-white ring-opacity-60 ring-offset-2 ring-offset-blue-400 focus:outline-none focus:ring-2 shadow">
                <?php $this->tabs($args, "employees"); ?>

                <table class="table-auto w-full">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 dark:text-slate-200">Nom</th>
                            <th class="px-4 py-2 dark:text-slate-200">Prénom</th>
                            <th class="px-4 py-2 dark:text-slate-200">Rôle</th>
                            <?php if ($args[1]->getIsAdmin() == 1) { ?>
                                <th class="px-4 py-2 dark:text-slate-200">Actions</th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody class="dark:bg-slate-800"">
                    <?php
                    foreach ($args[2] as $employee) {
                    ?>
                        <tr class=" h-8 text-center dark:text-white">
                        <td><?= $employee->getName() ?></td>
                        <td><?= $employee->getSurname() ?></td>
                        <td><?= $employee->getIsEmploye() == 1 ? "Employé" : "Admin";  ?></td>
                        <?php if ($args[1]->getIsAdmin() == 1) {
                            if ($employee->getIsAdmin() === true) ?>
                            <td>
                                <form action="" method="post">
                                    <button class="p-2 h-10 bg-blue-600 text-white rounded-md" type="submit" name="setAdmin" value="<?= $employee->getId() ?>">Donner rôle admin</button><br><br>
                                    <button class="p-2 h-10 bg-red-600 text-white rounded-md" type="submit" name="deleteEmploye" value="<?= $employee->getId() ?>">Enlever rôle employé</button>
                                </form>
                            </td>
                        <?php } else { ?>
                            <td>

                            </td>
                        <?php } ?>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto" id="setEmploye" tabindex="-1" aria-labelledby="setEmployeLabel" aria-hidden="true">
            <div class="modal-dialog relative w-auto pointer-events-none">
                <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">
                    <div class="modal-header flex flex-shrink-0 items-center justify-between p-4 border-b border-gray-200 rounded-t-md">
                        <h5 class="text-xl font-medium leading-normal text-gray-800" id="setEmployeLabel">Ajouter un employé</h5>
                        <button type="button" class="btn-close box-content w-4 h-4 p-1 text-black border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:text-black hover:opacity-75 hover:no-underline" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body relative p-4">
                        <form method="POST" class="mt-5 md:mt-0 md:col-span-2">
                            <input class="form-control mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" type="email" name="mail" placeholder="Adresse mail du compte du nouvel employé"><br>
                            <button type="submit" class="px-6 py-2.5 bg-purple-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-purple-700 hover:shadow-lg focus:bg-purple-700 focus:shadow-lg focus:outline-none focus:ring-0
                        active:bg-purple-800 active:shadow-lg transition duration-150 ease-in-out" name="addEmployee">Enregistrer</button>
                        </form>
                    </div>
                    <div class="modal-footer flex flex-shrink-0 flex-wrap items-center justify-end p-4 border-t border-gray-200 rounded-b-md">
                        <button type="button" class="px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0
                        active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out ml-1" data-bs-dismiss="modal">Fermer</button>
                    </div>
                </div>
            </div>
        </div>
    <?php

    }
    public function generalTerms(array $args): void {
    ?>

        <div class="ml-8 mr-8 dark:text-white">
            <div class="w-full rounded-lg py-2.5 text-sm font-medium leading-5 text-blue-700 ring-white ring-opacity-60 ring-offset-2 ring-offset-blue-400 focus:outline-none focus:ring-2 shadow">
                <?php $this->tabs($args, "cgv"); ?>
            </div>
            <form action="" method="post" class="text-center align-middle">
                <h3 class="dark:text-white font-extrabold text-3xl">Conditions Générales de Vente</h3><br>
                <i class="dark:text-white">Les balises HTML sont acceptées.</i><br>
                <textarea name="cgv" id="cgv"><?= $args[2] ?? '' ?></textarea>
                <button name="saveCGV" type="submit" class="test text-white font-bold px-6 py-2 border-2 border-blue-800 bg-blue-900 hover:border-blue-900 rounded-full">Enregistrer</button>
            </form>
        </div>
<?php
    }
}
