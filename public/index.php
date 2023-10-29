<?php
$errors= [];

    if ($_SERVER['REQUEST_METHOD'] ==="POST") {
        $uploadDir = './uploads/';
        $uploadName = uniqid('', true) . basename($_FILES['avatar']['name']);
        $uploadFile = $uploadDir . $uploadName;
        $extension = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
        $authorizedExtensions =['jpg', 'jpeg', 'png', 'gif', 'webp', 'JPG', 'JPEG', 'PNG', 'GIF', 'WEBP'];
        $maxFileSize = 1000000;
    
    if (!isset($_POST['user_firstname']) || empty($_POST['user_firstname']))
        $errors[] = "Ce champ est obligatoire";

    if (!isset($_POST['user_lastname']) || empty(trim($_POST['user_lastname'])))
        $errors[] = "Ce champ est obligatoire";

    if(empty($_POST['birthdate']))
        $errors[] = "Ce champ est obligatoire";

    if (file_exists($_FILES['avatar']['tmp_name']) && filesize($_FILES['avatar']['tmp_name']) > $maxFileSize || filesize($_FILES['avatar']['tmp_name']) == 0) {
        $errors[] = "Votre image doit faire moins de 1MO";
    }

    if ((!in_array($extension, $authorizedExtensions))) {
        $errors[] = "L'extension de votre image doit être au format jpg, png, gif ou webp.";
    }

    if(empty($errors)) {
        move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadFile);
       //header('location: ./index.php');
    }
    }
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href= "style.css" rel="stylesheet">
</head>
<body>

<?php
    foreach ($errors as $error) :?>
    <li><?= $error ?></li>
    <?php endforeach ?>
    <div class="container">
    <form method="POST" enctype="multipart/form-data">
        <label for="user_firstname">Prénom</label>
            <input type="text" name="user_firstname" id="user_firstname" required/>
            <br>
        <label for="user_lastname">Nom</label>
            <input type="text" name="user_lastname" id="user_lastname" required/>
            <br>
        <label for="birthdate">Date de naissance</label>
            <input type="date" name="birthdate" id="birthdate" required/>
            <br>
        <label for="imageUpload">Upload an profile image</label>
            <input type="file" name="avatar" id="imageUpload" required/>
            <br>
                <input type="submit" value="send">
    </form>
    </div>


    <div id="card">
    <div id="card-title">
      <h1>Springfield</h1>
    </div>
    <div id="card-id">
      <div id="card-number">
        <p class="cardtitle">Carte nationale d'identité :</p>
        <p>000000000666</p>
      </div>
    </div>
    <div id="card-information">
      <div id="card-photo">
        <img src="<?= $uploadFile ?>">
      </div>
      <div id="card-text">
      <div id="card-name">
        <div class="card-box"></div>
        <p class="cardtitle">Nom :</p>
        <p><?= $_POST['user_lastname'] ?></p>
        <div class="card-box"></div>
        <p class="cardtitle">Prénom :</p>
        <p><?= $_POST['user_firstname']?></p>
      </div>
      <div id="card-detail">

        <div class="card-box">
          <p class="cardtitle">Né(e) le :</p>
          <p><?= $_POST['birthdate']?></p>
        </div>
        </div>
      </div>
    </div>
  </div>

</body>
</html>