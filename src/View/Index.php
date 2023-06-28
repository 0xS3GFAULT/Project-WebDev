<?php

namespace App\View;

use AltoRouter;

class Index
{
    public function index(array $args) :void { ?>
    	<section class="overflow-hidden text-gray-700 ">
  			<div class="container px-5 py-2">
    			<div class="flex flex-wrap -m-1 md:-m-2">
      				<div class="flex flex-wrap w-full pl-96">
        				<div class="w-full p-1 md:p-2">
          					<div class="p-12 text-center relative overflow-hidden bg-no-repeat bg-cover" style="height: 450px;">
          						<div class="absolute top-0 right-0 bottom-0 left-0 w-full h-full overflow-hidden">
      								<div class="flex justify-center items-center h-15">
								        <div class="text-white space-y-10">
								          	<h4 class="font-semibold text-2xl dark:text-white text-blue-700 mb-6 text-left">Le magasin de chaussures qui pense à ses clients !</h4>
								          	<h2 class="font-bold text-5xl mb-4 dark:text-white text-blue-700 text-left">À la Renommée Chaussures Thibaud,</h2>
								          	<h2 class="text-xl mb-6 dark:text-white text-blue-700 text-left">Tous les produits sont manufacturés par des passionnés qui apportent leur savoir-faire à Toulon. De la sandale aux baskets, vous découvrirez toute une gamme de produits qui satisferont aussi bien les grands que les petits !</h2>
								          	<a class="inline-block float-left px-7 py-3 mb-1 text-white bg-blue-800 hover:bg-blue-600 font-medium text-sm leading-snug uppercase rounded focus:outline-none focus:ring-0 transition duration-150 ease-in-out" href="<?= $args[0][0]->generate('products') ?>" >Voir ce que la boutique propose</a>
								        </div>
      								</div>
    							</div>
  							</div>
        				</div>
      				</div>
      			</div>
    		</div>
		</section>
    <?php }

    public function generalTerms(array $args): void { ?>
            <div id="cgv" class="dark:text-white ml-8 mr-8">
                <?= $args[2] ?? "Elles arrivent bientôt" ?>
            </div>
    <?php }
}