<pre>
<?php
    const NUM_OF_COLS = 5;
    for ($i = 0; $i < NUM_OF_COLS; $i++) {
        if ($i == 0 || $i == NUM_OF_COLS - 1) {
            for ($j = 0; $j < NUM_OF_COLS; $j++) {
                echo "* ";
            }
        } else {
            for ($j = 0; $j < NUM_OF_COLS; $j++) {
                if ($j == 0 || $j == NUM_OF_COLS - 1) {
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