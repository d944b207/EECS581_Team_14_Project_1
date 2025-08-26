<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Minesweeper Game</title>
</head>

<body>

    <?php

    echo "<table border='1'>"; // Starts table with border style

    $mine_number = $_POST["mine_number"];

    $space_blank = array_fill(0, 100 - $mine_number, '_');
    $space_mine = array_fill(100 - $mine_number, $mine_number, '*');

    $minefield = array_merge($space_blank, $space_mine);
    shuffle($minefield);

    foreach ($minefield as $key => $value) {
        $mines_nearby = 0;
        if ($value != "*") {
            if (array_key_exists($key - 11, $minefield) && $minefield[$key - 11] == "*") {
                $mines_nearby++;
            }
            if (array_key_exists($key - 10, $minefield) && $minefield[$key - 10] == "*") {
                $mines_nearby++;
            }
            if (array_key_exists($key - 9, $minefield) && $minefield[$key - 9] == "*") {
                $mines_nearby++;
            }
            if (array_key_exists($key - 1, $minefield) && $minefield[$key - 1] == "*") {
                $mines_nearby++;
            }
            if (array_key_exists($key + 1, $minefield) && $minefield[$key + 1] == "*") {
                $mines_nearby++;
            }
            if (array_key_exists($key + 9, $minefield) && $minefield[$key + 9] == "*") {
                $mines_nearby++;
            }
            if (array_key_exists($key + 10, $minefield) && $minefield[$key + 10] == "*") {
                $mines_nearby++;
            }
            if (array_key_exists($key + 11, $minefield) && $minefield[$key + 11] == "*") {
                $mines_nearby++;
            }
            $minefield[$key] = $mines_nearby;
        }
    }

    $index = 0;

    for ($i = 0; $i < 10; $i++) {
        echo "<tr>";    // New row

        // Makes new column for row
        for ($j = 0; $j < 10; $j++) {
            echo "<td style='padding:10px;' id='$index' value='$minefield[$index]'>" . $minefield[$index] . "</td>";
            $index++;
        }
        echo "</tr>"; // Ends row
    }

    echo "</table>";

    ?>

</body>

</html>