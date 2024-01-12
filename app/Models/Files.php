<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Files extends Model
{
    use HasFactory;
    protected $table = 'files';
    protected $fillable = ['title','file_size','file_path'];

    public function requests(): BelongsTo
    {
        return $this->belongsTo(requests::class);
    }
}
