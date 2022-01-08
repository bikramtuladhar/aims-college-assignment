<?php
function higherThan(array $priceList, $limit)
{
    $higherThan = [];
    foreach ( $priceList as $key => $value ) {
        if ( $value > $limit ) {
            $higherThan[$key] = $value;
        }
    }

    return $higherThan;
}

function sumOfHigherThan($priceList, $limit)
{
    $sum = 0;
    foreach ( $priceList as $key => $value ) {
        if ( $value > $limit ) {
            $sum += $value;
        }
    }

    return $sum;
}

