<?php

namespace App\View;

class Profile
{
	public function seeBasket(array $args): void { ?>
		<section class="text-gray-700 h-32">
			<div class="w-full">
				<div class="flex flex-wrap">
					<div class="w-full p-1 md:p-2">
						<div class="text-blue-700 dark:text-white space-y-10 text-center">
							<h2 class="font-bold text-5xl mb-4">Mon panier</h2>
							<h2 class="text-xl mb-6">Tous les articles que vous sélectionnez se retrouvent ici, dans votre panier virtuel. Vous pouvez modifier votre panier en supprimant ou en ajoutant des articles à votre guise !</h2>
						</div>
					</div>
				</div>
			</div>
		</section>

		<div class="mb-3 p-5 mb-5">
			<table class="table-auto w-full dark:bg-darkblue-900 border-2 rounded-xl divide-y dark:text-white text-blue-500 dark:divide-blue-600">
				<thead class="mb-5 dark:text-white justify-center w-full">
					<tr class="w-full">
						<th>
							<p class="inline-block px-6 py-6 text-lg leading-tight uppercase rounded shadow-md transition duration-150 ease-in-out font-bold text-center pointer-events-none">Image</p>
						</th>
						<th>
							<p class="inline-block px-6 py-6 text-lg leading-tight uppercase rounded shadow-md transition duration-150 ease-in-out font-bold text-center pointer-events-none">Nom</p>
						</th>
                        <th>
                            <p class="inline-block px-6 py-6 text-lg leading-tight uppercase rounded shadow-md transition duration-150 ease-in-out font-bold text-center pointer-events-none">Marque</p>
                        </th>
						<th>
							<p class="inline-block px-6 py-6 text-lg leading-tight uppercase rounded shadow-md transition duration-150 ease-in-out font-bold text-center pointer-events-none">Couleur</p>
						</th>
						<th>
							<p class="inline-block px-6 py-6 text-lg leading-tight uppercase rounded shadow-md transition duration-150 ease-in-out font-bold text-center pointer-events-none">Pointure</p>
						</th>
						<th>
							<p class="inline-block px-6 py-6 text-lg leading-tight uppercase rounded shadow-md transition duration-150 ease-in-out font-bold text-center pointer-events-none">Quantité</p>
						</th>
						<th>
							<p class="inline-block px-6 py-6 text-lg leading-tight uppercase rounded shadow-md transition duration-150 ease-in-out font-bold text-center pointer-events-none">Prix</p>
						</th>
						<th>
							<p class="inline-block px-6 py-6 text-lg leading-tight uppercase rounded shadow-md transition duration-150 ease-in-out font-bold text-center pointer-events-none">Actions</p>
						</th>
					</tr>
				</thead>
				<tbody class="overflow-auto divide-y dark:divide-blue-600">
                    <?php
                    if (!empty($args[3])) {
                        $i = 0;
                        foreach ($args[3] as $product) { ?>
                            <tr id="row_product_<?= $product->getEAN() ?>">
                                <td><img class="w-20 h-20 content-center rounded-sm" src="<?= $args[0][0]->generate('home') ?>images/products/<?= $product->getEAN() ?>.jpg" alt="<?= $product->getName() ?>"></td>
                                <td class="text-slate-900 text-xl text-center align-middle font-medium dark:text-slate-200 mr-10"><?= $product->getName() ?></td>
                                <td class="text-slate-900 text-xl text-center align-middle font-medium dark:text-slate-200"><?= $args[4][$i]->getName() ?></td>
                                <td class="text-slate-900 text-xl text-center align-middle font-medium dark:text-slate-200"><?= $args[5][$i]->getName() ?></td>
                                <td class="text-slate-900 text-xl text-center align-middle font-medium dark:text-slate-200"><?= $product->getSeize() ?></td>
                                <td class="flex justify-center mt-5">
                                    <input type="number" value="<?= intval($args[6][$i]) ?>" onchange="modifyQuantity(<?= $product->getEAN() ?>, this.value)" class="form-control block dark:bg-darkblue-900 px-3 py-1.5 text-base font-normal text-white bg-clip-padding border border-solid border-blue-600 rounded transition ease-in-out focus:outline-none" placeholder="Quantité" min="1" />
                                </td>
                                <td class="text-slate-900 text-xl text-center align-middle font-medium dark:text-slate-200"><?= $product->getUnitPriceDiscount() ?? $product->getUnitPrice() ?> €</td>
                                <td class="flex justify-center mt-5">
                                    <button onclick="deleteProduct(<?= $product->getEAN() ?>)" type="button" class="inline-block px-6 py-2.5 bg-red-600 text-white font-medium text-xm leading-tight uppercase rounded shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-red-800 active:shadow-lg transition duration-150 ease-in-out">Supprimer</button>
                                </td>
                            </tr>
                        <?php $i++;
                        }
                    } else { ?>
                        <tr class="h-20">
                            <td colspan="8" class="text-slate-900 text-5xl text-center align-middle font-medium dark:text-slate-200 mr-10">Il n'y a rien dans votre panier.</td>
                        </tr>
                    <?php } ?>
				</tbody>
			</table>

            <?php if(!empty($args[3])) { ?>
                <form action="" method="post" class="flex justify-center mt-5">
                    <button type="submit" class="btn bg-blue-600 text-white px-6 py-2.5 font-medium text-xm leading-tight uppercase rounded shadow-md" name="toOrder">Commander</button>
                </form>
            <?php } ?>
		</div>
	<?php }

