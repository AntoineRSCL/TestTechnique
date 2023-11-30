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
            //verifie que le formulaire est bien rempli
            if(isset($_POST['number']))
            {
                //vérifie que l'input n'est pas vide
                if(!empty($_POST['number']))
                {
                    //verifie que la valeur de l'input est bien un nombre entier
                    if(ctype_digit($_POST['number']))
                    {
                        $nombre = $_POST['number'];
                        //Erreur si le nombre vaut 1 ou 3 car impossible d'arriver a 0 avec des billets de 2
                        if($nombre == 1 || $nombre == 3){
                            echo '<div class="billets"><h2>Il est impossible de rendre au compte juste '.$nombre.'$ avec des billets de 2,5 et 10$</h2></div>';
                        }else{
                            $result = getResults($nombre);
                            $tableauPrix = ["2$", "5$", "10$"];
                            $tableauCouleurs = ["#F9ECC2", "#FBEDB8", "#E0C5A2"];
                            $cpt=0;
                            echo "<div class='billets'>";
                                //Parcours le tableau
                                foreach($result as $billet){
                                    if($billet > 0){
                                        //Rajoute un s si il y a plusieurs billets
                                        if($billet != 1){
                                            $texte = "billets";
                                        }else{
                                            $texte = "billet"; 
                                        } 
                                        echo "<div class='billet'>
                                            <div class='affichage' style='background-color:".$tableauCouleurs[$cpt]."'>".$tableauPrix[$cpt]."</div>
                                            <span class='nbBillet'><strong>".$billet." </strong></br> ".$texte." de ".$tableauPrix[$cpt]."</span>
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
             * Fonction faisant tous les calulcs et qui renvoient le nombre de chaque billets
             *
             * @param [int] $n
             * @return void
             */
            function getResults($n){
                $cpt10=0; $cpt5=0; $cpt2=0;
                //Si le nombre est supérieur à 20 on garde le reste de la division (Sauf si le reste vaut 1 ou 3 on passe a 21 ou 23 car impossible d'arriver a 0 avec des billets de 2)
                if($n>20){
                    if($n%20!=1 && $n%20!=3){
                        $reste=$n%20;
                    }else if($n%20==1){
                        $reste=21;
                    }else{
                        $reste=23;
                    }
                    // Nombre - le reste pour obtenir un multiple de 10 et pouvoir le divisier par 10 et ajouter le resultat en billet de 10
                    $n=$n-$reste;
                    $cpt10=$n/10;
                }else{
                    $reste=$n;
                }
                //Si le reste du calcul au dessus vaut 0 on passe l'etape pour conntaire les derniers billets
                if($reste!=0){
                    //boucle pour arriver a 0 si modulo 10 alors ajout d'un billet de 10 la meme avec 5 et si aucun n'est bon on enleve 2 au calcul
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