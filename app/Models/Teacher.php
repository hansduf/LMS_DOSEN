<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Hash;

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
    use HasFactory, SoftDeletes;

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
        'user_id',
        'teacher_name',
        'teacher_nik',
        'teacher_specialization',
        'teacher_position',
        'teacher_email',
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
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * Get the user that owns the teacher.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getAuthPassword()
    {
        return $this->teacher_password;
    }

    public function setTeacherPasswordAttribute($value)
    {
        $this->attributes['teacher_password'] = Hash::make($value);
    }
} 