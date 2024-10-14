<?php
session_start();
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
    <title>A propos</title>
</head>

<body>
    <!-- navbar -->
    <?php require_once '../components/navbar.php' ?>
    <!-- fin navbar -->

    <div class="caroussel">
        <img src="../assets/images/top-view-food-ingredients-with-veggies-notebook.jpg" style="height: 80vh !important;" class="img-fluid w-100" alt="">
    </div>

    <section class="container p-5">
        <p class="text-justify">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis, quibusdam temporibus saepe dolore porro quas dignissimos ipsa perferendis labore exercitationem voluptates, explicabo sit! Dolores unde aut qui impedit tempore esse at commodi nulla. Laboriosam fugit doloremque sit ratione! Sequi sint iste eligendi mollitia eius! Consequuntur similique tenetur modi perspiciatis obcaecati.
        </p>

        <p class="text-justify">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis, quibusdam temporibus saepe dolore porro quas dignissimos ipsa perferendis labore exercitationem voluptates, explicabo sit! Dolores unde aut qui impedit tempore esse at commodi nulla. Laboriosam fugit doloremque sit ratione! Sequi sint iste eligendi mollitia eius! Consequuntur similique tenetur modi perspiciatis obcaecati.
        </p>

        <p class="text-justify">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis, quibusdam temporibus saepe dolore porro quas dignissimos ipsa perferendis labore exercitationem voluptates, explicabo sit! Dolores unde aut qui impedit tempore esse at commodi nulla. Laboriosam fugit doloremque sit ratione! Sequi sint iste eligendi mollitia eius! Consequuntur similique tenetur modi perspiciatis obcaecati.
        </p>

        <p class="text-justify">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis, quibusdam temporibus saepe dolore porro quas dignissimos ipsa perferendis labore exercitationem voluptates, explicabo sit! Dolores unde aut qui impedit tempore esse at commodi nulla. Laboriosam fugit doloremque sit ratione! Sequi sint iste eligendi mollitia eius! Consequuntur similique tenetur modi perspiciatis obcaecati.
        </p>

        <p class="text-justify">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis, quibusdam temporibus saepe dolore porro quas dignissimos ipsa perferendis labore exercitationem voluptates, explicabo sit! Dolores unde aut qui impedit tempore esse at commodi nulla. Laboriosam fugit doloremque sit ratione! Sequi sint iste eligendi mollitia eius! Consequuntur similique tenetur modi perspiciatis obcaecati.
        </p>
    </section>

    <?php require_once '../components/footer.php' ?>
</body>

</html>