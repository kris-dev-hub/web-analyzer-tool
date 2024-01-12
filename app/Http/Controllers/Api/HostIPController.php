<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * @OA\Info(
 *     version="0.0.1",
 *     title="Web analyze tool",
 *     description="Tool to analyze webside information",
 *     @OA\Contact(
 *         email="kris@kris.biz.pl"
 *     )
 * )
 *
 * @OA\Server(
 *     description="API Server",
 *     url="http://localhost:8001/api"
 * )
 */


class HostIPController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/hostip/{host}",
     *     operationId="getHostIp",
     *     tags={"HostIP"},
     *     summary="Get IP details for the host",
     *     description="Returns IP info for a specific host",
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
     *         @OA\JsonContent(ref="#/components/schemas/HostIP")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad request"
     *     )
     * )
     */
    public function show(string $host)
    {
        $ips=gethostbynamel($host);
        return response()->json($ips);
    }

}
