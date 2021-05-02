<?php

    
if($_SERVER["REQUEST_METHOD"] === "POST"){
    $errors = [];
    $data = array_map('trim', $_POST);
    
    
    $uploadDir = 'public/uploads/';
    $uploadFile = $uploadDir . uniqid() . basename($_FILES['imageUpload']['name']);
    $extension = pathinfo($_FILES['imageUpload']['name'], PATHINFO_EXTENSION);
    $extensions_ok = ['jpg','jpeg','png','gif','webp'];
    
    
    $maxFileSize = 1000000;

    if( (!in_array($extension, $extensions_ok ))){
        $errors[] = 'Veuillez sélectionner une image de type Jpg, Jpeg, Png, gif, webp !';
    }
    if( file_exists($_FILES['imageUpload']['tmp_name']) && filesize($_FILES['imageUpload']['tmp_name']) > $maxFileSize){
        $errors[] = "Votre fichier doit faire moins de 1Mo !";
    }
   if (empty($errors)){
        move_uploaded_file($_FILES['imageUpload']['tmp_name'], $uploadFile);
        echo 'HOMER SIMPSON 36 ans'; 
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
    <?php if(!empty($errors)): ?>
        <?php foreach ($errors as $error): ?>
            <p> <?= $error ?></p>
        <?php endforeach ?>
    <?php else :?>
        <img src="<?= $uploadFile;?>" alt="homer" width="400px"/>
    <?php endif; ?>
    <form method="POST" enctype="multipart/form-data">
    <label for="imageUpload">Upload an profile image</label>    
    <input type="file" name="imageUpload" id="imageUpload" />
    <button name="send">Send</button>
    
</form>
</body>
</html>