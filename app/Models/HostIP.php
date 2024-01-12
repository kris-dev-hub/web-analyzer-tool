<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="HostIP",
 *     type="object",
 *     @OA\Property(
 *         property="ip",
 *         type="string",
 *         description="The IP address of the host",
 *     ),
 *     @OA\Property(
 *         property="hostname",
 *         type="string",
 *         description="The hostname of the IP address",
 *     )
 * )
 */
class HostIP extends Model
{
    use HasFactory;

    protected $fillable = ['host', 'ip'];
}
