<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrintSize extends Model
{
    use HasFactory;

    public function PrintOrder(){
        return $this->belongsTo(PrintOrder::class,);
    }
}
