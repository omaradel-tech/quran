<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class AyahEdition extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'ayah_edition';

    protected $fillable = [
        'ayah_id',
        'edition_id',
        'data',
        'is_audio',
    ];

    public function ayah()
    {
        return $this->belongsTo(Ayah::class, 'ayah_id');
    }
}
