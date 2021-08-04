<?php

use Src\Boot;
use Src\Engine\Dictionary\Dictionary;
use Src\Engine\Scrabble;

require_once 'Src/Boot.php';

$boot = new Boot();

$dictionary = new Dictionary($boot);

$scrabble = new Scrabble($dictionary);

$rack = isset($_GET["rack"]) ? $_GET["rack"] : "hjkhkaseiwiq";

/**
 * Engine = $scrabble
 *
 * to run a match use the method matchInDictionary
 * this will return an array of words and scores
 */

echo "<form>";
echo "<input type='text' name='rack' value='$rack'>";
echo "<input type='submit'>";
echo "</form>";

$results = $scrabble->matchInDictionary($rack);

if(count($results) == 0) echo "No matching words for that rack";

else foreach($results as $word => $score){
    echo "<b>$word</b> - ($score)</br>";
};

