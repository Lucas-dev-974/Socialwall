<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{env('APP_NAME')}} reset password</title>
</head>
<body>
    Bonjour {{\Route::current()->parameter('name') . ' ' . \Route::current()->parameter('lastname')}},
    pour renouveller votre mot de passe veuillez suivre ce <a href=""> lien </a>
</body>
</html>