<?php
// dynamic table => 3 levels only
// dynamic rows //4 
// dynamic columns // 4
// check if gender of user == m ==> male // 1
// check if gender of user == f ==> female // 1

$users = [
    (object)[
        'id' => 1,
        'name' => 'ahmed',
        "gender" => (object)[
            'gender' => 'm'
        ],
        'hobbies' => [
            'football', 'swimming', 'running',
        ],
        'activities' => [
            "school" => 'drawing',
            'home' => 'painting'
        ],
        // 'phones'=>"0123123",
    ],
    (object)[
        'id' => 2,
        'name' => 'mohamed',
        "gender" => (object)[
            'gender' => 'm'
        ],
        'hobbies' => [
            'swimming', 'running',
        ],
        'activities' => [
            "school" => 'painting',
            'home' => 'drawing'
        ],
        // 'phones'=>"2345",
    ],
    (object)[
        'id' => 3,
        'name' => 'menna',
        "gender" => (object)[
            'gender' => 'f'
        ],
        'hobbies' => [
            'running',
        ],
        'activities' => [
            "school" => 'painting',
            'home' => 'drawing'
        ],
        // 'phones'=>"",
    ],
    (object)[
        'id' => 4,
        'name' => 'Nourhan',
        "gender" => (object)[
            'gender' => 'f'
        ],
        'hobbies' => [
            'running',
        ],
        'activities' => [
            "school" => 'painting',
            'home' => 'drawing'
        ],
        // 'phones'=>"",
    ]
];

// foreach($users As  => $values)    {
//     foreach($values as $value){
//        if{ };
//     echo $value;
// }
// }
?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        h1 {
            text-align: center;
            margin-top: 100px;
            text-decoration: underline;
        }

        table {
            width: 70%;
            height: 380px;
            margin: auto;
            margin-top: 150px;
            background-color: #171e7238;
            border: 1px solid #00000059;
            color: #000;
        }

        tr th {
            background-color: #e70c2069;
            color: #000;
            text-align: center;
            height: 50px;
            font-size: 20px;
            border: 1px solid #1414141f;
            text-transform: capitalize;

        }

        tr td {
            background-color: grey;
            text-align: center;
            font-size: 20px;
            color: #000;
            text-transform: capitalize;

        }
    </style>
</head>

<body>
    <h1> Dynamic Table</h1>
    <table>

        <tr>
            <?php foreach ($users[0] as $key => $value) { ?>
                <th> <?php echo $key ?> </th>
            <?php  } ?>
        </tr>

        <tbody>

            <!-- echo json_decode()?> -->
            <?php foreach ($users as $usersIndex) { ?>
                <tr>
                    <?php foreach ($usersIndex as $values) { ?>
                        <td>
                            <?php if (is_array($values) || is_object($values)) { ?>
                    <?php foreach ($values as $inputs) {
                                    if ($inputs == "m") {
                                        $inputs = "male";
                                    } elseif ($inputs == "f") {
                                        $inputs = "female";
                                    }
                                    echo $inputs . "<br>";
                                }
                            } else {
                                echo $values;
                            }
                        }
                    }
                    // if($inputs->gender ==" m"){
                    //     echo 'male';
                    // }
                    // else{
                    //     echo 'female';
                    // }

                    ?>
                        </td>
                </tr>

        </tbody>

    </table>
</body>

</html>