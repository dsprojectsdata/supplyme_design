<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\City;
use App\Models\State;
use Illuminate\Http\Request;

class CompanyAjaxController extends Controller
{
    public function getSubcategories(Request $request)
    {
        $categoryId = $request->input('categoryId');

        $subcategories = Category::where('parent_id', $categoryId)->get();
        return response()->json($subcategories);
    }

    public function getState(Request $request)
    {
        $country_id = $request->input('country_id');

        $state = State::select('name', 'id')->where('country_id', $country_id)->get();
        return response()->json($state);
    }

    public function getCity(Request $request)
    {
        $state_id = $request->input('state_id');

        $city = City::select('name', 'id')->where('state_id', $state_id)->get();
        return response()->json($city);
    }
}
