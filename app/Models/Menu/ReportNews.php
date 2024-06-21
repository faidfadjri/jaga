<?php

namespace App\Models\Menu;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportNews extends Model
{
    use HasFactory;
    protected $table      = 'criminal_report_news';
    protected $primaryKey = 'id';
    protected $guarded    = ['id'];
    public $incrementing  = true;
}
