<?php

namespace App\Events;

use App\Models\Pelayanan;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PelayananApproved
{
    use Dispatchable, SerializesModels;

    public $pelayanan;

    public function __construct(Pelayanan $pelayanan)
    {
        $this->pelayanan = $pelayanan;
    }
}