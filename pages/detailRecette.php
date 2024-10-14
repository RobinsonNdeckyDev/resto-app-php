<?php

session_start();
require_once __DIR__ . '/../config/variables.php';
require_once '../functions/messsage.php';

$_SESSION['toast'] = 'success'; // ou 'error'

// Dans affichage du toast
if (isset($_SESSION['toast'])) {
    if ($_SESSION['toast'] === 'success') {
        showToastWithRedirect("Commentaire ajouté avec succès!", 'success', 3000);
    } elseif ($_SESSION['toast'] === 'error') {
        showToastWithRedirect("Erreur lors de l'ajout du commentaire.", 'error', 3000);
    }
    // Ensuite, videz la session pour éviter de réafficher le toast
    unset($_SESSION['toast']);
}


// if (isset($_SESSION['LOGGED_USER']['user_id'])) {
// echo "L'utilisateur connecté a l'ID : " . $_SESSION['LOGGED_USER']['user_id'];
// } else {
// echo "Aucun utilisateur connecté ou ID manquant.";
// }


if (!$pdo) {
    echo "Erreur lors de la connexion à la base de données";
    exit;
}

$getData = $_GET;

if (!isset($getData['id']) || !is_numeric($getData['id'])) {

    echo "il faut un identifiant de recette pour la modifier";

    return;
}

// Récupérer la recette
$recupRecipStatement = $pdo->prepare('SELECT * FROM recipes WHERE recipe_id = :id');
$recupRecipStatement->execute([
    'id' => $getData['id'],
]);

// Récupérer les données de la recette
$recipe = $recupRecipStatement->fetch(PDO::FETCH_ASSOC);

// Incrémenter le nombre de vues
if ($recipe) {
    // Mettre à jour le nombre de vues dans la base de données
    $newViewsCount = $recipe['views'] + 1;

    $updateStatement = $pdo->prepare('UPDATE recipes SET views = :views WHERE recipe_id = :id');
    $updateStatement->execute([
        'views' => $newViewsCount,
        'id' => $getData['id'],
    ]);

    // Mettre à jour la recette en mémoire pour afficher le bon nombre de vues
    $recipe['views'] = $newViewsCount;
}

// Récupérer les commentaires liés à la recette avec les informations de l'utilisateur
$commentStatement = $pdo->prepare('
    SELECT c.comment_id, c.comment, c.created_at, u.email 
    FROM comments c
    JOIN users u ON c.user_id = u.user_id
    WHERE c.recipe_id = :id
');
$commentStatement->execute([
    'id' => $getData['id'],
]);
$comments = $commentStatement->fetchAll(PDO::FETCH_ASSOC);

// <?php echo htmlspecialchars($recipe['image_path']); 
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/fastbootstrap@2.2.0/dist/css/fastbootstrap.min.css" rel="stylesheet" integrity="sha256-V6lu+OdYNKTKTsVFBuQsyIlDiRWiOmtC8VQ8Lzdm2i4=" crossorigin="anonymous">
    <!-- Toastify -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <link rel="stylesheet" href="../styles/main.css">
    <title>Détail recette</title>
</head>

<body>
    <?php require_once '../components/navbar.php'; ?>

    <section class="banner caroussel">
        <!-- image recette -->
        <img src="../assets/images/top-view-food-ingredients-with-veggies-notebook.jpg" class="img-fluid" alt="Image de la recette" class="img-fluid" />
    </section>

    <section class="container py-10">
        <h2 class="titre text-center my-10"><?php echo $recipe['title']; ?></h2>
        <div class="row">
            <div class="col-12 col-md-8">
                <h4 class="text-justify my-8">Description</h4>
                <p><?php echo $recipe['recipe']; ?></p>

                <br>
                <span class="">
                    nbre de vues <span class="btn btn-primary"><?php echo htmlspecialchars($recipe['views']) ?></span>
                </span>
            </div>
            <div class="col-12 col-md-4">
                <h5 class="my-8">Liste des commentaires</h5>
                <?php if ($comments): ?>

                    <ul>
                        <?php foreach ($comments as $comment): ?>
                            <li>
                                <strong><?php echo htmlspecialchars($comment['email']); ?>:</strong>
                                <p><?php echo htmlspecialchars($comment['comment']); ?></p>
                                <small>Publié le <?php echo date('d-m-y H-i-s', strtotime($comment['created_at'])); ?></small>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p>Soyez le premier à commenter!</p>
                <?php endif; ?>


                <?php if (isset($_SESSION['LOGGED_USER'])) : ?>
                    <div class="">
                        <form action="<?php echo BASE_URL; ?>pages/post_comment.php" method="POST">
                            <div class="mb-3 visually-hidden">
                                <input type="hidden" class="form-control" id="user" name="user_id" value="<?php echo isset($_SESSION['LOGGED_USER']['user_id']) ? $_SESSION['LOGGED_USER']['user_id'] : ''; ?>">
                            </div>
                            <div class="mb-3 visually-hidden">
                                <input type="hidden" class="form-control" id="comment" name="recipe_id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="comment">Commentaire</label>
                                <input type="text" class="form-control" id="comment" name="comment" placeholder="Renseigner un commentaire">
                            </div>

                            <button type="submit" class="btn btn-primary">envoyer</button>
                        </form>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </section>

    <?php require_once '../components/footer.php' ?>

    <!-- Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>

</html>