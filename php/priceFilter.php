<?php
/**
 * @param array $priceList
 * @param       $limit
 *
 * @return array
 */
function higherThan(array $priceList, $limit)
{
    return array_filter($priceList, function ($price) use ($limit) {
        return $price > $limit;
    });
}

/**
 * @param $priceList
 * @param $limit
 *
 * @return int|mixed
 */
function sumOfHigherThan($priceList, $limit)
{
    $array = higherThan($priceList, $limit);

    return array_sum(array_values($array));
}

