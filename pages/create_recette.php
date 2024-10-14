<?php
session_start();
require_once '../config/variables.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/fastbootstrap@2.2.0/dist/css/fastbootstrap.min.css" rel="stylesheet" integrity="sha256-V6lu+OdYNKTKTsVFBuQsyIlDiRWiOmtC8VQ8Lzdm2i4=" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles/main.css">

    <!-- Toastify -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <title>Créer recette</title>
</head>

<body class="border">

    <!-- navbar -->
    <?php require_once __DIR__ . '/../components/navbar.php' ?>
    <!-- fin navbar -->

    <div class="caroussel">
        <img src="../assets/images/top-view-food-ingredients-with-veggies-notebook.jpg" style="height: 80vh !important;" class="img-fluid" alt="">
    </div>

    <section class="container py-10">
        <div class="row">
            <div class="col-12 col-md-4">
                <img src="../assets/images/top-view-food-ingredients-with-veggies-notebook.jpg" class="img-fluid" alt="">
            </div>
            <div class="col-12 col-md-8">
                <form class="register w-100 mx-auto border rounded px-4 py-5" action="<?php echo BASE_URL; ?>pages/post_create_recette.php" method="POST" enctype="multipart/form-data">

                    <h3 class="my-4 text-center">Créer une recette</h3>

                    <div class="mb-3">
                        <label for="title" class="form-label">Titre</label>
                        <input type="text" class="form-control" id="title" name="title">
                    </div>

                    <div class="mb-3">
                        <label for="recipe" class="form-label">Recette</label>
                        <textarea class="form-control" placeholder="Description de votre recette" id="recipe" name="recipe"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Image de la recette</label>
                        <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
                    </div>

                    <div class="mt-5 text-center">
                        <button type="submit" class="btn btn-primary">Créer</button>
                    </div>

                </form>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php require_once '../components/footer.php' ?>

    <!-- Script -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>

</html>