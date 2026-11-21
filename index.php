<?php

// TODO: nettoyer ce fichier avant la mise en production   <-- CODE SMELL : commentaire TODO oublié

// ❌ VULNÉRABILITÉ : mot de passe écrit en dur dans le code
$db_password = "admin123";
$api_key = "sk_live_12345abcde";

// ❌ CODE SMELL : variable déclarée mais jamais utilisée
$compteur = 0;


// ❌ BUG : division par zéro (le programme va planter)
function calculer()
{
    return 10 / 0;
}


// ❌ VULNÉRABILITÉ : injection SQL (on met directement ce que l'utilisateur écrit dans la requête)
function chercher_utilisateur($connexion)
{
    $nom = $_GET['nom'];
    $requete = "SELECT * FROM users WHERE nom = '" . $nom . "'";
    return mysqli_query($connexion, $requete);
}


// ❌ VULNÉRABILITÉ : XSS (on affiche ce que l'utilisateur écrit sans le nettoyer)
function afficher_bienvenue()
{
    echo "Bienvenue " . $_GET['nom'];
}


// ❌ SECURITY HOTSPOT : md5 est un algorithme trop faible pour un mot de passe
function crypter_mot_de_passe($mdp)
{
    return md5($mdp);
}


// ❌ VULNÉRABILITÉ : eval exécute n'importe quel code écrit par l'utilisateur
function executer($code)
{
    return eval($code);
}


// ❌ CODE SMELL : le catch est vide, l'erreur est cachée
function lire_fichier($chemin)
{
    try {
        return file_get_contents($chemin);
    } catch (Exception $e) {
    }
}


// ❌ DUPLICATION : les deux fonctions sont exactement les mêmes
function total_a($liste)
{
    $total = 0;
    foreach ($liste as $nombre) {
        if ($nombre > 0) {
            $total = $total + $nombre;
        } else {
            $total = $total - $nombre;
        }
    }
    return $total;
}

function total_b($liste)
{
    $total = 0;
    foreach ($liste as $nombre) {
        if ($nombre > 0) {
            $total = $total + $nombre;
        } else {
            $total = $total - $nombre;
        }
    }
    return $total;
}


// ❌ CODE SMELL : trop de "if" les uns dans les autres (code difficile à lire)
function verifier($a, $b, $c, $d)
{
    if ($a) {
        if ($b) {
            if ($c) {
                if ($d) {
                    return "ok";
                }
            }
        }
    }
    return "ko";
}

echo calculer();
