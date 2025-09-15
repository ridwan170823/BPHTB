<?php

namespace App\Events;

use App\Models\Pelayanan;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PelayananStageApproved
{
    use Dispatchable, SerializesModels;

    public $pelayanan;
    public string $nextRole;

    public function __construct(Pelayanan $pelayanan, string $nextRole)
    {
        $this->pelayanan = $pelayanan;
        $this->nextRole = $nextRole;
    }
}