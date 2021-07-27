<?php
require 'database.php';
$nameError = $descriptionError = $priceError = $imageError = $categoryError = $name = $description = $category = $price = $image ="";

//Si les champs sont pas vides
if(!empty($_POST)){

    $name            = cheickInput($_POST['name']);
    $description     = cheickInput($_POST['description']);
    $category        = cheickInput($_POST['category']);
    $price           = cheickInput($_POST['price']);
    $image           = cheickInput($_FILES['image']['name']);

    //Nous recuperons le nom de l'image a enregistrer dans la base de donnee
    $imagePath          = '../images/' . basename($image);
    // $imagePath          = '../images/' . basename($image);
    // $image              = checkInput($_FILES['image']['name']);
    // $imagePath          = '../images/' . basename($image);
    // $imageExtension     = pathinfo($imagePath, PATHINFO_EXTENSION);
    $imageExtension  = pathinfo($imagePath,PATHINFO_EXTENSION);
    $isSuccess       = true;
    $isUploadSuccess = false;

    if(empty($name)){
        $nameError = "Ce champs ne peut être vide";
        $isSuccess = false;
    }
    if(empty($description)){
        $descriptionError = "Ce champs ne peut être vide ";
        $isSuccess = false;
    }
    if(empty($category)){
        $categoryError = "Ce champs ne peut être vide ";
        $isSuccess = false;
    }
    if(empty($price)){
        $priceError = "Ce champs ne peut être vide ";
        $isSuccess = false;
    }
    if(empty($image)){
        $imageError = "Ce champs ne peut être vide ";
        $isSuccess = false;
    }else {
        $isUploadSuccess = true;
        if($imageExtension != 'jpg' && $imageExtension != 'jpeg' && $imageExtension != 'gif' && $imageExtension != "png"){
             $imageError = "Les fichiers autorisés sont : .jpg, .jpeg, .png, .git";
             $isUploadSuccess = false;
        }
        // if(file_exists($imagePath)){
        //     $imageError = "Ce fichier existe déja";
        //     $isUploadSuccess = false;
        // }
        if($_FILES['image']['size'] > 500000 ){
            $imageError = "Ce fichier ne doit pas depasser les 500ko";
            $isUploadSuccess = false;
        }
        if($isUploadSuccess){
            if(!move_uploaded_file($_FILES['image']['tmp_name'],$imagePath)){
                $imageError = "Une erreur s'est produite lors de l'upload";
                $isUploadSuccess = false;
            }

        }
    }

    if($isUploadSuccess && $isSuccess){
        $bdd = Database::connect();
        $statement = $bdd->prepare("INSERT INTO items (name,description,price,image,category) VALUES (?,?,?,?,?)");
        $statement->execute(array($name,$description,$price,$image,$category)); 
        Database::disconnect();
        header("Location: index.php");
    }

}

function cheickInput($data){
    $data = trim($data);
    $data = htmlspecialchars($data);
    $data = stripslashes($data);
    return $data;
}
 ?>

<!DOCTYPE html>
<html>
    <head>
        <title>Big Buger</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link href="https://fonts.googleapis.com/css?family=Holtwood+One+SC&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="../css/style1.css">
    </head>
    <body>
    <h1 class="text-logo text-center">
            <span class="glyphicon glyphicon-cutlery"></span>Big Burger Admin <span class="glyphicon glyphicon-cutlery"></span>
    </h1>
    <div class="container admin">
        <div class="row">
            <h1><strong class="titre">Ajouter un items </strong></h1>

            <form class="form" role="form" action="insert.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name" required >Nom*:</label>
                <input class="form-control" type="text" id="name" name="name" placeholder="Nom" value="<?php echo $name ?>">
                <span class="help-inline"><?php echo $nameError ?></span>
            </div>
            <div class="form-group">
                <label for="description" required>Description*:</label>
                <input type="text" class="form-control" id="description" name="description" placeholder="description" value="<?php echo $description ?>" >
                <span class="help-inline"><?php echo $descriptionError ?></span>
            </div>
            <div class="form-group">
                <label for="prix">Prix en (FCFA):</label>
                <input class="form-control" type="number" step="0.1" name="price" id="prix" placeholder="prix" value="<?php echo $price ?>">
                <span class="help-inline"><?php echo $priceError; ?></span>
            </div>
            <div class="form-group">
                <label for="categorie">Categories:</label>
                <select class="form-control" name="category" id="categorie" >
                    <?php 
                    $bdd = Database::connect();
                    $statement = $bdd->query('SELECT * FROM categories');
                    foreach($statement as $row){
                        echo '<option value='.$row['id'] . '>'  .$row['name'].  '</option>';
                    }
                    Database::disconnect();
                     ?>
                     
                </select>


                <span class="help-inline"><?php echo $categoryError; ?></span>
            </div>
            <div class="form-group">
                <label for="image">Sélectionner une image:</label>
                <input class="form-control" type="file" name="image" id="image" value="<?php echo $image ?>">
                <span class="help-inline"><?php echo $imageError ?></span>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-success">
                    <span class="glyphicon glyphicon-pencil">  Ajouter</span>                    
                </button>
                <a href="index.php" class="btn btn-primary"><span class="glyphicon glyphicon-arrow-left"> Retour</span></a>
            </div>


             </form>
        </div>
    </div>
    </body>
</html>
