<?php

    if (isset($_GET['expr'])) {
        require_once '../../src/php/Expressor.php';
        $expressor = new Expressor();

//        echo urldecode($_GET['expr']);

        $expr = rawurldecode($_GET['expr']);

        if (preg_match("/[a-z]/i", $expr)) {
            echo 'Error parsing expression';
            exit(0);
        }

        echo $expressor->calculate($expr);

    }

?>