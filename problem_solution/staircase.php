<?php
function staircase($num)
{
    for ($i = 0; $i < $num; $i++)
    {
        for($k = $num; $k > $i+1; $k-- )
        {
        echo " ";
        }

        for($j = 0; $j <= $i; $j++ )
            {
            echo "#";
            }

        echo "<br>";
    }
}

$num = 5;
staircase($num);
?>