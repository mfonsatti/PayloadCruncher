<?php

$payload = [
    "pippo"  => "pluto",
    "gianni" => [
        "cane"    => "dio",
        "madonna" => [
            "lercia" => 0
        ],
        "porco"   => [
            "cazzo" => [
                0 => "dimenticavo questo",
                1 => "non male"
            ],
            "madonna" => "sborrata"
        ],
        "enzo"    => "stronzo",
        "maiale" => [
            0 => "dio",
            1 => [
                0 => "puttane"
            ]
        ]
    ],
    "gesu"   => "palestinese"
];

/**
 * @param array $payload
 * @param array $keyChain
 * @param array $results
 *
 * @return array
 */
function payloadCruncher(array $payload, array &$keyChain = [], array &$results = []): array
{
    foreach ($payload as $key => $value) {
        if (!is_scalar($value)) {
            $keyChain[] = ucfirst($key);
            //if $value is a sequential array
            if (array_keys($value) === range(0, count($value) - 1)) {
                $containsOtherArray = false;
                foreach ($value as $data){
                    if (!is_scalar($data)){
                        $containsOtherArray = true;
                        break;
                    }
                }
                if(!$containsOtherArray){
                    $results[lcfirst(implode("", $keyChain))] = $value;
                } else {
                    foreach ($value as $index => $data) {
                        $results[lcfirst(implode("", $keyChain)).'_'.$index] = $data;
                    }
                }
                array_pop($keyChain);
            } else {
                payloadCruncher($value, $keyChain, $results);
            }
        } else {
            $results[lcfirst(implode("", $keyChain) . ucfirst($key))] = $value;
        }
    }

    array_pop($keyChain);

    return $results;
}

$results = payloadCruncher($payload);

$test = true;