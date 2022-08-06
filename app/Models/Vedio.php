<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vedio extends Model
{
    use HasFactory;
    public $table = 'vedios';
    protected $fillable = [
            'original_filename',
            'vedsize',    
            'extension',
            'filename',
            'user_id',
        
    ];
}
