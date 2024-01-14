<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class DNSController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/hostip/{domain}",
     *     operationId="getWhois",
     *     tags={"Whois"},
     *     summary="Get Whois details for the domain",
     *     description="Returns Whois info for a specific domain",
     *     @OA\Parameter(
     *         name="domain",
     *         description="Domain name",
     *         required=true,
     *         in="path",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/Whois")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad request"
     *     )
     * )
     */
    public function show(string $domain)
    {
        $check=array('A'=>DNS_A,'CNAME'=>DNS_CNAME,'MX'=>DNS_MX,'NS'=>DNS_NS);
        $out=array();
        foreach($check as $kind=>$kindid)
        {
            $tmp = @dns_get_record($domain, $kindid);
            if(is_array($tmp) && count($tmp)>0) $out[$kind]=$tmp;
        }
        if(count($out)>0) {
            $out['lastChecked']=date("Y-m-d H:i:s");
        }
        return response()->json($out);
    }

}
