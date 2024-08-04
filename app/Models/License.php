<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class License extends Model
{
    use HasUuids;
    use HasFactory;

    protected $fillable = [
        'license', 'email', 'product_permalink', 'product_name', 'price', 'ip_country', 'recurrence', 'uses', 'sale_timestamp', 'product_code', 'subscription_ended_at', 'subscription_cancelled_at', 'subscription_failed_at'
    ];

    public function figmaUsers()
    {
        return $this->belongsToMany(FigmaUser::class, 'figma_user_license');
    }
}
