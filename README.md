# 安装方法
命令行下, 执行 composer 命令安装:
````
composer require jundayw/bip39-sdk-php
````

## WordList

```php
use Jundayw\Bip39\WordList;

// locale etc:en|fr|it|zh|ja|ko|es
$wordList = new WordList();

// get the word for a index
echo "WordList 1: index=999  : " . $wordList->getWord(999) . PHP_EOL;
echo PHP_EOL;

// get the index for the word
echo "WordList 2: word=language  : " . $wordList->getIndex('language') . PHP_EOL;
echo PHP_EOL;
```

## Bip39Mnemonic

### create
```php
use Jundayw\Bip32\Random;
use Jundayw\Bip39\WordList;
use Jundayw\Bip39\Bip39Mnemonic;

// locale etc:en|fr|it|zh|ja|ko|es
$wordList = new WordList();

$bip39 = new Bip39Mnemonic($wordList);
$mnemonic = $bip39->create(128);

echo "Bip39Mnemonic 1: create               : " . $mnemonic . PHP_EOL;
$entropy = $bip39->mnemonicToEntropy($mnemonic);
echo "Bip39Mnemonic 2: mnemonicToEntropy    : " . $entropy->getHex() . PHP_EOL;
$mnemonic = $bip39->entropyToMnemonic($entropy);
echo "Bip39Mnemonic 3: entropyToMnemonic    : " . $mnemonic . PHP_EOL;
echo PHP_EOL;
```

### random
```php
use Jundayw\Bip32\Random;
use Jundayw\Bip39\WordList;
use Jundayw\Bip39\Bip39Mnemonic;

// locale etc:en|fr|it|zh|ja|ko|es
$wordList = new WordList();

$bip39 = new Bip39Mnemonic($wordList);

$random  = new Random();
$entropy = $random->bytes(16);

echo "Bip39Mnemonic 4: Random               : " . $entropy->getHex() . PHP_EOL;
$mnemonic = $bip39->entropyToMnemonic($entropy);
echo "Bip39Mnemonic 5: entropyToMnemonic    : " . $mnemonic . PHP_EOL;
$entropy = $bip39->mnemonicToEntropy($mnemonic);
echo "Bip39Mnemonic 6: mnemonicToEntropy    : " . $entropy->getHex() . PHP_EOL;
echo PHP_EOL;
```

## Bip39SeedGenerator
```php
use Jundayw\Bip32\Random;
use Jundayw\Bip39\WordList;
use Jundayw\Bip39\Bip39Mnemonic;
use Jundayw\Bip39\Bip39SeedGenerator;

// locale etc:en|fr|it|zh|ja|ko|es
$wordList = new WordList();

$bip39 = new Bip39Mnemonic($wordList);
$mnemonic = $bip39->create(128);

echo "Bip39Mnemonic 1: create               : " . $mnemonic . PHP_EOL;

$seedGenerator = new Bip39SeedGenerator();
$seed = $seedGenerator->getSeed($mnemonic);

echo "Bip39SeedGenerator 2: getSeed         : " . $seed->getHex() . PHP_EOL;
echo PHP_EOL;
```