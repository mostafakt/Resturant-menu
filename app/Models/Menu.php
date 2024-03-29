<?php

namespace App\Models;

use App\Models\Base\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Menu extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'image_id',
        'main_category_id',
        'name',
        'discount_value',

    ];


    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'main_category_id');
    }


    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by')->withTrashed();
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by')->withTrashed();
    }

    public function deletedBy()
    {
        return $this->belongsTo(User::class, 'deleted_by')->withTrashed();
    }

    public function image(): BelongsTo
    {
        return $this->belongsTo(Medium::class, 'image_id');
    }

}
