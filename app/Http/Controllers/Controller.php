<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
  * @OA\OpenApi(
  *   @OA\Info(
  *     title="Your API Title",
  *     version="1.0.0",
  *     description="API documentation for your Laravel project"
  *   )
  * )
  */



class Controller extends BaseController
{
    
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
