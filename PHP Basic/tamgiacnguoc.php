<pre>
<?php
const NUM_OF_COLS = 9;
for ($i = 0; $i < floor(NUM_OF_COLS / 2) + 1; $i++) {
    for ($j = 0; $j < NUM_OF_COLS; $j++) {
        if ($i == 0) {
            echo "* ";
        } else {
            if ($j > $i - 1  && $j < NUM_OF_COLS - $i) {
                echo "* ";
            } else {
                echo "  ";
            }
        }
    }
    echo "\n";
}
?>
</pre>