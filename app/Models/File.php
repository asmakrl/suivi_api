<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class File extends Model
{
    use HasFactory;
    protected $table = 'files';
    protected $fillable = ['title','file_path'];/**,'request_id','response_id'];**/

    /***public function request(): BelongsTo
    {
        return $this->belongsTo(Request::class);
    }

    public function response(): BelongsTo
    {
        return $this->belongsTo(Response::class);
    }***/

    public function fileable(): MorphTo
    {
        return $this->morphTo();
    }
}
