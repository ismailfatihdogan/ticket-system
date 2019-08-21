<?php

namespace App\Models\Ticket;

use App\Models\Auth\User\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

/**
 * App\Models\Ticket\Ticket
 *
 * @property int $id
 * @property string $title
 * @property string $content
 * @property boolean $status
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property int $created_by
 * @property int $updated_by
 * @property int $deleted_by
 *
 * @property Tag[] $tags
 * @property User $creator
 * @property User $editor
 * @property User $destroyer
 */
class Ticket extends Model
{
    use SoftDeletes, Userstamps;

    const COMPLETED = 'completed';
    const PROCESSING = 'processing';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'content', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class)->orderBy('name');
    }
}
