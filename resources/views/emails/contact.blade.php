<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Un client vous a contacté !</title>
    <style>
        /* Toujours utiliser du CSS inline-friendly */
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0; }
        .container { max-width: 600px; margin: auto; background: #ffffff; padding: 20px; }
        .header { background: #007BFF; color: white; text-align: center; padding: 10px; }
        .content { padding: 20px; }
        .footer { font-size: 12px; text-align: center; padding: 10px; color: #666; }
    </style>
</head>

<body>

    <div class="container">
        <div class="header">
            <h2>Demande de contact</h2>
        </div>

        <div class="content">
            <p>Bonjour,</p>
            <p>Merci de nous avoir contactés concernant le bien <strong>{{ $property->title }}</strong>.</p>
            <p>Nous vous répondrons dès que possible.</p>
        </div>

        <div class="footer">
            &copy; {{ date('Y') }} MonAgence. Tous droits réservés.
        </div>
    </div>

</body>
</html>