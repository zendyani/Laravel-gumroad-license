<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FigmaUser extends Model
{
    use HasUuids;
    use HasFactory;

    protected $fillable = ['api_key', 'figma_id', 'figma_name'];

    public function licenses()
    {
        return $this->belongsToMany(License::class, 'figma_user_license');
    }
}
