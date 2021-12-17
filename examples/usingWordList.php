<?php

require __DIR__ . "/../../../../vendor/autoload.php";

use Jundayw\Bip39\WordList;

// locale etc:en|fr|it|zh|ja|ko|es
$wordList = new WordList();

// get the word for a index
echo "WordList 1: index=999  : " . $wordList->getWord(999) . PHP_EOL;
echo PHP_EOL;

// get the index for the word
echo "WordList 2: word=language  : " . $wordList->getIndex('language') . PHP_EOL;
echo PHP_EOL;
