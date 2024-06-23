<?php

namespace App\Models\Menu;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User;

class Record extends Model
{
    use HasFactory;
    protected $table      = 'criminal_records';
    protected $primaryKey = 'id';
    protected $guarded    = ['id'];
    public $incrementing  = true;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'userId', 'id');
    }
}
