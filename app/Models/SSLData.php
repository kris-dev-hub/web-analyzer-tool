<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="SSLData",
 *     type="object",
 *     @OA\Property(
 *         property="status",
 *         type="string",
 *         description="Status of the SSL certificate",
 *     ),
 *     @OA\Property(
 *         property="issuer",
 *         type="string",
 *         description="Issuer",
 *     ),
 *     @OA\Property(
 *          property="valid",
 *          type="bool",
 *          description="Is cerfiticate valid",
 *      ),
 * )
 */
class SSLData extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'issuer',
        'valid',
        'signature_algorithm',
        'fingerprint',
        'additional_domains',
        'expired',
        'self_signed',
        'valid_from', // Consider storing as JSON or as a separate date and timezone fields
        'expiration_date', // Consider storing as JSON or as a separate date and timezone fields
        'https_redirect', // If you are storing the result of checkSSLRedirect
        'msg' // For storing error messages
    ];

    // If you're using JSON fields for 'valid_from' and 'expiration_date', you might want to cast them
    protected $casts = [
        'valid_from' => 'array',
        'expiration_date' => 'array',
        'additional_domains' => 'array', // If this is an array
    ];
}
