<?php
// Load helpers
$scan = scandir(__DIR__.'/../helpers');
unset($scan[0], $scan[1]);
foreach ($scan as $file) {
    include __DIR__.'/../helpers/'.$file;
}
