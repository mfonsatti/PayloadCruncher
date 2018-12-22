<?php
/**
 * Created by PhpStorm.
 * User: mfonsatti
 * Date: 22/12/18
 * Time: 16:42
 */

class PayloadCruncher
{
    /**
     * PayloadCruncher constructor.
     */
    public function __construct()
    {
    }

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
                    foreach ($value as $data) {
                        if (!is_scalar($data)) {
                            $containsOtherArray = true;
                            break;
                        }
                    }
                    if (!$containsOtherArray) {
                        $results[lcfirst(implode("", $keyChain))] = $value;
                    } else {
                        foreach ($value as $index => $data) {
                            $results[lcfirst(implode("", $keyChain)) . '_' . $index] = $data;
                        }
                    }
                    array_pop($keyChain);
                } else {
                    $this->payloadCruncher($value, $keyChain, $results);
                }
            } else {
                $results[lcfirst(implode("", $keyChain) . ucfirst($key))] = $value;
            }
        }

        array_pop($keyChain);

        return $results;
    }
}
