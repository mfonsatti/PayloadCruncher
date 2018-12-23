<?php
/**
 * Created by PhpStorm.
 * User: mfonsatti
 * Date: 22/12/18
 * Time: 16:51
 */

class PayloadCruncherTest extends \PHPUnit\Framework\TestCase
{
    public function testPayloadCruncher()
    {
        $payload = [
            "user" => [
                "name" => "matteo",
                "surname" => "fonsatti",
                "email" => "matteofonsatti@gmail.com",
                "worksOn" => [
                    0 => "PHP",
                    1 => "symfony"
                ],
                "commitOn" => [
                    0 => "GitHub",
                    1 => [
                        0 => "PayloadCruncher"
                    ]
                ]
            ],
            "ide" => [
                "data" => [
                    "version" => 2018
                ]
            ]
        ];

        $expected = [
            "userName" => "matteo",
            "userSurname" => "fonsatti",
            "userEmail" => "matteofonsatti@gmail.com",
            "userWorksOn" => [
                0 => "PHP",
                1 => "symfony"
            ],
            "userCommitOn_0" => "GitHub",
            "userCommitOn_1" => [
                0 => "PayloadCruncher"
            ],
            "ideDataVersion" => 2018
        ];

        $cruncher = new PayloadCruncher();
        $this->assertEquals($expected, $cruncher->payloadCruncher($payload));
    }
}