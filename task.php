<?php

$skills = [
    'bike',
    'driving license',
    (object)['type' => 'car', 'doors' => 4],
];

$jobs =json_decode('[
    {
        "name": "Company XXX",
        "requirements": [["bike", "XXX"], "driving license"]
    },
    {
        "name": "Company A",
        "requirements": [["apartment", "house"], "property insurance"]
    },
    {
        "name": "Company B",
        "requirements": [
            { "type": "car", "doors": [4, 5] },
            "driving license",
            "car insurance"
        ]
    },
    {
        "name": "Company C",
        "requirements": ["social security number", "work permit"]
    },
    {
        "name": "Company D",
        "requirements": [["apartment", "flat", "house"]]
    },
    {
        "name": "Company E",
        "requirements": [{ "type": "car", "doors": [2, 3, 4, 5] }, "driving license"]
    },
    {
        "name": "Company F",
        "requirements": [
            ["scooter", "bike", "motorcycle", "work permit"],
            " motorcycle insurance",
            "car insurance"
        ]
    },
    {
        "name": "Company G",
        "requirements": ["massage qualification certificate", "liability insurance"]
    },
    {
        "name": "Company H",
        "requirements": [["storage place", "garage"]]
    },
    {
        "name": "Company J",
        "requirements": []
    },
    {
        "name": "Company H",
        "requirements": [["PayPal account"]]
    }
]');

function checkRequirement($requirement, $skills){
    if (is_string($requirement)) {
        if (in_array($requirement, $skills)) {
            return true;
        }
    } else {
        foreach ($skills as $skill) {
            if (is_object($skill) && $skill->type === $requirement->type) {
                $result = true;
                foreach ($requirement as $key => $value) {
                    if ($key !== 'type') {
                        if (!in_array( $skill->{$key},$requirement->{$key})) {
                            $result =  false;
                        }
                    }
                }
                return $result;
            }
        }
    }
}

$response = [];
foreach ($jobs as $job) {
    $result = true;
    foreach ($job->requirements as $requirement) {
        if (is_array($requirement)) {
            $subResult = false;
            foreach ($requirement as $param){
                if(checkRequirement($param, $skills)){
                    $subResult = true;
                    break;
                }
            }
            if(!$subResult) $result = false;
        } else {
            if(!checkRequirement($requirement, $skills)){
                $result = false;
                break;
            }
        }
    }
    if ($result) {
        array_push($response,$job->name);
    }
}
var_dump($response);
