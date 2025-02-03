<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VacationRequest extends Model
{
    use HasFactory;

    protected $fillable = ['departement_id', 'user_id', 'start_date', 'end_date', 'reason', 'first_approval', 'second_approval', 'first_approval_update_at', 'second_approval_update_at'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function departement(): BelongsTo
    {
        return $this->belongsTo(Departement::class);
    }
}
