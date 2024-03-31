<?php

$output = shell_exec('ffmpeg -version 2>&1');

if (strpos($output, 'ffmpeg version') !== false) {
    echo "FFmpeg est activé. Voici la sortie :<br><pre>$output</pre>";
} else {
    echo "FFmpeg ne semble pas être activé. Voici la sortie :<br><pre>$output</pre>";
}

?>
