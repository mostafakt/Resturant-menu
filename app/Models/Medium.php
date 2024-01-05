<?php

namespace App\Models;

use App\Enums\Medium\MediumFor;
use App\Enums\Medium\MediumType;
use App\Models\Base\BaseModel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;

class Medium extends BaseModel
{
    use HasFactory;

    public const UPDATED_AT = null;
    public const UPDATED_BY = null;
    public const CREATED_BY = null;

    protected $fillable = [
        'id', 'path', 'extension', 'for', 'type',
    ];

    protected $casts = [
        'for' => MediumFor::class,
        'type' => MediumType::class
    ];

    protected function url(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                if (!Storage::disk('public')->exists($this->path)) {
                    return 'https://picsum.photos/800/800?' . random_int(0, 1000);
                }
                return asset(Storage::url($this->path));
            },
        );
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by')->withTrashed();
    }
}
