<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Http\Enums\GenderConstant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Surah extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'number',
        'name_ar',
        'name_en',
        'name_en_translation',
        'type'

    ];

    public function getFirstPage()
    {
        return $this->ayahs->min('page');
    }

    public function getLastPage()
    {
        return $this->ayahs->max('page');
    }

    public function getTypeAttribute($value)
    {
        if(request()->has('lang') && request('lang') != 'en')
        {
            $value = $value == 'Meccan' ? 'مكية' : 'مدنية';
        }

        return $value;
    }

    public function ayahs()
    {
        return $this->hasMany(Ayah::class, 'surah_id');
    }
}
