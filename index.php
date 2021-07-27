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
        <link rel="stylesheet" href="css/style1.css">
        <script defer src="js/main.js"></script>
    </head>
    <body>
    <div class="container site">

        <h1 class="text-logo text-center">
            <span class="glyphicon glyphicon-cutlery"></span>
            Big Burger
            <span class="glyphicon glyphicon-cutlery"></span>            
        </h1>
        <?php
        require 'admin/database.php';
        echo "<nav >
                <ul class='nav nav-pills nav-center'>";
                $db = Database::connect();
                $select = $db->query("SELECT * FROM categories");
                $categories = $select->fetchAll();
                foreach($categories as $category){
                    if($category['id'] == '1'){
                        echo '<li role="presentation" class="active text-center"><a href="#'.$category['id'].' " data-toggle="tab">'.$category['name'].'</a></li>';
                    }else{
                        echo '<li role="presentation"><a href="#'.$category['id'].'" data-toggle="tab"> '.$category['name'].'</a></li>';
                    }
                  
                }
                echo "</ul>
                </nav>";
                echo '<div class="tab-content">';

            foreach($categories as $category){
                if($category['id'] == '1'){
                    echo '<div class="tab-pane active" id="'.$category['id'].'">';
                }else{
                    echo '<div class="tab-pane" id="'.$category['id'].'">';
                }
           
            echo '<div class="row">';
            // $id = $_GET['id'];

            //Selection des donneés dans a base de données selon dont la cotégorie n'est pas définie à l'avance
            $statement = $db->prepare('SELECT * FROM items WHERE items.category = ?');
            $statement->execute(array($category['id']));
            while ($item = $statement->fetch()){
                echo '<div class="col-sm-6 col-md-4">
                        <div class="thumbnail">
                         <img src="images/'.$item['image'].'" alt="...">
                         <div class="price">'.number_format($item['price'],2,'.','').' FCFA'.'</div>
                         <div class="caption">
                           <h4>'.$item['name'].'</h4>
                           <p>'.$item['description'].'</p>
                           <a href="#" class="btn btn-order" role="button">
                           <span  onclick="commander()" class="commander glyphicon glyphicon-shopping-cart"></span>
                           commander
                       </a>
                       </div>
                    </div>
                </div> ';
            }
            echo '</div>
            </div>';
        }
        Database::disconnect();
         ?>
              
        </div>
    </div>
    
</body>
</html>
  <!-- <div id="ftco-loader" class="show fullscreen">
        <script src="js/main.js"></script>
	  <svg class="circular" width="48px" height="48px">
		  <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/>
		  <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/>
		</svg>
	</div> -->
