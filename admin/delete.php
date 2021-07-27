<?php
require 'database.php';

if(!empty($_GET["id"])){
    $id = cheickInput($_GET["id"]);

}
if(!empty($_POST)){
    $id = cheickInput($_POST["id"]);
    $db = Database::connect();
    $statement = $db->prepare("DELETE FROM items WHERE id = ?");
    $statement->execute(array($id));
    Database::disconnect();
    header("Location: index.php");
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
        <title>Buger Shop</title>
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
            <span class="glyphicon glyphicon-cutlery"></span> Burger Shop Admin <span class="glyphicon glyphicon-cutlery"></span>
    </h1>
    <div class="container admin">
        <div class="row">
            <h1><strong class="titre">Supprimer un items </strong></h1>

            <form class="form" role="form" action="delete.php" method="post" enctype="multipart/form-data">   
            <input type="hidden" name="id" value="<?php echo $id; ?>">     
            <p class="alert alert-warning">Etre vous sur de vouloir supprimer ?</p> 
          
            <div class="form-actions">
                <button type="submit" class="btn btn-warning">
                      Oui                  
                </button>
                <a href="index.php" class="btn btn-dafault">Non</a>
            </div>


             </form>
        </div>
    </div>
    </body>
</html>
