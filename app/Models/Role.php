<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
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

    
    /**
	 * The attributes that should be mutated to dates.
	 *
	 * @var array
	 */
    protected $dates = [
		'deleted_at',
	];

    public function user()
    {
        return $this->hasOne( User::class );
    }

}
