<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SSLDataController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/ssldata/{host}",
     *     operationId="getSSLData",
     *     tags={"SSL"},
     *     summary="Get SSL details for the host",
     *     description="Returns SSL info for a specific host",
     *     @OA\Parameter(
     *         name="host",
     *         description="Host name",
     *         required=true,
     *         in="path",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/SSLData")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad request"
     *     )
     * )
     */
    public function show(string $host)
    {
        $response = ['status' => 'error'];

        try {
            @$certificate = \Spatie\SslCertificate\SslCertificate::createForHostName($host);

            $response = [
                'status' => 'ok',
                'issuer' => $certificate->getIssuer(),
                'valid' => $certificate->isValid(),
                'signature_algorithm' => $certificate->getSignatureAlgorithm(),
                'fingerprint' => $certificate->getFingerprint(),
                'additional_domains' => $certificate->getAdditionalDomains(),
                'expired' => $certificate->isExpired(),
                'self_signed' => $certificate->isSelfSigned(),
                'valid_from' => [
                    'date' => $certificate->validFromDate()->toDateTimeString(),
                    'timezone' => $certificate->validFromDate()->tzName,
                ],
                'expiration_date' => [
                    'date' => $certificate->expirationDate()->toDateTimeString(),
                    'timezone' => $certificate->expirationDate()->tzName,
                ],
            ];

            if ($certificate->isExpired()) {
                $response['status'] = 'expired';
            }

            // Include checkSSLRedirect if applicable
            // $response['https_redirect'] = $this->checkSSLRedirect($host);

        } catch (CouldNotDownloadCertificate $e) {
            $response = [
                'status' => 'no certificate',
                'msg' => $e->getMessage()
            ];
        } catch (\Exception $e) {
            $response = [
                'msg' => $e->getMessage()
            ];
        }

        return response()->json($response);
    }

}
