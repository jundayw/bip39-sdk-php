<?php

namespace Jundayw\Bip39;

use Exception;
use Normalizer;
use Jundayw\Bip32\Hash;
use Jundayw\Bip32\Buffer;
use Jundayw\Bip32\BufferInterface;

class Bip39SeedGenerator
{
    /**
     * @param string $string
     * @return BufferInterface
     * @throws Exception
     */
    private function normalize(string $string): BufferInterface
    {
        if (class_exists('Normalizer')) {
            return new Buffer(Normalizer::normalize($string, Normalizer::FORM_KD));
        }
        
        if (mb_detect_encoding($string) === 'UTF-8') {
            throw new Exception('UTF-8 passphrase is not supported without the PECL intl extension installed.');
        } else {
            return new Buffer($string);
        }
    }

    /**
     * @param string $mnemonic
     * @param string $passphrase
     * @return BufferInterface
     * @throws Exception
     */
    public function getSeed(string $mnemonic, string $passphrase = ''): BufferInterface
    {
        return Hash::pbkdf2(
            'sha512',
            $this->normalize($mnemonic),
            $this->normalize("mnemonic{$passphrase}"),
            2048,
            64
        );
    }
}
