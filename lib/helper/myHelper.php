<?php

/**
 * credit to: http://us.php.net/manual/en/function.number-format.php#89655
 */
function ordinal($num)
{
    // Special case "teenth"
    if ( ($num / 10) % 10 != 1 ){
        // Handle 1st, 2nd, 3rd
        switch( $num % 10 ){
            case 1: return $num . 'st';
            case 2: return $num . 'nd';
            case 3: return $num . 'rd'; 
        }
    }
    // Everything else is "nth"
    return $num . 'th';
}