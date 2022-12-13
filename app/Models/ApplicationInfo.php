<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApplicationInfo extends Model
{
    protected $fillable = [
        'application_id',
        'fio',
        'phone',
        'phone2',
        'telegram',
        'email',
        'work_place',
        'work_title',
        'work_address',
        'work_phone',
        'profession',
        'serial_number',
        'inn',
        'pin',
        'gender',
        'birth_date',
        'source',
        'person_photo',
        'passport_image',
        'passport_image1',
        'passport_image2',
        'file',
        'file2'
    ];

    public function application()
    {
        return $this->belongsTo(Application::class);
    }
}
