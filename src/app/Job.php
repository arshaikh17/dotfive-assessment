<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
	protected $primaryKey = 'job_id';
	
    protected $fillable = [
        'user_id', 'job'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
