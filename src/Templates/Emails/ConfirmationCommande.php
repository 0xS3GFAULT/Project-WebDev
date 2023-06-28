<?php

namespace App\Templates\Emails;

class ConfirmationCommande
{
    public function index(array $args): string
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
                <p>Votre commande n° {$args['order_number']} a bien été enregistrée. Elle sera disponible sous deux heures dans notre boutique. Vous pouvez venir la récupérer à tout moment dans notre plage horaire disponible sur le <a href="<?= $href ?>">site.</a></p>
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