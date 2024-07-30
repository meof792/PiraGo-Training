<pre>
<?php
const NUM_OF_COLS = 9;
for ($i = 0; $i < floor(NUM_OF_COLS / 2) + 1; $i++) {
    for ($j = 0; $j < NUM_OF_COLS; $j++) {
        if ($j == floor(NUM_OF_COLS / 2) + $i || $j == floor(NUM_OF_COLS / 2) - $i || $i ==  floor(NUM_OF_COLS / 2)) {
            echo "* ";  
        } else {
            echo "  ";
        }
    }
    echo "\n";
}
?>
</pre>