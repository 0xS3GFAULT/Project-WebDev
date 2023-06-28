<?php

namespace App\View;

class Auth
{

    public function login(array $args): void{ ?>
        <section class="h-screen">
	  	<div class="px-6 text-blue-700">
	    	<div class="flex xl:justify-center lg:justify-between justify-center items-center flex-wrap h-full g-6">
	      		<div class="xl:ml-20 xl:w-5/12 lg:w-5/12 md:w-8/12 mb-12 md:mb-0">
	        	<form id="connection" method="POST">
		         	<div class="flex flex-row items-center justify-center lg:justify-start">
		            	<p class="text-5xl font-bold dark:text-white mb-6 mr-4">Connectez-vous</p>
		          	</div>

                    <div class="text-red-500 text-center mb-4" id="error">
                        <p><?= $args[2] ?></p>
                    </div>

	          		<!-- Email input -->
	          		<div class="mb-6">
		            	<input id="email_connect" type="email" class="form-control dark:bg-darkblue-900 dark:text-white text-black block w-full px-4 py-2 text-xl font-normal bg-white bg-clip-padding border-2 border-blue-600 rounded dark:border-blue-800 transition ease-in-out m-0 focus:outline-none" placeholder="E-Mail" name="email" required/>
		            	<p id="email_field_error2" class="italic text-red-700 dark:text-red-400"></p>
		          	</div>

	          		<!-- Password input -->
		          	<div class="mb-6">
			            <input id="connect_password_input" type="password" class="form-control block w-full px-4 py-2 text-xl font-normal dark:bg-darkblue-900 dark:text-white bg-clip-padding border-2 rounded dark:border-blue-800 border-blue-600 transition text-black ease-in-out m-0 focus:outline-none" placeholder="Mot de passe" name="password" required/>
			            <div class="form-check">
					      <input onclick="hidePassword('connect_password_input')" class="form-check-input appearance-none h-4 w-4 border-2 border-blue-600 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain mr-2 float-left cursor-pointer" type="checkbox" value="">
					      <label class="form-check-label inline-block text-blue-700 font-bold dark:text-gray-400">Cliquez pour afficher le mot de passe</label>
					      <p id="password_field_error2" class="italic text-red-700 dark:text-red-400"></p>
					    </div>
			         </div>

	          		<div class="text-center space-x-6 lg:text-left">
	            		<button type="submit" class="inline-block px-7 py-3 bg-blue-600 text-white font-medium text-sm leading-snug uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800
	            		active:shadow-lg transition duration-150 ease-in-out" name="submit">Se connecter</button>
	            		<a href="<?= $args[0][0]->generate('signup') ?>" class="inline-block px-7 py-3 bg-blue-600 text-white font-medium text-sm leading-snug uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">Je n'ai pas encore de compte</a>
	            		<button onclick="passwordForgot()" type="button" class="inline-block px-7 py-3 bg-blue-600 text-white font-medium text-sm leading-snug uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">J'ai oublié mon mot de passe</button>
	          		</div>
	        	</form>
	        	<form id="password_forgot" class="hidden" action="/mot-de-passe-oublie">
		         	<div class="flex flex-row items-center justify-center lg:justify-start">
		            	<p class="text-5xl font-bold dark:text-white mb-6 mr-4">Vous avez oublié votre mot de passe ?</p>
		          	</div>
		          	<p class="text-xl italic dark:text-white mb-6 mr-4">Pas de panique ! Il reste encore une solution... Vous pouvez indiquer l'adresse E-Mail que vous avez choisie pour ce site afin de recevoir un nouveau mot de passe dans votre boîte de messagerie.</p>

	          		<!-- Email input -->
	          		<div class="mb-6">
		            	<input id="email_forgot" type="text" class="form-control dark:bg-darkblue-900 dark:text-white text-black block w-full px-4 py-2 text-xl font-normal bg-white bg-clip-padding border-2 border-blue-600 rounded dark:border-blue-800 transition ease-in-out m-0 focus:outline-none" placeholder="E-Mail" name="email"- required/>
		            	<p id="email_field_error3" class="italic text-red-700 dark:text-red-400"></p>
		          	</div>
	          		<div class="text-center space-x-6 lg:text-left">
	            		<button type="submit" class="inline-block px-7 py-3 bg-blue-600 text-white font-medium text-sm leading-snug uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800
	            		active:shadow-lg transition duration-150 ease-in-out" name="submit">Valider</button>
	          		</div>
	        	</form>
	      		</div>
	    	</div>
	  	</div>
	</section>
    <?php }
    
