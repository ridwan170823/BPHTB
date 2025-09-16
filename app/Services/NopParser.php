<?php

namespace App\Services;

use InvalidArgumentException;

class NopParser
{
    private const REQUIRED_LENGTH = 18;

    /**
     * Parse a NOP string into its individual components.
     *
     * @param  string  $nop
     * @return array<string, string>
     */
    public function parse(string $nop): array
    {
        $normalized = preg_replace('/\D/', '', $nop);

        if ($normalized === null || $normalized === '') {
            throw new InvalidArgumentException('NOP harus berisi angka.');
        }

        if (strlen($normalized) !== self::REQUIRED_LENGTH) {
            throw new InvalidArgumentException(
                sprintf('NOP harus terdiri dari %d digit.', self::REQUIRED_LENGTH)
            );
        }

        return [
            'kd_propinsi' => substr($normalized, 0, 2),
            'kd_dati2' => substr($normalized, 2, 2),
            'kd_kecamatan' => substr($normalized, 4, 3),
            'kd_kelurahan' => substr($normalized, 7, 3),
            'kd_blok' => substr($normalized, 10, 3),
            'no_urut' => substr($normalized, 13, 4),
            'kd_jns_op' => substr($normalized, 17, 1),
        ];
    }
}