<?php

require __DIR__ . "/../../../../vendor/autoload.php";

use Jundayw\Bip32\Random;
use Jundayw\Bip39\WordList;
use Jundayw\Bip39\Bip39Mnemonic;

// locale etc:en|fr|it|zh|ja|ko|es
$wordList = new WordList();

$bip39 = new Bip39Mnemonic($wordList);
// 创建助记词
$mnemonic = $bip39->create(128);

echo "Bip39Mnemonic 1: create               : " . $mnemonic . PHP_EOL;
$entropy = $bip39->mnemonicToEntropy($mnemonic);
echo "Bip39Mnemonic 2: mnemonicToEntropy    : " . $entropy->getHex() . PHP_EOL;
$mnemonic = $bip39->entropyToMnemonic($entropy);
echo "Bip39Mnemonic 3: entropyToMnemonic    : " . $mnemonic . PHP_EOL;
echo PHP_EOL;

// 通过随机数生成助记词
$random  = new Random();
$entropy = $random->bytes(16);

echo "Bip39Mnemonic 4: Random               : " . $entropy->getHex() . PHP_EOL;
$mnemonic = $bip39->entropyToMnemonic($entropy);
echo "Bip39Mnemonic 5: entropyToMnemonic    : " . $mnemonic . PHP_EOL;
$entropy = $bip39->mnemonicToEntropy($mnemonic);
echo "Bip39Mnemonic 6: mnemonicToEntropy    : " . $entropy->getHex() . PHP_EOL;
echo PHP_EOL;