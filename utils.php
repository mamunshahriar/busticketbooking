<?php
function esc($str) { return htmlspecialchars($str ?? '', ENT_QUOTES, 'UTF-8'); }
function post($key, $default = '') { return isset($_POST[$key]) ? trim($_POST[$key]) : $default; }
function get($key, $default = '') { return isset($_GET[$key]) ? trim($_GET[$key]) : $default; }
?>
