<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @OA\Schema(
 *   schema="Wolf",
 *   type="object",
 *   required={"name","gender","birthdate","location"}
 * )
 *
 */
class Wolf extends Model
{
    /**
     * @OA\Property(property="name", type="string" , example="Rex")
     * @OA\Property(property="gender", type="string", maxLength=1, example="m")
     * @OA\Property(property="birthdate", type="string", format="date", example="2020-09-03")
     * @OA\Property(property="location", type="string", example="51.4483,5.4728")
     */

    use SoftDeletes;

    protected $fillable = ['name','gender', 'birthdate', 'location'];
    protected $hidden = ['pivot'];



    public function packs()
    {
        return $this->belongsToMany(Pack::class);
    }
}
