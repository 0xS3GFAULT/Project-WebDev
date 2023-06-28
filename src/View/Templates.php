<?php

namespace App\View;

use AltoRouter;
use Exception;

class Templates {

    /**
     * @throws Exception
     */
    public function index(AltoRouter $router, $content, $timetable): void{
        ?>
        <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html lang="fr" class="dark">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>A La Renomm&eacute;e - Chaussures THIBAUD</title>
            <link rel="stylesheet" href="<?= $router->generate('home') ?>css/style.css">
            <link rel="icon" href="<?= $router->generate('home') ?>images/chaussure.png">
            <script src="https://cdn.tiny.cloud/1/jbprspfnecj0np2hb8u5hrv2gnaa6so3kj4be7b7k17kg9r7/tinymce/6/tinymce.min.js" referrerpolicy="origin" type="text/javascript"></script>
        </head>

        <body class="dark:bg-darkblue-900">
        <nav>
            <div class="desktop:container mx-auto px-5 lg:px-8 py-2">
                <div class="relative flex items-center justify-between h-[4.25rem]">
                    <div class="absolute inset-y-0 left-0 flex items-center desktop:hidden space-x-6 ">
                        <button type="button" class="relative inline-flex border-2 border-blue-700 focus:border-transparent dark:border-transparent items-center justify-center p-2 rounded-md text-black dark:text-white bg-white dark:bg-blue-800" aria-controls="mobile-menu" aria-expanded="false" onclick="toggleNavbar('mobile-menu', 'menu-close', 'menu-open')">
                            <span class="sr-only">Open main menu</span>
                            <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true" id="menu-open">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                            <svg class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true" id="menu-close">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <div class="flex-1 flex items-center justify-center desktop:items-stretch desktop:justify-start h-full">
                        <div class="flex-shrink-0 flex items-center">
                            <a href="<?= $router->generate('home') ?>"><img class="block h-8 w-auto" src="<?= $router->generate('home') ?>images/chaussure.png" id="navbar-logo" alt="Logo A La Renommée Chaussures THIBAUD"></a>
                        </div>
                        <div class="hidden desktop:block desktop:ml-auto h-full">
                            <div class="flex space-x-6 h-full">
                                <a href="<?= $router->generate('home') ?>" class="px-3 py-2 text-lg font-extrabold test flex items-center text-blue-700 dark:text-white hover:text-darkblue-300 dark:hover:text-blue-400 underline-offset-4 decoration-2 hover:underline" aria-current="page">
                                    Accueil
                                </a>
                                <a href="<?= $router->generate('products') ?>" class="px-3 py-2 text-lg font-extrabold test flex items-center text-blue-700 dark:text-white hover:text-darkblue-300 dark:hover:text-blue-400 underline-offset-4 decoration-2 hover:underline">
                                    Produits
                                </a>
                                <?php if (isset($_SESSION['id']) AND $_SESSION['id'] > 0){ ?>
                                    <a href="<?= $router->generate('basket') ?>" class="px-3 py-2 text-lg font-extrabold test flex items-center text-blue-700 dark:text-white hover:text-darkblue-300 dark:hover:text-blue-400 underline-offset-4 decoration-2 hover:underline">
                                        Panier
                                    </a>
                                    <a href="<?= $router->generate('orders') ?>" class="px-3 py-2 text-lg font-extrabold test flex items-center text-blue-700 dark:text-white hover:text-darkblue-300 dark:hover:text-blue-400 underline-offset-4 decoration-2 hover:underline">
                                        Mes commandes
                                    </a>
                                    <a href="<?= $router->generate('profile') ?>" class="px-3 py-2 text-lg font-extrabold test flex items-center text-blue-700 dark:text-white hover:text-darkblue-300 dark:hover:text-blue-400 underline-offset-4 decoration-2 hover:underline">
                                        Mon profil
                                    </a>
                                    <a href="<?= $router->generate('logout') ?>" class="px-3 py-2 text-lg font-extrabold test flex items-center justify-center text-blue-700 dark:text-white hover:text-darkblue-300 dark:hover:text-blue-400 underline-offset-4 decoration-2 hover:underline">
                                        Déconnexion
                                    </a>
                                <?php } else { ?>
                                    <a href="<?= $router->generate('login') ?>" class="flex items-center justify-center align-middle h-10 my-auto">
                                        <button class="test text-blue-700 hover:text-white dark:text-white font-bold px-6 py-2 border-2 border-blue-800 hover:bg-blue-900 hover:border-blue-900 rounded-full">
                                            Connexion
                                        </button>
                                    </a>
                                    <a href="<?= $router->generate('signup') ?>" class="flex items-center justify-center align-middle h-10 my-auto">
                                        <button class="test text-white font-bold px-6 py-2 bg-blue-700 border-2 border-transparent hover:bg-blue-600 rounded-full">
                                            Inscription
                                        </button>
                                    </a>
                                <?php } ?>
                                <div class="flex inline-flex items-center justify-center text-blue-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg>
                                    <div class="bg-blue-600 relative inline-flex h-[38px] w-[74px] items-center rounded-full">
                                        <div class="bg-slate-200 h-[34px] w-[34px] items-center rounded-full translate-x-1 transform transition ease-in-out duration-200" onclick="changeTheme('theme-switch')" id="theme-switch"></div>
                                    </div>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hidden desktop:hidden" id="mobile-menu">
                <div class="container mx-auto px-2 pt-2 pb-3 space-y-1">
                    <a href="<?= $router->generate('home') ?>" class="px-3 py-2 text-lg font-extrabold test flex items-center justify-center text-blue-700 dark:text-white hover:text-blue-400 underline-offset-4 decoration-2 hover:underline" aria-current="page">
                        Accueil
                    </a>
                    <a href="<?= $router->generate('products') ?>" class="px-3 py-2 text-lg font-extrabold test flex items-center justify-center text-blue-700 dark:text-white hover:text-blue-400 underline-offset-4 decoration-2 hover:underline">
                        Produits
                    </a>
                    <?php if (isset($_SESSION['id']) AND $_SESSION['id'] > 0) { ?>
                        <a href="<?= $router->generate('basket') ?>" class="px-3 py-2 text-lg font-extrabold test flex items-center justify-center text-gray-600 dark:text-white hover:text-blue-400 underline-offset-4 decoration-2 hover:underline">
                            Panier
                        </a>
                        <a href="<?= $router->generate('logout') ?>" class="px-3 py-2 text-lg font-extrabold test flex items-center justify-center text-gray-600 dark:text-white hover:text-blue-400 underline-offset-4 decoration-2 hover:underline">
                            Déconnexion
                        </a>
                    <?php } else { ?>
                        <div class="space-y-3">
                            <a href="<?= $router->generate('login') ?>" class="flex items-center justify-center align-middle h-10 my-auto" role="menuitem" tabindex="-1" id="user-menu-item-2">
                                <button class="test dark:text-blue-500 dark:hover:text-white font-bold px-6 py-2 border-2 border-blue-800 hover:bg-blue-900 hover:text-white hover:border-blue-900 rounded-full w-full">
                                    Connexion
                                </button>
                            </a>
                            <a href="<?= $router->generate('signup') ?>" class="flex items-center justify-center align-middle h-10 my-auto">
                                <button class="test text-white font-bold px-6 py-2 bg-blue-700 border-2 border-transparent hover:bg-blue-600 rounded-full w-full">
                                    Inscription
                                </button>
                            </a>
                        </div>
                    <?php } ?>
                    <div class="flex inline-flex items-center justify-center text-blue-600 w-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        <div class="bg-blue-600 relative inline-flex h-[38px] w-[74px] items-center rounded-full">
                            <div class="bg-slate-200 h-[34px] w-[34px] items-center rounded-full translate-x-9 transform transition ease-in-out duration-200" onclick="changeTheme('theme-switch-mobile')" id="theme-switch-mobile"></div>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                        </svg>
                    </div>
                </div>
            </div>
        </nav>

        <header>
            <div class="relative mb-8 overflow-hidden bg-no-repeat bg-cover dark:bg-darkblue-900" style="background-position: 50%;height: 350px;background-image: url('<?= $router->generate('home') ?>images/header_shoes_blur.jpg');">
                <div class="absolute top-0 right-0 bottom-0 left-0 w-full h-full overflow-hidden bg-fixed">
                    <div class="flex justify-center items-center h-full">
                        <div class="text-center text-white px-6 md:px-12">
                            <h1 class="text-5xl font-bold mt-0 mb-6">Retrouvez toutes vos chaussures favorites à la Renommée</h1>
                            <h3 class="text-3xl italic mb-8">La chaussure Thibaud, la chaussure qu'il vous faut !</h3>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <?php echo $content; ?>

        <footer class="p-4 text-left bg-gray-800">
            <div class="mx-6 py-10 justify-center items-center">
                <div class="grid grid-cols-3 gap-8 text-white">
                    <div >
                        <h6 class="uppercase font-bold mb-8 text-lg flex justify-center md:justify-start">
                            Nous contacter
                        </h6>
                        <a href="https://www.facebook.com/Sylthibaud/" target="_blank" class="flex items-center justify-center md:justify-start mb-4">Facebook</a>
                        <a href="tel:+33474202911" target="_blank"><span class="flex items-center justify-center md:justify-start mb-4"><p><b>Tel: </b> 04 74 20 29 11</p></span></a>
                        <p>
                            <b>Adresse:</b>
                            3 Rue Bayard, 38260 La Côte-Saint-André
                        </p>
                    </div>

                    <div>
                        <h6 class="uppercase font-bold mb-8 flex text-lg justify-center md:justify-start">
                            Horaires
                        </h6>
                        <?php
                        if(!is_null($timetable)) {
                            $t = json_decode($timetable);
                            foreach ($t[0] as $key => $value) {
                                if (empty($value)) {
                                    echo '<p class="flex items-center justify-center md:justify-start mb-4"><b>' . $key . '</b>: Fermé </p>';
                                }
                                foreach ($value as $k => $v) {
                                    echo '<p class="flex items-center justify-center md:justify-start mb-4"><b>' . $key . '</b>: ' . $v->matin . ', ' . $v->aprem . '</p>';
                                }
                            }
                        }?>
                    </div>
                    <div class="">
                        <h6 class="uppercase font-bold mb-8 flex text-lg justify-center md:justify-start">
                            Liens utiles
                        </h6>
                        <p class="mb-4">
                            <a href="<?= $router->generate('administration') ?>">Page d'administration</a>
                        </p>
                        <p class="mb-4">
                            <a href="<?= $router->generate('generalTerms') ?>">Conditions Générales</a>
                        </p>
                    </div>
                </div>
            </div>
        </footer>
        <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/index.min.js" type="text/javascript"></script>
        <script src="<?= $router->generate('home') ?>js/index.js" type="text/javascript"></script>
        <script type="text/javascript">
            tinymce.init({
                selector: 'textarea#cgv',
                plugins: 'a11ychecker advcode casechange export formatpainter image editimage linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tableofcontents tinycomments tinymcespellchecker',
                toolbar: 'a11ycheck addcomment showcomments casechange checklist code export formatpainter image editimage pageembed permanentpen table tableofcontents',
                toolbar_mode: 'floating',
            });
        </script>
        </body>
        </html>
        <?php
    }
}
?>
