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
 *         description="Status of the SSL certificate"
 *     ),
 *     @OA\Property(
 *         property="issuer",
 *         type="string",
 *         description="Issuer of the SSL certificate"
 *     ),
 *     @OA\Property(
 *         property="valid",
 *         type="boolean",
 *         description="Indicates whether the certificate is valid"
 *     ),
 *     @OA\Property(
 *         property="signature_algorithm",
 *         type="string",
 *         description="Signature algorithm of the SSL certificate"
 *     ),
 *     @OA\Property(
 *         property="fingerprint",
 *         type="string",
 *         description="Fingerprint of the SSL certificate"
 *     ),
 *     @OA\Property(
 *         property="additional_domains",
 *         type="array",
 *         @OA\Items(
 *             type="string"
 *         ),
 *         description="Additional domains included in the SSL certificate"
 *     ),
 *     @OA\Property(
 *         property="expired",
 *         type="boolean",
 *         description="Indicates whether the SSL certificate is expired"
 *     ),
 *     @OA\Property(
 *         property="self_signed",
 *         type="boolean",
 *         description="Indicates whether the SSL certificate is self-signed"
 *     ),
 *     @OA\Property(
 *         property="valid_from",
 *         type="object",
 *         @OA\Property(
 *             property="date",
 *             type="string",
 *             format="datetime",
 *             description="Date from which the SSL certificate is valid"
 *         ),
 *         @OA\Property(
 *             property="timezone",
 *             type="string",
 *             description="Timezone of the valid from date"
 *         ),
 *         description="Information about the start date of the SSL certificate's validity"
 *     ),
 *     @OA\Property(
 *         property="expiration_date",
 *         type="object",
 *         @OA\Property(
 *             property="date",
 *             type="string",
 *             format="datetime",
 *             description="Date on which the SSL certificate expires"
 *         ),
 *         @OA\Property(
 *             property="timezone",
 *             type="string",
 *             description="Timezone of the expiration date"
 *         ),
 *         description="Information about the expiration date of the SSL certificate"
 *     )
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
