<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $teacher_id
 * @property string $teacher_name
 * @property string $teacher_nik
 * @property string $teacher_specialization
 * @property string $teacher_position
 * @property string $teacher_phone
 * @property string|null $teacher_photo
 * @property string $teacher_password
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read User $user
 * 
 * @method static Teacher find($id)
 * @method static Teacher findOrFail($id)
 * @method static Teacher create(array $attributes = [])
 * @method static Teacher update(array $attributes = [])
 * @method bool save()
 * @method bool delete()
 */
class Teacher extends Model
{
    use HasFactory;

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'teacher_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'teacher_name',
        'teacher_nik',
        'teacher_specialization',
        'teacher_position',
        'teacher_phone',
        'teacher_photo',
        'teacher_password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'teacher_password',
    ];

    /**
     * Get the user that owns the teacher.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
} 