<?php
$title = "Comentarios en PHP";
$description = "Aprende a usar comentarios para documentar tu código sin que se ejecuten ni muestren en pantalla.";
include 'template.php';
?>

<!-- Contenido del ejercicio -->
<pre class="bg-gray-900 text-green-300 p-6 rounded-lg overflow-x-auto text-sm">
<code>
<?php
// Comentario de una línea

/*
   Comentario de varias líneas
   Útil para explicar funciones o bloques
*/

# Otro estilo de comentario (menos común)

echo "¡Los comentarios no se muestran!";
?>
</code>
</pre>

<div class="mt-6 p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
    <strong>Nota:</strong> Este código no muestra los comentarios, solo el mensaje.
</div>