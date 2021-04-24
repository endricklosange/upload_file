<?php

if($_SERVER["REQUEST_METHOD"] === "POST"){
    
    $errors = [];
    $uploadDir = 'public/uploads/';
    $uploadFile = $uploadDir . basename($_FILES['avatar']['name']);
    
    $extension = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
    $extensions_ok = ['jpg','jpeg','png','gif','webp'];
    $maxFileSize = 1000000;
    

    if( (!in_array($extension, $extensions_ok ))){
        $errors[] = 'Veuillez sélectionner une image de type Jpg, Jpeg, Png, gif, webp !';
    }
    if( file_exists($_FILES['avatar']['tmp_name']) && filesize($_FILES['avatar']['tmp_name']) > $maxFileSize){
        $errors[] = "Votre fichier doit faire moins de 1Mo !";
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php if(empty($errors)): ?>
        <?php move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadFile)?>
        <?= 'HOMER SIMPSON' ?>
        <?= '36 ans' ?>
        <img src="<?= $uploadFile;?>" alt="homer" width="400px"/>
    <?php else :?>
        <?php foreach ($errors as $error): ?>
            <p> <?= $error ?></p>
        <?php endforeach ?>
       
        <?php header('Location: /index.php'); ?>
}


    <?php endif ?>
    <form method="POST" enctype="multipart/form-data">
    <label for="imageUpload">Upload an profile image</label>    
    <input type="file" name="avatar" id="imageUpload" />
    <button name="send">Send</button>
    
</form>
</body>
</html>