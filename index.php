<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Technique</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="btnPreEnr">
            <span class="btn">10</span>
            <span class="btn">11</span>
            <span class="btn">21</span>
            <span class="btn">23</span>
            <span class="btn">31</span>
            <span class="btn">9007199254740991</span>
        </div>
        <div class="form">
            <form action="index.php" method="POST">
                <input type="text" name="number" id="number" placeholder="Votre montant à tester...">
                <button type="submit" id="btnSubmit">Soumettre</button>
            </form>
        </div>


        <?php
            if(isset($_POST['number']))
            {
                if(!empty($_POST['number']))
                {
                    if(ctype_digit($_POST['number']))
                    {
                        $nombre = $_POST['number'];
                        if($nombre == 1 || $nombre == 3){
                            echo '<div class="billets"><h2>Il est impossible de rendre au compte juste '.$nombre.'$ avec des billets de 2,5 et 10$</h2></div>';
                        }else{
                            $result = getResults($nombre);
                            $tableauPrix = ["2$", "5$", "10$"];
                            $tableauCouleurs = ["#F9ECC2", "#FBEDB8", "#E0C5A2"];
                            $cpt=0;
                            echo "<div class='billets'>";
                                foreach($result as $billet){
                                    if($billet > 0){
                                        echo "<div class='billet'>
                                            <div class='affichage' style='background-color:".$tableauCouleurs[$cpt]."'>".$tableauPrix[$cpt]."</div>
                                            <span class='nbBillet'><strong>".$billet." </strong></br> billets de ".$tableauPrix[$cpt]."</span>
                                        </div>";
                                    }
                                    $cpt+=1;
                                }
                            echo "</div>";
                        }
                    }else{
                        echo '<div class="alert" style="background-color:red;">Veuillez remplir le champ avec un nombre entier</div>';
                    }
                }else{
                    echo '<div class="alert" style="background-color:red;">Veuillez remplir correctement le champ</div>';
                }
            }

            /**
             * Fonction faisant tous les calulcs et qui renvoient les résultats finaux
             *
             * @param [int] $n
             * @return void
             */
            function getResults($n){
                $cpt10=0; $cpt5=0; $cpt2=0;
                //Si le nombre est supérieur à 20
                if($n>20){
                    if($n%20!=1 && $n%20!=3){
                        $reste=$n%20;
                    }else if($n%20==1){
                        $reste=21;
                    }else{
                        $reste=23;
                    }
                    $n=$n-$reste;
                    $cpt10=$n/10;
                }else{
                    $reste=$n;
                }
                if($reste!=0){
                    do{
                        if($reste%10==0)
                        {
                            $reste-=10;
                            $cpt10+=1;
                        }else if($reste%5==0){
                            $reste-=5;
                            $cpt5+=1;
                        }else{
                            $reste-=2;
                            $cpt2+=1;
                        }
                    }while($reste!=0);
                }
                $tableauResultat=[$cpt2, $cpt5, $cpt10];
                return $tableauResultat;
            }
        ?>


    </div>
    <script src='raccourciTouche.js'></script>
</body>
</html>