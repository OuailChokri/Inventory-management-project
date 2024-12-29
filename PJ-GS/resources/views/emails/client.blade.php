<!-- resources/views/emails/fournisseur.blade.php -->

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Email</title>
</head>
<body>
    <p>Bonjour {{ $client->nom }},</p>

    <p>{{ $messageContent }}</p>

    <p>Cordialement,</p>
    <p>Votre entreprise</p>
</body>
</html>
