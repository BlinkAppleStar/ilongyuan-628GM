<?php

function xmp($o, $add_inf = '') {
    echo '|********|<xmp>';
    echo $add_inf; print_r($o);
    echo '</xmp>|********|<br>';
}
function stop($o) {
    xmp($o);
    exit;
}
