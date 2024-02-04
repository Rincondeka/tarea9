<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tarea9</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="cabecera">
        <h1>Cocktel Bar</h1>
        <p>Escoge la margarita que deseas elaborar:</p>
    </div>
    <div class="contenido">
        <div class="cocteles">   
            <h3>Cócteles:</h3>      
                <?php
                    $data=file_get_contents("https://www.thecocktaildb.com/api/json/v1/1/search.php?s=margarita");
                    $data=json_decode($data);
                ?>
                <ul class="lista_cocteles">
                    <?php
                        foreach($data as $coctel):
                            for($i=0;$i<=5;$i++){?>
                                <li><a href="<?php echo "http://localhost/tarea9/cliente.php?&id=".$coctel[$i]->idDrink."&nombre=".$coctel[$i]->strDrink?>"><?php echo $coctel[$i]->strDrink ?></a></li>  
                            <?php
                            }
                        endforeach;?>
                </ul>
        </div>
            <?php
            if (isset($_GET["nombre"]) && isset($_GET["id"])){
                $datos=file_get_contents("https://www.thecocktaildb.com/api/json/v1/1/lookup.php?i=".$_GET["id"]);
                $datos=json_decode($datos);?>
                <div class="receta">
                    <?php echo"<h2>".$_GET["nombre"]."</h2>" ?>
                <h3>Sugerencias:</h3>
                    <?php foreach($datos as $info){
                        echo "<p>".$info[0]->strInstructions."</p>";
                        ?>
                </div>
                <?php  }?>  
                <div class="ingredientes">
                    <ul class="lista_ingredientes">
                        <h3>Lista de Ingredientes:</h3>
                    <?php foreach($datos as $info){
                        for($i=1;$i<=15;$i++){
                            $numero=(string)$i;
                            $ingrediente="strIngredient".$i;
                            if($info[0]->$ingrediente!=null){
                                echo "<li>".$info[0]->$ingrediente."</li>";
                            }
                        }
                    }
                    ?>
                    </ul>
                </div>
                <?php  }?>     
        </div>
</body>
</html>