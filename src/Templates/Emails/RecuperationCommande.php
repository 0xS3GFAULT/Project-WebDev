<?php

namespace App\Templates\Emails;

class RecuperationCommande
{
    public function index(array $args)
    {
        $href = $_SERVER['SERVER_NAME'];
        return <<<HTML
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Votre commande a bien été enregistrée</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <p>Bonjour {$args['name']},</p>
                <p>Votre dernière commande vient d'être retirée en boutique. </p>
                <p>Vous pouvez voir notre dernière collection et nos nouveautés sur le <a href="<?= $href ?>">site.</a></p>
                <p>Merci de votre confiance,</p>
                <p>A la Renommée, Chaussures THIBAUD</p>
            </div>
        </div>
    </div>
</body>
</html>
HTML;

    }
}