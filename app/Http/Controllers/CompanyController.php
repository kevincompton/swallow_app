<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;

class CompanyController extends Controller
{
    
    public function linkCompany(Request $request, $companyID)
    {
      $user = Auth::user();
      $company = \App\Company::find($user->company_id);

      DB::table('dispensaries_edibles')->insert(
        ['dispensary_id' => $companyID, 'edible_id' => $company->id]
      );

      return back();

    }

    public function unlinkCompany($companyID)
    {
      $user = Auth::user();

      DB::table('dispensaries_edibles')->where($user->company_id, $companyID)->delete();

      return back();
    }
}