	public function seeProfile(array $args): void { ?>
		<section class="overflow-hidden text-gray-700 ">
			<div class="container px-5 py-2">
				<div class="flex flex-wrap -m-1 md:-m-2">
					<div class="flex flex-wrap w-full pl-96">
						<div class="w-full p-1 md:p-2">
							<div class="p-12 text-center relative overflow-hidden bg-no-repeat bg-cover" style="height: 200px;">
								<div class="absolute top-0 right-0 bottom-0 left-0 w-full h-full overflow-hidden">
									<div class="flex justify-center items-center h-15">
										<div class="text-white space-y-10">
											<h2 class="font-bold text-5xl mb-4 dark:text-white text-blue-700 text-center">Profil</h2>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<div class="container w-50 mx-auto overflow-hidden text-gray-700 grid grid-cols-3 gap-4 justify-center">
			<div class="justify-center">
				<p class="text-xl mb-10 pt-2 dark:text-white text-blue-700 text-center">Nom :</p>
				<p class="text-xl mb-10 pt-2 dark:text-white text-blue-700 text-center">Prénom :</p>
				<p class="text-xl mb-10 pt-2 dark:text-white text-blue-700 text-center">Email :</p>
				<p class="text-xl pt-1 dark:text-white text-blue-700 text-center">Mot de passe :</p>
			</div>
			<div class="justify-center">
				<form id="profile" method="POST">
					<div class="mb-6">
						<input id="name_profile" type="text" class="form-control dark:bg-darkblue-900 dark:text-white text-black block w-full px-4 py-2 text-xl font-normal bg-white bg-clip-padding border-2 border-blue-600 rounded dark:border-blue-800 transition ease-in-out m-0 focus:outline-none" placeholder=<?php echo $args[1]->getName(); ?> name="name" />
						<p id="email_field_error2" class="italic text-red-700 dark:text-red-400"></p>
					</div>
					<div class="mb-6">
						<input id="surname_profile" type="text" class="form-control dark:bg-darkblue-900 dark:text-white text-black block w-full px-4 py-2 text-xl font-normal bg-white bg-clip-padding border-2 border-blue-600 rounded dark:border-blue-800 transition ease-in-out m-0 focus:outline-none" placeholder=<?php echo $args[1]->getSurName(); ?> name="surname" />
						<p id="email_field_error2" class="italic text-red-700 dark:text-red-400"></p>
					</div>

					<!-- Email input -->
					<div class="mb-6">
						<input id="email_profile" type="email" class="form-control dark:bg-darkblue-900 dark:text-white text-black block w-full px-4 py-2 text-xl font-normal bg-white bg-clip-padding border-2 border-blue-600 rounded dark:border-blue-800 transition ease-in-out m-0 focus:outline-none" placeholder=<?php echo $args[1]->getEmail(); ?> name="email" />
						<p id="email_field_error2" class="italic text-red-700 dark:text-red-400"></p>
					</div>

					<!-- Password input -->
					<div class="mb-6">
						<input id="connect_password_input" type="password" class="form-control block w-full px-4 py-2 text-xl font-normal dark:bg-darkblue-900 dark:text-white bg-clip-padding border-2 rounded dark:border-blue-800 border-blue-600 transition text-black ease-in-out m-0 focus:outline-none" placeholder="Mot de passe" name="password" required />
						<div class="form-check">
							<input onclick="hidePassword('connect_password_input')" class="form-check-input appearance-none h-4 w-4 border-2 border-blue-600 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain mr-2 float-left cursor-pointer" type="checkbox" value="">
							<label class="form-check-label inline-block text-blue-700 font-bold dark:text-gray-400">Cliquez pour afficher le mot de passe</label>
							<p id="password_field_error2" class="italic text-red-700 dark:text-red-400"></p>
						</div>
					</div>

					<div class="space-x-6 text-center">
						<button type="submit" class="inline-block px-7 py-3 bg-blue-600 text-white font-medium text-sm leading-snug uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800
	            		active:shadow-lg transition duration-150 ease-in-out" name="submit">Modifier</button>
					</div>
				</form>
			</div>
		</div>
	<?php }

