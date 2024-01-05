<?php

namespace App\Models;

use App\Models\Base\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Category extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'image_id',
        'main_image_id',
        'parent_id',
        'grand_id',
        'order',

        'name',
    ];


    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function childes()
    {
        return Category::where('parent_id', $this->id)->get();
    }

    public function grand(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'grand_id');
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

    public function mainImage(): BelongsTo
    {
        return $this->belongsTo(Medium::class, 'main_image_id');
    }


}