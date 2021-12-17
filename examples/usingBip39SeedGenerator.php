<?php

require __DIR__ . "/../../../../vendor/autoload.php";

use Jundayw\Bip32\Random;
use Jundayw\Bip39\WordList;
use Jundayw\Bip39\Bip39Mnemonic;
use Jundayw\Bip39\Bip39SeedGenerator;

// locale etc:en|fr|it|zh|ja|ko|es
$wordList = new WordList();

// 创建助记词
$bip39 = new Bip39Mnemonic($wordList);
$mnemonic = $bip39->create(128);

echo "Bip39Mnemonic 1: create               : " . $mnemonic . PHP_EOL;
// 通过助记词生成种子
$seedGenerator = new Bip39SeedGenerator();
$seed = $seedGenerator->getSeed($mnemonic);

echo "Bip39SeedGenerator 2: getSeed         : " . $seed->getHex() . PHP_EOL;
echo PHP_EOL;