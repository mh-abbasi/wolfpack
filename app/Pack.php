<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * @OA\Schema(
 *   schema="Pack",
 *   type="object",
 *   required={"name"}
 * )
 *
 */
class Pack extends Model
{
    /**
     * @OA\Property(property="name", type="string")
     */

    use SoftDeletes;
    protected $fillable = ['name'];
    protected $hidden = ['pivot'];


    public function wolves()
    {
        return $this->belongsToMany(Wolf::class);
    }
}
