<?php

    if (isset($_GET['expr'])) {
        require_once '../../src/php/Expressor.php';
        $expressor = new Expressor();

        $expr = rawurldecode($_GET['expr']);

        echo $expressor->calculate($expr);

    }

?>
