<?php

namespace App\Templates\Emails;

class MotDePasse
{
    public function index(array $args) {
        return <<<HTML
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mot de passe oublié</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Mot de passe oublié</h1>
                <p>Bonjour {$args['name']},</p>
                <p>Vous avez demandé un nouveau mot de passe.</p>
                <p>Votre nouveau mot de passe est : {$args['password']}</p>
                <p>Vous pouvez vous connecter à l'adresse suivante : <br><a href="{$args['url']}" class="btn btn-primary">{$args['url']}</a></p>
            </div>
        </div>
    </div>
</body>
</html>
HTML;

    }
}