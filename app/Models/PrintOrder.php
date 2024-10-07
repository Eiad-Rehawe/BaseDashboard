<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrintOrder extends Model
{
    use HasFactory;
    protected $fillable = ['first_name', 'last_name', 'phone', 'province', 'region', 'address', 'print_size_id', 'quantity', 'image'];
    public function PrintSize(){
        return $this->hasMany(PrintSize::class);
    }
}