	public function seePastOrders(array $args): void { ?>
		<section class="overflow-hidden text-gray-700 ">
			<div class="container px-5 py-2">
				<div class="flex flex-wrap -m-1 md:-m-2">
					<div class="flex flex-wrap w-full pl-96">
						<div class="w-full p-1 md:p-2">
							<div class="p-12 text-center relative overflow-hidden bg-no-repeat bg-cover" style="height: 200px;">
								<div class="absolute top-0 right-0 bottom-0 left-0 w-full h-full overflow-hidden">
									<div class="flex justify-center items-center h-15">
										<div class="text-white space-y-10">
											<h2 class="font-bold text-5xl mb-4 dark:text-white text-blue-700 text-center">Mes commandes</h2>
											<h2 class="text-xl mb-6 dark:text-white text-blue-700 text-left">Toutes les commandes que vous avez effectuées</h2>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<?php $i = 0; ?>
		<div class="text-white space-y-10">
			<h2 class="font-bold text-5xl mb-4 dark:text-white text-blue-700 text-center">Commande en cours</h2>
		</div>
		<div class="mb-3 p-5 mb-5">
			<table class="table-auto w-full dark:bg-darkblue-900 border-2 rounded-xl divide-y dark:text-white text-blue-500 dark:divide-blue-600">
				<thead class="mb-5 dark:text-white justify-center w-full">
					<tr class="w-full">
						<th>
							<p class="inline-block px-6 py-6 text-lg leading-tight uppercase rounded shadow-md transition duration-150 ease-in-out font-bold text-center pointer-events-none">Image</p>
						</th>
						<th>
							<p class="inline-block px-6 py-6 text-lg leading-tight uppercase rounded shadow-md transition duration-150 ease-in-out font-bold text-center pointer-events-none">Nom</p>
						</th>
						<th>
							<p class="inline-block px-6 py-6 text-lg leading-tight uppercase rounded shadow-md transition duration-150 ease-in-out font-bold text-center pointer-events-none">Couleur</p>
						</th>
						<th>
							<p class="inline-block px-6 py-6 text-lg leading-tight uppercase rounded shadow-md transition duration-150 ease-in-out font-bold text-center pointer-events-none">Pointure</p>
						</th>
						<th>
							<p class="inline-block px-6 py-6 text-lg leading-tight uppercase rounded shadow-md transition duration-150 ease-in-out font-bold text-center pointer-events-none">Collection</p>
						</th>
						<th>
							<p class="inline-block px-6 py-6 text-lg leading-tight uppercase rounded shadow-md transition duration-150 ease-in-out font-bold text-center pointer-events-none">Quantité</p>
						</th>
						<th>
							<p class="inline-block px-6 py-6 text-lg leading-tight uppercase rounded shadow-md transition duration-150 ease-in-out font-bold text-center pointer-events-none">Prix</p>
						</th>
					</tr>
				</thead>
				<tbody class="overflow-auto divide-y dark:divide-blue-600">
					<?php
					if (!empty($args[5])) {
						for ($e = 0; $e < count($args[5]); $e++) {
							if (!empty($args[2])) { ?>
								<tr>
									<td><img class="w-20 h-20 content-center rounded-sm" src="<?= $args[0][0]->generate('home') ?>/images/products/<?= $args[2][$i]->getEAN() ?>.jpg" alt="Chaussures femme"></td>
									<td class="text-slate-900 text-xl text-center align-middle font-medium dark:text-slate-200 mr-10"><?= $args[2][$e]->getName() ?></td>
									<td class="text-slate-900 text-xl text-center align-middle font-medium dark:text-slate-200"><?= $args[4][$i]->getName() ?></td>
									<td class="text-slate-900 text-xl text-center align-middle font-medium dark:text-slate-200"><?= $args[2][$e]->getSeize() ?></td>
									<td class="text-slate-900 text-xl text-center align-middle font-medium dark:text-slate-200"><?= $args[3][$i]->getIdBrand() ?></td>
									<td class="text-slate-900 text-xl text-center align-middle font-medium dark:text-slate-200"><?= $args[5][$e]->getQuantities() ?></td>
									<td class="text-slate-900 text-xl text-center align-middle font-medium dark:text-slate-200"><?= $args[2][$e]->getUnitPriceDiscount() ?? $args[2][$e]->getUnitPrice() ?></td>
								</tr>
						<?php $i++;
							}
						}
					} else { ?>
						<tr class="h-20">
							<td colspan="8" class="text-slate-900 text-5xl text-center align-middle font-medium dark:text-slate-200 mr-10">Il n'y a pas de commandes en cours.</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
		<div class="text-white space-y-10">
			<h2 class="font-bold text-5xl mb-4 dark:text-white text-blue-700 text-center">Commande terminées</h2>
		</div>
		<div class="mb-3 p-5 mb-5">
			<table class="table-auto w-full dark:bg-darkblue-900 border-2 rounded-xl divide-y dark:text-white text-blue-500 dark:divide-blue-600">
				<thead class="mb-5 dark:text-white justify-center w-full">
					<tr class="w-full">
						<th>
							<p class="inline-block px-6 py-6 text-lg leading-tight uppercase rounded shadow-md transition duration-150 ease-in-out font-bold text-center pointer-events-none">Image</p>
						</th>
						<th>
							<p class="inline-block px-6 py-6 text-lg leading-tight uppercase rounded shadow-md transition duration-150 ease-in-out font-bold text-center pointer-events-none">Nom</p>
						</th>
						<th>
							<p class="inline-block px-6 py-6 text-lg leading-tight uppercase rounded shadow-md transition duration-150 ease-in-out font-bold text-center pointer-events-none">Couleur</p>
						</th>
						<th>
							<p class="inline-block px-6 py-6 text-lg leading-tight uppercase rounded shadow-md transition duration-150 ease-in-out font-bold text-center pointer-events-none">Pointure</p>
						</th>
						<th>
							<p class="inline-block px-6 py-6 text-lg leading-tight uppercase rounded shadow-md transition duration-150 ease-in-out font-bold text-center pointer-events-none">Collection</p>
						</th>
						<th>
							<p class="inline-block px-6 py-6 text-lg leading-tight uppercase rounded shadow-md transition duration-150 ease-in-out font-bold text-center pointer-events-none">Quantité</p>
						</th>
						<th>
							<p class="inline-block px-6 py-6 text-lg leading-tight uppercase rounded shadow-md transition duration-150 ease-in-out font-bold text-center pointer-events-none">Prix</p>
						</th>
					</tr>
				</thead>
				<tbody class="overflow-auto divide-y dark:divide-blue-600">
					<?php
					if (!empty($args[6])) {
						for ($e = 0; $e < count($args[6]); $e++) {
							if (!empty($args[2])) { ?>
								<tr>
									<td><img class="w-20 h-20 content-center rounded-sm" src="<?= $args[0][0]->generate('home') ?>/images/<?= $args[2][$e + $i]->getEAN() ?>.jpg" alt="Chaussures femme"></td>
									<td class="text-slate-900 text-xl text-center align-middle font-medium dark:text-slate-200 mr-10"><?= $args[2][$e + $i]->getName() ?></td>
									<td class="text-slate-900 text-xl text-center align-middle font-medium dark:text-slate-200"><?= $args[4][$i]->getName() ?></td>
									<td class="text-slate-900 text-xl text-center align-middle font-medium dark:text-slate-200"><?= $args[2][$e]->getSeize() ?></td>
									<td class="text-slate-900 text-xl text-center align-middle font-medium dark:text-slate-200"><?= $args[3][$i]->getIdBrand() ?></td>
									<td class="text-slate-900 text-xl text-center align-middle font-medium dark:text-slate-200"><?= $args[6][$e]->getQuantities() ?></td>
									<td class="text-slate-900 text-xl text-center align-middle font-medium dark:text-slate-200"><?= $args[2][$e + $i]->getUnitPriceDiscount() ?? $args[2][$e + $i]->getUnitPrice() ?></td>
								</tr>
						<?php $i++;
							}
						}
					} else { ?>
						<tr class="h-20">
							<td colspan="8" class="text-slate-900 text-5xl text-center align-middle font-medium dark:text-slate-200 mr-10">Il n'y a pas de commandes terminées.</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
<?php
	}
}
