<?php
session_start();
require_once __DIR__ . '/config/variables.php';
require_once __DIR__ . '/config/fonctions.php';
require_once  __DIR__ . '/functions/messsage.php';


// require_once './config/fonctions.php';

$_SESSION['toast'] = 'success'; // ou 'error'

if (isset($_SESSION['toast']) && isset($_SESSION['message'])) {
    $toast = $_SESSION['toast'];
    $message = $toast['message'];
    $toastType = $toast['type'];

    // Afficher le toast
    showToastWithRedirect($message, $toastType, 3000);

    // Supprimer le message de la session pour éviter de le réafficher
    unset($_SESSION['toast']);
}


// Récupérer les recettes actives
$activeRecipes = getActiveRecipes();


?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/fastbootstrap@2.2.0/dist/css/fastbootstrap.min.css" rel="stylesheet" integrity="sha256-V6lu+OdYNKTKTsVFBuQsyIlDiRWiOmtC8VQ8Lzdm2i4=" crossorigin="anonymous">
    <!-- Toastify -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link rel="stylesheet" href="./styles/main.css">
    <title>Sen recette</title>
</head>

<body class="border min-vh-100">

    <!-- navbar -->
    <?php require_once './components/navbar.php' ?>
    <!-- fin navbar -->

    <?php require_once './auth/login.php' ?>

    <?php if (isset($_SESSION['LOGGED_USER'])) : ?>

        <div class="caroussel">
            <img src="./assets/images/top-view-food-ingredients-with-veggies-notebook.jpg" style="height: 80vh !important;" class="img-fluid" alt="">
        </div>

        <h2 class="text-center my-8">Liste des recettes</h2>

        <?php if (!empty($activeRecipes)): ?>
            <section class="my-10">
                <div class="container">
                    <div class="row p-0 my-5">
                        <div class="col-12 col-md-3">
                            <h3>filtres</h3>
                        </div>
                        <div class="col-12 col-md-9">
                            <div class="row m-0">
                                <?php foreach ($activeRecipes as $recipe): ?>

                                    <div class="col-12 col-md-6 g-3">

                                        <div class="card h-100">
                                            <div class="card-header d-flex align-items-center">
                                                <span class="avatar text-bg-primary avatar-lg fs-5">R</span>
                                                <div class="ms-3">
                                                    <h6 class="mb-0 fs-sm"><?php echo displayAuthor($recipe['author'], $users); ?></h6>
                                                    <span class="text-muted fs-sm"><?php echo $recipe['created_at']; ?></span>
                                                </div>
                                                <div class="dropstart ms-auto">
                                                    <button class="btn text-muted" type="btn" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                        tert
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <a class="dropdown-item" href="#">Action</a>
                                                        </li>
                                                        <li><a class="dropdown-item" href="#">Another action</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <img src="./assets/images/top-view-food-ingredients-with-veggies-notebook.jpg" class="card-img-top" alt="green iguana" />
                                            <div class="card-body">
                                                <!-- Titre -->
                                                <h3 class="my-4">
                                                    <a href="<?php echo BASE_URL; ?>pages/detailRecette.php?id=<?php echo htmlspecialchars($recipe['recipe_id']); ?>">
                                                        <?php echo htmlspecialchars($recipe['title']); ?>
                                                    </a>
                                                </h3>
                                                <p class="card-text">
                                                    <?php echo $recipe['recipe']; ?>
                                                </p>
                                            </div>
                                            <div class="card-footer d-flex">
                                                <a class="btn btn-info me-auto fw-bold" href="<?php echo BASE_URL; ?>pages/detailRecette.php?id=<?php echo htmlspecialchars($recipe['recipe_id']); ?>" role="button">
                                                    Voir plus
                                                </a>
                                                <a class="btn btn-warning me-auto fw-bold" href="<?php echo BASE_URL; ?>pages/update_recette.php?id=<?php echo htmlspecialchars($recipe['recipe_id']); ?>" role="button">
                                                    Modifier
                                                </a>

                                                <a class="btn btn-info me-auto fw-bold" href="<?php echo BASE_URL; ?>pages/deleted_recette.php?id=<?php echo htmlspecialchars($recipe['recipe_id']); ?>" role="button">
                                                    Supprimer
                                                </a>

                                            </div>
                                        </div>

                                    </div>

                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>

        <!-- footer -->
        <?php require_once './components/footer.php' ?>

    <?php endif; ?>

    <!-- Footer -->


    <!-- Script -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>