<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaintenanceOrder extends Model
{
    use HasFactory;
    protected $fillable = ['first_name', 'last_name', 'phone', 'province', 'region', 'address', 'problem_cause', 'description'];

}
