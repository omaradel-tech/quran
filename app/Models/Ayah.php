<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Ayah extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'number',
        'text',
        'number_in_surah',
        'page',
        'surah_id',
        'hizb_id',
        'juz_id',
        'sajda',
        'textWithouttashkeel',
        'audio'
    ];

    public function surah()
    {
        return $this->belongsTo(Surah::class, 'surah_id');
    }
}
