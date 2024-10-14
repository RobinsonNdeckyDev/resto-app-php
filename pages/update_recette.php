<?php

session_start();
// require_once(__DIR__ . '/isConnect.php');
// require_once '/config/mysql.php';
$pdo = require_once '../db/databaseConnect.php';

if (!$pdo) {
    echo "Erreur lors de la connexion à la base de données";
    exit;
}


$getData = $_GET;

// echo $_GET['id'];


if (!isset($getData['id']) ||  !is_numeric($getData['id'])) {

    echo "il faut un identifiant de recette pour la modifier";

    return;
}


try {
    $recupRecipStatement = $pdo->prepare('SELECT * FROM recipes WHERE recipe_id = :id');
    $recupRecipStatement->execute(['id' => $getData['id']]);
    $recipe = $recupRecipStatement->fetch(PDO::FETCH_ASSOC);

    // Vérifier si la recette a été trouvée
    if (!$recipe) {
        echo "Recette introuvable.";
        exit;
    }
} catch (PDOException $e) {
    echo "Erreur lors de la récupération de la recette : " . $e->getMessage();
    exit;
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/fastbootstrap@2.2.0/dist/css/fastbootstrap.min.css" rel="stylesheet" integrity="sha256-V6lu+OdYNKTKTsVFBuQsyIlDiRWiOmtC8VQ8Lzdm2i4=" crossorigin="anonymous">
    <!-- Toastify -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link rel="stylesheet" href="./styles/main.css">
    <title>Modifier recette</title>
</head>

<body class="d-flex flex-column min-vh-100">
    <?php require_once '../components/navbar.php'; ?>

    <div class="caroussel">
        <img src="../assets/images/top-view-food-ingredients-with-veggies-notebook.jpg" style="height: 80vh !important;" class="img-fluid w-100" alt="">
    </div>


    <div class="container pt-4">
        <h1 class="my-4 text-center">Mettre à jour <?php echo ($recipe['title']) ?> </h1>

        <section class="py-10">
            <div class="row">
                <div class="col-12 col-md-6">
                    <img class="img-fluid" src="../assets/images/top-view-food-ingredients-with-veggies-notebook.jpg" alt="">
                </div>
                <div class="col-12 col-md-6">
                    <form class="container" action="post_update.php" method="POST" enctype="multipart/form-data">
                        <div class="mb-3 visually-hidden">
                            <label for="id" class="form-label">identifient de la recette</label>
                            <input type="hidden" class="form-control" id="id" name="id" value="<?php echo ($_GET['id']) ?>">
                        </div>

                        <div class="mb-3">
                            <label for="title" class="form-label">Titre</label>
                            <input type="text" class="form-control" id="title" name="title" value="<?php echo ($recipe['title']) ?>">
                        </div>

                        <div class="mb-3">
                            <label for="recipe" class="form-label">Recette</label>
                            <textarea class="form-control" id="recipe" name="recipe"><?php echo ($recipe['recipe']) ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Image de la recette</label>
                            <input type="file" class="form-control" id="image" name="image">

                        </div>

                        <button type="submit" class="btn btn-primary">Mettre à jour</button>
                    </form>
                </div>
            </div>
        </section>

    </div>
    <?php require_once '../components/footer.php'; ?>

    <!-- Script -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>

</html>