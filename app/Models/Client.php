<?php

namespace App\Models;

use App\Enums\Client\BloodType;
use App\Enums\Client\Gender;
use App\Models\Base\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Client extends BaseModel
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'user_id';

    public $incrementing = false;

    protected array $translatable = [
    ];
    protected $fillable = [
        'user_id',
        'city_id',
        'birth_date',
        'weight',
        'height',
        'blood_type',
        'health_status',
        'all_points',
        'active_points'
    ];

    protected $casts = [
        'blood_type' => BloodType::class,
        'birth_date' => 'datetime'
    ];

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

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function clientAddress(): HasMany
    {
        return $this->hasMany(ClientAddress::class,'client_id');
    }

    public function diseases(): BelongsToMany
    {
        return $this->belongsToMany(
            ChronicDisease::class,
            'client_disease',
            'client_id',
            'disease_id'
        )
            ->using(ClientDisease::class);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function medicationPackage(): HasMany
    {
        return $this->hasMany(MedicationPackage::class);
    }

    public function points(): HasMany
    {
        return $this->hasMany(Points::class, 'client_id');
    }

    public function discountCodes(): BelongsToMany
    {
        return $this->belongsToMany(
            DiscountCode::class,
            'client_discount_code',
            'client_id',
            'discount_code_id'
        )->using(ClientDiscountCode::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class,'client_id');
    }
}
