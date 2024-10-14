<?php require_once '../config/variables.php' ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/fastbootstrap@2.2.0/dist/css/fastbootstrap.min.css" rel="stylesheet" integrity="sha256-V6lu+OdYNKTKTsVFBuQsyIlDiRWiOmtC8VQ8Lzdm2i4=" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles/main.css">

    <!-- Toastify -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <title>Sen recette</title>
</head>

<body class="border" style="display: block; height: 100vh; display:flex; justify-content:center; align-items:center;">

    <form class="register w-50 mx-auto border rounded px-4 py-5" action="<?php echo BASE_URL; ?>auth/post_register.php" method="POST" enctype="multipart/form-data">

        <h3 class="my-4 text-center">Inscrivez-vous</h3>

        <div class="row">
            <div class="col-12 col-md-6">
                <div class="mb-3">
                    <label for="prenom" class="">Prénom</label>
                    <div class="mt-2">
                        <input id="prenom" name="prenom" class="form-control" type="text" autocomplete="prenom">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="nom" class="">Nom</label>
                    <div class="mt-2">
                        <input id="nom" name="nom" class="form-control" type="text" autocomplete="nom">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="email" class="">Email</label>
                    <div class="mt-2">
                        <input id="email" name="email" class="form-control" type="email" autocomplete="email">
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="mb-3">
                    <label for="age" class="">Age</label>
                    <div class="mt-2">
                        <input id="age" name="age" class="form-control" type="number" autocomplete="age">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="password" class="">Mot de passe</label>
                    <div class="mt-2">
                        <input id="password" name="password" class="form-control" type="password" autocomplete="password">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="image" class="">Image</label>
                    <div class="mt-2">
                        <input id="image" name="image" class="form-control" type="file" autocomplete="image" accept="image/*">
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-5 text-center">
            <button type="submit" class="btn btn-primary">S'inscrire</button>
        </div>

        <p class="mt-5 text-center">
            Vous avez déja un compte?
            <a href="<?php echo BASE_URL; ?>index.php" class="">Connectez-vous !</a>
        </p>
    </form>

    <!-- Script -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>

</html>