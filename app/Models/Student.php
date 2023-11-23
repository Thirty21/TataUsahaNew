<?php

namespace App\Models;

use App\Enums\Config as ConfigEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'nis',
        'nama',
        'tanggal_lahir',
        'gender',
        'alamat',
    ];

    public function scopeSearch($query, $search)
    {
        return $query->when($search, function($query, $find) {
            return $query
                ->where('nis', 'LIKE', $find . '%')
                ->orWhere('nama', 'LIKE','%' . $find. '%')
                ->orWhere('gender', 'LIKE','%' . $find. '%')
                ->orWhere('alamat', 'LIKE', '%' . $find . '%');
        });
    }


     public function scopeRender($query, $search)
    {
        return $query
            ->search($search)
            ->paginate(Config::getValueByCode(ConfigEnum::PAGE_SIZE))
            ->appends([
                'search' => $search,
            ]);
    }

}
