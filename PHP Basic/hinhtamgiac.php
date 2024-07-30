<?php
const NUM_OF_COLS = 5;
for($i = 0; $i < NUM_OF_COLS; $i++){
    for($j = 0; $j <= $i; $j++){
        echo "* ";
    }
    echo "<br>";
}
?>