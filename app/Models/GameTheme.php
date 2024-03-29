<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameTheme extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    public function games()
    {
        return $this->hasMany(Game::class);
    }

    public function themeObjects()
    {
        return $this->belongsTo(ThemeObject::class,'game_theme_id');
    }

}
