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
                <h1><strong>Liste des items </strong> <a href="insert.php" class="btn btn-success btn-lg">
                     <span class="glyphicon glyphicon-plus"></span> Ajouter</a> </h1>
            </div>

            <table class="table table-striped table-bordered">

                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Description</th>
                        <th>Prix</th>
                        <th>Categories</th>
                        <th>Action</th>
                    </tr>
                 </thead>
                  <tbody>
                  <?php
                    require "database.php";
                    $bdd = Database::connect();

                    //Requete de selection de donnees et jointure de deux tables
                    $statement = $bdd->query("SELECT items.id,items.name,items.description,items.price,categories.name AS categoryN
                                              FROM items LEFT JOIN categories ON items.category = categories.id
                                              ORDER BY items.id DESC ");

                    while($item = $statement->fetch()){
                        echo '<tr>';
                        echo "<td>".$item['name'] ."</td>";
                        echo "<td>".$item['description'] ."</td>";
                        echo "<td>" .number_format((float) $item['price'],2,'.',' '). "</td>";
                        echo "<td>" . $item['categoryN'] . "</td>";
                      echo ' <td width="300">';
                      echo '  <a href="view.php?id=' .$item['id']. ' " class="btn btn-default"> ';
                      echo '  <span class="glyphicon glyphicon-eye-open"></span> ';
                        echo 'Voir' ;  
                      echo '</a>'; 
                      echo ' '; 
                   
                      echo ' <a href="update.php?id='. $item['id']. ' " class="btn btn-primary"> ';
                       echo    ' <span class="glyphicon glyphicon-pencil"></span>
                            Modifier
                        </a> ';
                        echo ' ';
                    
                      echo '  <a href="delete.php?id=' .$item['id']. ' " class="btn btn-danger">
                            <span class="glyphicon glyphicon-remove"></span>
                            Supprimer
                        </a> ';
                  echo  ' </td>';
                  echo '</tr>';
                    }

                    Database::disconnect();
            
                 ?>

                </tbody>
                

            </table>

        </div>    
    </body>
</html>
