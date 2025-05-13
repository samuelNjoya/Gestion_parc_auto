<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;


class DashboardController extends Controller
{
   public function dashboard(){
      $data['meta_title'] = 'dashboard';
    return view('backend.dashboard', $data);
   }


}
