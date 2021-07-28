<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PiezaOCStock extends Model
{
    use HasFactory;
    protected $table= 'piezaocstock';
    protected $primaryKey = 'NroOC';
    public $timestamps = false;
    public $incrementing = false;
    
    
}