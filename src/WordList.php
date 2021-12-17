<?php

namespace Jundayw\Bip39;

use InvalidArgumentException;
use RuntimeException;

class WordList implements WordListInterface
{
    /**
     * @var array List of available langues.
     */
    protected $locales = [
        'en' => 'English',
        'fr' => 'French',
        'it' => 'Italian',
        'zh' => 'Chinese (simplified)',
        'ja' => 'Japanese',
        'ko' => 'Korean',
        'es' => 'Spanish',
    ];

    /**
     * @var string Current locale / dictionary name.
     */
    protected $locale = 'en';

    /**
     * @var array List of words in use for encoding / decoding.
     */
    protected $words;

    /**
     * @var array List a flipped words to speed up the searching of words
     */
    protected $wordsFlipped;

    /**
     * WordList constructor.
     *
     * @param string $locale
     */
    public function __construct(string $locale = 'en')
    {
        // thrown an exception if there's no word list for the requested locale.
        if (!array_key_exists($locale, $this->locales)) {
            throw new RuntimeException("Word list for the locale {$locale} is not available.");
        }

        // setups the current locale.
        $this->locale = $locale;

        // init the word list database.
        $this->words = $this->getWords();
    }

    /**
     * @return int
     */
    public function count(): int
    {
        return count($this->words);
    }

    /**
     * Path where a word list for a given locale lives.
     *
     * @return string
     */
    protected function getWordListPath(): string
    {
        return __DIR__ . "/../data/{$this->locale}.txt";
    }

    /**
     * Retrieve the word list from disk.
     *
     * @return string
     */
    protected function getWordListFromDisk(): string
    {
        return file_get_contents($this->getWordListPath());
    }

    /**
     * Split the word list string into an array of words.
     *
     * @return array
     */
    protected function getWordList(): array
    {
        return explode("\n", trim($this->getWordListFromDisk()));
    }

    /**
     * get the word list database.
     *
     * @return array
     */
    public function getWords(): array
    {
        return $this->getWordList();
    }

    /**
     * @param int $index
     * @return string
     */
    public function getWord(int $index): string
    {
        $words = $this->words;

        if (array_key_exists($index, $words)) {
            return $words[$index];
        } else {
            throw new InvalidArgumentException(__CLASS__ . " does not contain a word for index [{$index}]");
        }
    }

    /**
     * @param string $word
     * @return int
     */
    public function getIndex(string $word): int
    {
        // create a flipped word list to speed up the searching of words
        if ($this->wordsFlipped === null) {
            $this->wordsFlipped = array_flip($this->words);
        }

        if (array_key_exists($word, $this->wordsFlipped)) {
            return $this->wordsFlipped[$word];
        } else {
            throw new InvalidArgumentException(__CLASS__ . " does not contain a index for word [{$word}]");
        }
    }
}
