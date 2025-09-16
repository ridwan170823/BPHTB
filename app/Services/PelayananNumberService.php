<?php

namespace App\Services;

use App\Models\Pelayanan;
use Illuminate\Database\ConnectionInterface;

class PelayananNumberService
{
    private const NUMBER_LENGTH = 4;

    public function __construct(private readonly ConnectionInterface $connection)
    {
    }

    /**
     * Execute the given callback with a reserved Pelayanan number inside a transaction.
     *
     * @template T
     * @param  callable(string, string):T  $callback  Receives the active year and generated number.
     * @param  string|null  $tahun
     * @return T
     */
    public function createWithNextNumber(callable $callback, ?string $tahun = null)
    {
        $tahun = $tahun ?? date('Y');

        return $this->connection->transaction(function () use ($callback, $tahun) {
            $lastEntry = Pelayanan::query()
                ->where('tahun', $tahun)
                ->orderByDesc('no_urut_p')
                ->lockForUpdate()
                ->first();

            $nextNumber = $lastEntry ? ((int) $lastEntry->no_urut_p + 1) : 1;
            $noUrutPelayanan = str_pad((string) $nextNumber, self::NUMBER_LENGTH, '0', STR_PAD_LEFT);

            return $callback($tahun, $noUrutPelayanan);
        }, 5);
    }
}