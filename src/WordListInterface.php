<?php

namespace Jundayw\Bip39;

use Countable;

interface WordListInterface extends Countable
{
    /**
     * @return string[]
     */
    public function getWords(): array;

    /**
     * @param int $index
     * @return string
     */
    public function getWord(int $index): string;

    /**
     * @param string $word
     * @return integer
     */
    public function getIndex(string $word): int;
}
