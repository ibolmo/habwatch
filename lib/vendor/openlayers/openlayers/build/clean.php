<?php

$ol = file_get_contents('OpenLayers.js');
$build = preg_replace('@\/\*(.*?)\*\/@ms', '', $ol);
$build = str_replace("\r\n", "\n", $build);
$build = preg_replace("/[\t ]+$/ms", '', $build);
$build = str_replace("\t\n", "\n", $build);
$build = str_replace("\n\n", "\n", $build);
$build = str_replace("\n\n\n", "\n", $build);
$build = str_replace("\n\n\n", "\n\n", $build);
$build = str_replace("\n\n\n\n", "\n\n", $build);
file_put_contents('OpenLayers2.js', $build);