    public function signup(array $args): void{ ?>

    	<section class="h-screen">
	  	<div class="px-6">
	    	<div class="flex xl:justify-center lg:justify-between justify-center items-center flex-wrap h-full g-6">
	      		<div class="xl:ml-20 xl:w-5/12 lg:w-5/12 md:w-8/12 mb-12 md:mb-0">
	        	<form method="POST" id="signup">
		         	<div class="flex flex-row items-center justify-center lg:justify-start">
		            	<p class="text-5xl font-bold text-blue-700 dark:text-white mb-6 mr-4">Inscrivez-vous</p>
		          	</div>
		          	<p class="text-xl italic font-bold text-blue-700 dark:text-white mb-6 mr-4">En vous inscrivant, profitez d'offres exclusives et d'un panier virtuel à capacité illimitée !</p>

                    <div class="text-red-500 text-center mb-4" id="error">
                        <p><?= $args[2] ?></p>
                    </div>

              		<!-- Firstname input -->
              		<div class="mb-6">
                    	<input id="firstname" type="text" class="form-control dark:bg-darkblue-900 dark:text-white text-black block w-full px-4 py-2 text-xl font-normal bg-white bg-clip-padding border-2 border-blue-600 rounded dark:border-blue-800 transition ease-in-out m-0 focus:outline-none" placeholder="Prénom" name="firstname" required/>
                    </div>

                    <!-- Lastname input -->
                    <div class="mb-6">
                    	<input id="lastname" type="text" class="form-control dark:bg-darkblue-900 dark:text-white text-black block w-full px-4 py-2 text-xl font-normal bg-white bg-clip-padding border-2 border-blue-600 rounded dark:border-blue-800 transition ease-in-out m-0 focus:outline-none" placeholder="Nom" name="lastname" required/>
                    </div>

		          	<div class="mb-6">
		            	<input id="email_field" type="email" class="form-control dark:bg-darkblue-900 dark:text-white text-black block w-full px-4 py-2 text-xl font-normal bg-white bg-clip-padding border-2 rounded border-blue-800 transition ease-in-out m-0 focus:outline-none" placeholder="E-Mail" name="email" required/>
		            	<p class="italic text-blue-700 dark:text-gray-400">Saisissez une adresse E-Mail d'un compte de messagerie valide qui vous permettra de vous identifier sur le site et de récupérer votre mot de passe en cas d'oubli (Exemple : jean.pierre@gmail.com)</p>
		          	</div>

	          		<!-- Password input -->
		          	<div class="mb-6">
			            <input id="password_field_1" type="password" class="form-control block w-full px-4 py-2 text-xl font-normal dark:bg-darkblue-900 dark:text-white bg-clip-padding border-2 rounded border-blue-800 transition ease-in-out m-0 focus:outline-none" placeholder="Mot de passe" name="password" required/>
			            <div class="form-check">
					      <input onclick="hidePassword('password_field_1')" class="form-check-input appearance-none h-4 w-4 border-2 border-blue-600 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain mr-2 float-left cursor-pointer" type="checkbox" value="">
					      <label class="form-check-label inline-block text-blue-700 font-bold dark:text-gray-400">Cliquez pour afficher le mot de passe</label>
					    </div>
			            <p class="italic text-blue-700 dark:text-gray-400">Choisissez un mot de passe d'au moins 7 caractères comprenant au minimum un chiffre, une majuscule, une minuscule et un caractère spécial</p>
			            <p id="password_field_1_error" class="italic text-red-700 dark:text-red-400"></p>
			         </div>
			         <div class="mb-6">
			            <input id="password_field_2" type="password" class="form-control block w-full px-4 py-2 text-xl font-normal dark:bg-darkblue-900 dark:text-white bg-clip-padding border-2 rounded border-blue-800 transition ease-in-out m-0 focus:outline-none" placeholder="Resaisissez votre mot de passe" name="confirm_password" required/>
			            <input onclick="hidePassword('password_field_2')" class="form-check-input appearance-none h-4 w-4 border-2 border-blue-600 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer" type="checkbox" value="">
					      <label class="form-check-label inline-block text-blue-700 font-bold dark:text-gray-400">Cliquez pour afficher le mot de passe</label>
			            <p class="italic text-blue-700 dark:text-gray-400">Ressaisissez le même mot de passe</p>
			            <p id="password_field_2_error" class="italic text-red-700 dark:text-red-400"></p>
			         </div>

	          		<div class="text-center lg:text-left">
	            		<button onclick="inputValidationInscription()" type="submit" class="inline-block px-7 py-3 bg-blue-600 text-white font-medium text-sm leading-snug uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">Créer mon compte</button>
	          		</div>
	        	</form>
	      		</div>
	    	</div>
	  	</div>
	</section>
    <?php }
}