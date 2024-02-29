<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class File extends Model
{
    use HasFactory;
    protected $table = 'files';
    protected $fillable = ['file_path','request_id'];

    public function request(): BelongsTo
    {
        return $this->belongsTo(request::class);
    }
}
