<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;
    public $table = 'documents';
    protected $fillable = [
            'original_filename',
            'size',    
            'extension',
            'filename',
            'user_id',
        
    ];
}
