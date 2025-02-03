<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Departement extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = [
        'name',
        'first_approver_id',
        'second_approver_id',
    ];


    public function firstApprover(): BelongsTo
    {
        return $this->belongsTo(User::class, 'first_approver_id');
    }

    public function secondApprover(): BelongsTo
    {
        return $this->belongsTo(User::class, 'second_approver_id');
    }

    public function vacationRequests()
    {
        return $this->hasMany(VacationRequest::class);
    }
}
