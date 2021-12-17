<?php

namespace Jundayw\Bip39;

use Jundayw\Bip32\BufferInterface;

interface MnemonicInterface
{
    /**
     * @param BufferInterface $entropy
     * @return string[]
     */
    public function entropyToWords(BufferInterface $entropy): array;

    /**
     * @param BufferInterface $entropy
     * @return string
     */
    public function entropyToMnemonic(BufferInterface $entropy): string;

    /**
     * @param string $mnemonic
     * @return BufferInterface
     */
    public function mnemonicToEntropy(string $mnemonic): BufferInterface;
}
