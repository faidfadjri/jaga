<?php

namespace App\Models\Menu;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User;

class Report extends Model
{
    use HasFactory;
    protected $table      = 'criminal_report';
    protected $primaryKey = 'id';
    protected $guarded    = ['id'];
    public $incrementing  = true;

    public function pelapor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reportBy', 'id');
    }

    public function news(): HasOne
    {
        return $this->hasOne(ReportNews::class, 'reportId', 'id');
    }
}
