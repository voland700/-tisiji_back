<?php
if (! function_exists('getfolderName')) {
    function getfolderName(){
        return substr(str_shuffle("01234567890123456789"), 0, 2);
    }
}
