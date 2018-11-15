<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Barra</title>
    <link rel="stylesheet" href="css/barraMua.css">
</head>
<body>
       
    <div class="barra">
        <nav id="nav">
            <a href="" class="imgLogo ">
                <img class="circle" src="Imagens/scissors-badge.png" width="65px" height="65px" alt="">
                <span class="logo">
                    Beauty Calendar
                </span>
            </a> 
            <ul class="right">
                <li><a class="abrirModal" href="#!"> <img src="Imagens/person.png" style="position:relative; top:10px;" alt=""><span class="nome"> Nome </span></a></li>

            </ul>
        </nav>
    </div>
    
    <?php
        include_once"perfilCli.html";
        ?>
    
</body>
</html>