<?php

function ___icetea_error_handler($err_severity, $err_msg, $err_file, $err_line, array $err_context)
{
    echo "<h2>Whoops... Terjadi Error!</h2><br>";
    echo "File&nbsp;&nbsp;: ".htmlspecialchars($err_file)."<br>";
    echo "Line&nbsp;: ".$err_line."<br>";
    echo "Pesan Error : <b>".htmlspecialchars($err_msg)."</b><br><br>";
    echo "Penyebab kira-kira : <br><pre>".htmlspecialchars(file($err_file)[$err_line-1])."</pre><br><br>";
    echo "Debug backtrace : <br><br>";
    foreach (debug_backtrace() as $key => $value) {
        isset($value['file']) and print "File : ".htmlspecialchars($value['file'])."<br>" and
        isset($value['line']) and print "Line : ".htmlspecialchars($value['line'])."<br>" and
        isset($value['function']) and print "Function : ".htmlspecialchars($value['function'])."<br><br>";
    }
    echo "<br><br><!--";
}

set_error_handler("___icetea_error_handler");
