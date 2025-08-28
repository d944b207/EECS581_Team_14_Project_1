<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Minesweeper Game</title>
</head>

<body>

    <?php

    echo "<table border='1'>"; // Starts table with border style

    $mine_number = $_POST["mine_number"];   // Gets number of mines from index.html form submission

    $space_blank = array_fill(0, 100 - $mine_number, '_');  // Makes an array from 100-(number of mines) with blanks
    $space_mine = array_fill(100 - $mine_number, $mine_number, '*'); // Makes the rest of the 100-array with mines (*)

    $minefield = array_merge($space_blank, $space_mine); // Merges the two arrays
    shuffle($minefield);    // Shuffles the values

    foreach ($minefield as $key => $value) {    // Fills in blank spaces with values depending on how many mines are nearby
        $mines_nearby = 0;  // Counts how many mines are nearby in a 3x3 grid

        if ($value != "*") { // If the array index isn't a mine

            if (array_key_exists($key - 11, $minefield) && $minefield[$key - 11] == "*") {  // If there's a mine at the Top Left
                $mines_nearby++;    // Increase mines_nearby count
            }
            if (array_key_exists($key - 10, $minefield) && $minefield[$key - 10] == "*") {  // Top
                $mines_nearby++;
            }
            if (array_key_exists($key - 9, $minefield) && $minefield[$key - 9] == "*") {    // Top Right
                $mines_nearby++;
            }
            if (array_key_exists($key - 1, $minefield) && $minefield[$key - 1] == "*") {    // Left
                $mines_nearby++;
            }
            if (array_key_exists($key + 1, $minefield) && $minefield[$key + 1] == "*") {    // Right
                $mines_nearby++;
            }
            if (array_key_exists($key + 9, $minefield) && $minefield[$key + 9] == "*") {    // Bottom Left
                $mines_nearby++;
            }
            if (array_key_exists($key + 10, $minefield) && $minefield[$key + 10] == "*") {  // Bottom
                $mines_nearby++;
            }
            if (array_key_exists($key + 11, $minefield) && $minefield[$key + 11] == "*") {  // Bottom Right
                $mines_nearby++;
            }
            $minefield[$key] = $mines_nearby;   // Assigns array index to count of mines nearby
        }
    }

    $index = 0; // Index to traverse through minefield array

    for ($i = 0; $i < 10; $i++) {
        echo "<tr>";    // New row

        // Makes new column for row
        for ($j = 0; $j < 10; $j++) {
            echo "<td style='padding:10px;' id='space_$index' value='$minefield[$index]'><button onclick='open_mine($index)' id='button_$index' value='$minefield[$index]'>MINE</button></td>";
            $index++;   // Increase index
        }

        echo "</tr>"; // Ends row
    }

    echo "</table>";

    ?>

</body>

<script>
    function open_mine(index) {
        let removed_button = document.getElementById("button_" + index); // Gets button
        let value = removed_button.value; // Gets buttons's value (mine/count of mines nearby, for some reason, can't get value from space_index)
        removed_button.remove(); // Deletes button
        let space_revealed = document.getElementById("space_" + index); // Gets space (table data cell) where button was
        space_revealed.innerHTML = value; // Shows mine/mines nearby on space
    }
</script>

</html>