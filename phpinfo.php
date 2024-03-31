<?php
// Vérifier si le module mod_rewrite est activé
if (in_array('mod_rewrite', apache_get_modules())) {
    echo "Le module mod_rewrite est activé sur votre serveur.";
} else {
    echo "Le module mod_rewrite n'est pas activé sur votre serveur.";
}
?>
