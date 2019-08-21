<?php

namespace App\Models\Ticket;

use App\Models\Auth\User\User;
use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class Tag extends Model
{
    use Userstamps;

    protected $fillable = ['name'];

    public function tickets()
    {
        return $this->belongsToMany(Ticket::class)->orderBy('id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
