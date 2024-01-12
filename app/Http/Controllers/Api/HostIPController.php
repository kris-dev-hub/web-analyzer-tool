<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HostIPController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show(string $host)
    {
        $ips=gethostbynamel($host);
        return response()->json($ips);
    }

}
