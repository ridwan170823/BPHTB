<?php

namespace App\Events;

use App\Models\Pelayanan;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PelayananRejected
{
    use Dispatchable, SerializesModels;

    /**
     * Create a new event instance.
     */
    public $pelayanan;

    public function __construct(Pelayanan $pelayanan)
    {
        $this->pelayanan = $pelayanan;
    }
}