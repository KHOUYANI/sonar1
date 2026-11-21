<?php

// TODO: nettoyer ce fichier                       <-- CODE SMELL (TODO oublié)

// =====================================================
// 🔓 VULNÉRABILITÉS (le hacker peut en profiter)
// =====================================================

$db_password = "admin123";               // mot de passe écrit dans le code
$api_key = "sk_live_12345abcde";         // clé secrète écrite dans le code

function chercher_utilisateur($connexion)
{
    $nom = $_GET['nom'];
    // injection SQL : on colle l'entrée de l'utilisateur dans la requête
    $requete = "SELECT * FROM users WHERE nom = '" . $nom . "'";
    return mysqli_query($connexion, $requete);
}

function afficher_bienvenue()
{
    echo "Bienvenue " . $_GET['nom'];    // XSS : affichage sans nettoyage
}

function executer($code)
{
    return eval($code);                  // exécute n'importe quel code
}

function crypter($mdp)
{
    return md5($mdp);                    // algorithme de hachage faible
}


// =====================================================
// 🐞 BUGS (le programme ne fait pas ce qu'on veut)
// =====================================================

// Bug 1 : on compare la variable avec elle-même
function comparer($a)
{
    if ($a == $a) {
        return "toujours vrai";
    }
    return "jamais";
}

// Bug 2 : la même condition est écrite deux fois (la 2e n'est jamais atteinte)
function type_utilisateur($role)
{
    if ($role == "admin") {
        return "A";
    } elseif ($role == "admin") {
        return "B";
    }
    return "C";
}

// Bug 3 : code après return (jamais exécuté)
function calcul()
{
    return 10;
    echo "ce message ne s'affichera jamais";
}

// Bug 4 : le résultat de trim() est jeté, la fonction ne fait rien
function nettoyer($texte)
{
    trim($texte);
    return $texte;
}

// Bug 5 : on crée un objet et on le jette tout de suite
function creer_date()
{
    new DateTime();
}

// Bug 6 : la boucle ne tourne qu'une seule fois
function premier($liste)
{
    foreach ($liste as $element) {
        return $element;
    }
}

// Bug 7 : on cache les erreurs avec @
function lire($chemin)
{
    return @file_get_contents($chemin);
}


// =====================================================
// 🧹 CODE SMELLS (code mal écrit)
// =====================================================

function verifier($a, $b, $c, $d)
{
    $inutile = 5;                        // variable jamais utilisée
    if ($a) {
        if ($b) {
            if ($c) {
                if ($d) {                // trop de "if" imbriqués
                    return "ok";
                }
            }
        }
    }
    return "ko";
}

function ouvrir($chemin)
{
    try {
        return file_get_contents($chemin);
    } catch (Exception $e) {             // catch vide : l'erreur disparaît
    }
}


// =====================================================
// 📋 DUPLICATION (même code copié-collé deux fois)
// =====================================================

function rapport_ventes($ventes)
{
    $total = 0;
    $nombre = 0;
    $maximum = 0;
    $minimum = 999999;
    foreach ($ventes as $vente) {
        $total = $total + $vente;
        $nombre = $nombre + 1;
        if ($vente > $maximum) {
            $maximum = $vente;
        }
        if ($vente < $minimum) {
            $minimum = $vente;
        }
    }
    $moyenne = $total / $nombre;
    echo "Total : " . $total;
    echo "Moyenne : " . $moyenne;
    echo "Maximum : " . $maximum;
    echo "Minimum : " . $minimum;
    return $moyenne;
}

function rapport_achats($ventes)
{
    $total = 0;
    $nombre = 0;
    $maximum = 0;
    $minimum = 999999;
    foreach ($ventes as $vente) {
        $total = $total + $vente;
        $nombre = $nombre + 1;
        if ($vente > $maximum) {
            $maximum = $vente;
        }
        if ($vente < $minimum) {
            $minimum = $vente;
        }
    }
    $moyenne = $total / $nombre;
    echo "Total : " . $total;
    echo "Moyenne : " . $moyenne;
    echo "Maximum : " . $maximum;
    echo "Minimum : " . $minimum;
    return $moyenne;
}
