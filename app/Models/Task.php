<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public const DONE = 1;
    public const DOING = 0;

    public const STATUSES = [
        self::DONE => 'Done',
        self::DOING => 'Doing'
    ];

    public function getTypeStatusAttribute()
    {
        return $this::STATUSES[$this->status];
    }

    //--------------------- Helper Methods -----------------------\\
    public function stoggleStatus()
    {
        if ($this->status == self::DOING) {
            $this->status = self::DONE;
        } else {
            $this->status = self::DOING;
        }
        return $this;
    }

    //--------------------- Relation Methods -----------------------\\
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
