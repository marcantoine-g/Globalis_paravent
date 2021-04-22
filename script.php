#!C:\PHP\php-8.0.3\php.exe -q
<?php

/* Definie STDIN dans le cas où il ne l'est pas déjà */
if(!defined("STDIN")) {
define("STDIN", fopen('php://stdin','r'));
}

// Conditon de fin de boucle
$isValide = false;

// Récupération d'une largeur n valide
do {
    $n = readline("Largeur : ");
    $isValide = checkIfValideData($n);
} while (!$isValide);


// Récupération de la liste de hauteurs heights valide
do {
    $isValide = true;

    $heights = explode(" ", readline("Hauteurs : "));

    // On vérifie le nombre de hauteurs et leur validités
    if( count($heights) == $n){
        foreach ($heights as $key => $h) {
            if(!checkIfValideData($h)) $isValide = false;
        }
    } else {
        echo "Vous devez entrer un nombre de hauteurs égale à la largeur \"$n\"", PHP_EOL;
    }
} while (!$isValide);


// Si les données sont valides on peut continuer
if(!empty($heights)){
    // Init
    $bigestHeight = $heights[0];
    $result = 0;
    
    // On parcourt les hauteurs, si il existe une hauteur inférieur à la plus grande précédente, elle st a l'abri
    foreach ($heights as $key => $h) {
        $h = intval($h);
        if($h >= $bigestHeight)  $bigestHeight = $h;
        else $result++;
    }
    echo "Resultat : $result", PHP_EOL;
}


// Permet de vérifier la validité des datas reçues
function checkIfValideData($var = null) : bool
{
    if(is_numeric($var)){
        $var=intval($var);
        if($var<0 || $var>100000){
            echo "La valeur \"$var\" doit être entre 0 et 100 000", PHP_EOL;
            return false;
        }
    } else {
        echo "La valeur \"$var\" doit être un nombre", PHP_EOL;
        return false;
    }
    return true;
}