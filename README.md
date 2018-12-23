# PayloadCruncher
this function take an associative array and return all the element's in a format that can be tracked from MIX PANEL.
MIX PANEL needs to receive data like single properties . Only sequential array's can be passed directly and will be converted to MIX PANEL LIST. 

```PHP
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
```

will return ...

```PHP
$payload = [
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
```
