<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pembelian extends Model
{
    use HasFactory;

    /** 
    *
    *
    @return\Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function supplier(): BelongsTo
    {
        return $this->BelongsTo(supplier::class);
    }

}
