<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use App\Models\Category;
use App\Models\CompanyProfile;
use App\Models\Companyprofilebrandlogo;
use App\Models\Companyprofileaddresslocation;
use App\Models\Companyofficeaddress;
use App\Models\Companyprofilecustomerandclient;
use App\Models\Companyproductandservice;
use App\Models\Companylocation;
use App\Models\Company;
use App\Models\Certification;
use App\Models\CompanyType;
use App\Models\Countrie;
use App\Models\City;
use App\Models\CompanyPrimaryContact;
use App\Models\Currency;
use App\Models\Industry;
use App\Models\State;
use App\Models\NDA;
use App\Models\ProfilePositions;
use App\Models\TypeOfOffering;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CompanyProfileController extends Controller
{

  public function __construct()
  {
    $this->middleware('auth:web');
  }

  public function profileView()
  {
    $user_id = Auth::guard('web')->user()->id;
    $companyProfile = Company::where('user_id', $user_id)->first();
    Log::info('$companyProfile' . $companyProfile);
    return view('Admin.company-profile.profile-view', compact('companyProfile'));
  }






  // public function index(){
  // $user_id = Auth::guard('web')->user()->id;
  // $company = Company::where('user_id',$user_id)->first();
  // $ompanyProfile = CompanyProfile::where('user_id', $user_id)->first();
  // $companyRegAddress = Companylocation::where('user_id', $user_id)->where('address', '!=', null)->get();
  // $companyProductService = Companyproductandservice::where('user_id', $user_id)->where('user_id', '!=', null)->get();
  // $brandWebsitesLogo  = Companyprofilebrandlogo::where('user_id', $user_id)->get();
  // $companyCustomerClient  = Companyprofilecustomerandclient::where('user_id', $user_id)->get();
  // $category = Category::where('parent_id',0)->get();
  // $countries = Countrie::all();
  // $ndas = NDA::limit(5)->get();
  // $typesOfCompany = CompanyType::all();
  // return view('Admin.company-profile.company-index',compact('category','countries','ndas','typesOfCompany','company','ompanyProfile','brandWebsitesLogo','companyCustomerClient','companyRegAddress','companyProductService'));
  // }

  public function index()
  {
    $user_id = Auth::guard('web')->user()->id;
    $company = Company::where('user_id', $user_id)->first();
    $ompanyProfile = CompanyProfile::where('user_id', $user_id)->first();
    $companyCertification = Certification::select('id', 'certification')->get();
    $companyIndustry = Industry::select('id', 'industry')->get();
    $companyProfilePositions = ProfilePositions::select('id', 'profile_position')->get();
    $companyTypes = TypeOfOffering::select('id', 'type_of_offering')->get();
    $companyCurrency = Currency::select('id', 'name', 'symbol', 'code')->get();
    // dd($ompanyProfile->toArray());

    if ($ompanyProfile) {
      $companyRegAddress = Companylocation::where('user_id', $user_id)->where('address', '!=', null)->get();
      foreach ($companyRegAddress as $key => $item) {
        if (is_numeric($item['company_location_country_id'])) {
          $countryNames = Countrie::where('id', $item['company_location_country_id'])->select('name', 'id')->get();
          $companyRegAddress[$key]['company_location_country'] = $countryNames[0]['name'];
        }

        if (is_numeric($item['company_location_state_id'])) {
          $stateNames = State::where('id', $item['company_location_state_id'])->select('name', 'id')->get();
          $companyRegAddress[$key]['company_location_state'] = $stateNames[0]['name'];
        }
        if (is_numeric($item['company_location_city_id'])) {
          $cityNames = City::where('id', $item['company_location_city_id'])->select('name', 'id')->get();
          $companyRegAddress[$key]['company_location_city'] = $cityNames[0]['name'];
        }
      }

      $companyProductService = Companyproductandservice::with('typeofoffering', 'categories', 'subcategories', 'countries')->where('user_id', $user_id)->where('user_id', '!=', null)->get();

      $brandWebsitesLogo  = Companyprofilebrandlogo::where('user_id', $user_id)->get();
      $companyCustomerClient  = Companyprofilecustomerandclient::where('user_id', $user_id)->get();
      $category = Category::where('parent_id', 0)->get();
      // foreach ($category as $key => $category_id) {
      //   $subcategory_data[] = Category::where('parent_id', $category_id['id'])->get();
      // }

      // $subcategory = $subcategory_data[0];

      $subcategory = Category::where('parent_id', '!=', 0)->get();
      $countries = Countrie::all();

      $ndas = NDA::limit(5)->get();
      $typesOfCompany = CompanyType::all();
    } else {
      $ompanyProfile = [];
      $companyRegAddress = [];
      $companyProductService = [];
      $brandWebsitesLogo = [];
      $companyCustomerClient = [];
      $category = Category::where('parent_id', 0)->get();
      $countries = Countrie::all();
      $ndas = NDA::limit(5)->get();
      $typesOfCompany = CompanyType::all();
      $subcategory = Category::where('parent_id', '!=', 0)->get();
    }
    return view('Admin.company-profile.company-index', compact('companyCurrency', 'companyTypes', 'companyProfilePositions', 'companyIndustry', 'companyCertification', 'subcategory', 'category', 'countries', 'ndas', 'typesOfCompany', 'company', 'ompanyProfile', 'brandWebsitesLogo', 'companyCustomerClient', 'companyRegAddress', 'companyProductService'));
  }

  public function getSubcategory(Request $request)
  {
    $data = [
      "status" => false
    ];
    // if (isset($request->country) && isset($request->state)) {
    $selected_category = $request->category;
    $selected_sub_category = $request->sub_category;

    $subcategory = Category::where('parent_id', $request->category)->get();


    $html = view('Admin.search-set-subcategory', compact('subcategory', 'selected_sub_category'))->render();
    $data = [
      "status" => true,
      "subcategory" => [
        "status" => true,
        'selected_subcategory' => $selected_sub_category,
        "html" => $html
      ]
    ];
    // }
    return response()->json($data);
  }




  public function companyProfileSelectSubCategory(Request $request)
  {
    $return = Category::where('parent_id', $request->category)->get();
    $html = view('Admin.company-select-sub-category', compact('return'))->render();
    echo  $html;
  }



  public function companyProfileStore(Request $request)
  {

    $user_id = auth('web')->id();
    $company = Company::where('user_id', $user_id)->first();
    $company_id = $company->id;

    $company->company_name = $request->new_company_name;
    $company->company_type = $request->type_of_company;

    $company->save();

    $companyProfile = CompanyProfile::where('company_id', $company_id)->first() ?? new CompanyProfile;

    $companyProfile->type_of_company = $request->type_of_company;
    $companyProfile->certificate = $request->certificate;
    $companyProfile->company_category_id = $request->company_category_id;
    $companyProfile->company_sub_category_id = $request->company_subcategory_id;
    $companyProfile->industry = $request->industry;
    // $companyProfile->save();


    $files = [];
    if ($request->hasfile('brand_logo')) {
      foreach ($request->file('brand_logo') as $key => $file) {
        $name = time() . rand(1, 100) . '.' . $file->extension();
        Storage::putFileAs('public/brandlogo', $file, $name);
        $files[$key] = $name;
      }
    }

    if (!empty($files)) {
      foreach ($files as $key => $filename) {
        $companyProfileBrandLogo = new Companyprofilebrandlogo();

        $companyProfileBrandLogo->brand_logo = 'storage/brandlogo/' . $filename; // Save the relative path in the database
        $companyProfileBrandLogo->user_id = $user_id;
        $companyProfileBrandLogo->company_id = $company_id;
        $companyProfileBrandLogo->brand_name = $request->brand_name[$key];
        $companyProfileBrandLogo->brand_website = $request->brand_website[$key];

        $companyProfileBrandLogo->save();
      }
    }

    // Reg. Address Office Address of location
    foreach ($request->reg_office_address as $key => $typeslocations) {
      $companyLocation = new Companylocation();

      $companyLocation->user_id = $user_id;
      $companyLocation->company_id = $company_id;
      $companyLocation->address = $request->reg_office_address[$key];
      $companyLocation->company_location_country_id = $request->company_location_country_id[$key];
      $companyLocation->company_location_state_id = $request->company_location_state_id[$key];
      $companyLocation->company_location_city_id = $request->company_city_id[$key];
      $companyLocation->zipcode = $request->company_zipcode[$key];

      $companyLocation->save();
    }

    foreach ($request->primary_name as $key => $primary) {
        $companyPrimaryInfo = new CompanyPrimaryContact();

        $companyPrimaryInfo->user_id = $user_id;
        $companyPrimaryInfo->company_id = $company_id;
        $companyPrimaryInfo->designation = $request->purpose[$key];
        $companyPrimaryInfo->name = $request->primary_name[$key];
        $companyPrimaryInfo->email = $request->primary_email[$key];
        $companyPrimaryInfo->country_id = $request->phonecode[$key];
        $companyPrimaryInfo->contact_no = $request->contact_number[$key];

        $companyPrimaryInfo->save();
      }



    // 4. Product And Service

    foreach ($request->type_of_offering as $key => $typeOffering) {

      $companyProductService =  new Companyproductandservice();

      $companyProductService->user_id = $user_id;
      $companyProductService->company_id = $company_id;
      $companyProductService->type_of_offering = $request->type_of_offering[$key];
      $companyProductService->product_category = $request->product_category[$key];
      $companyProductService->product_sub_category = $request->product_sub_category[$key];
      $companyProductService->product_name = $request->product_name[$key];
      $companyProductService->product_currently_export = $request->product_currently_export[$key];
      if ($companyProductService->type_of_offering == 'product') {
        $companyProductService->product_annual = $request->product_annual[$key];
      }
      if ($companyProductService->product_currently_export == 'yes') {
        $companyProductService->product_country = $request->product_country[$key];
      }
      // $companyProductService->product_state = $request->product_state[$key];
      // $companyProductService->product_city = $request->product_city[$key];
      $companyProductService->product_description = $request->product_description[$key];
      $fileNames = [];
      $files = $request->file('product_images-' . $key);

      if ($files) {
        foreach ($files as $key => $file) {
          if ($file->isValid()) {
            $file->store('public/product_images');
            $fileNames[] = 'storage/product_images/' . $file->hashName();
          }
        }
      }

      $companyProductService->product_images = implode(",", $fileNames);
      if ($companyProductService->product_sub_category != '') {
        $companyProductService->save();
      }
    }

    // prodcut and service
    if ($request->hasFile('add_company_brochure')) {
      if ($companyProfile->add_company_brochure) {
        $filePath = str_replace('storage/', 'public/', $companyProfile->add_company_brochure);
        if (Storage::exists($filePath))
          Storage::delete($filePath);
      }
      $request->file('add_company_brochure')->store('public/CompanyBrochure');
      $companyProfile->add_company_brochure = 'storage/CompanyBrochure/' . $request->file('add_company_brochure')->hashName();
    }

    // product and service
    if ($request->hasFile('add_product_catalog')) {
      if ($companyProfile->add_product_catalog) {
        $filePath = str_replace('storage/', 'public/', $companyProfile->add_product_catalog);
        if (Storage::exists($filePath))
          Storage::delete($filePath);
      }
      $request->file('add_product_catalog')->store('public/companybrochure');
      $companyProfile->add_product_catalog = 'storage/companybrochure/' . $request->file('add_product_catalog')->hashName();
    }

    if ($request->hasFile('company_logo')) {
      if ($companyProfile->company_logo) {
        $filePath = str_replace('storage/', 'public/', $companyProfile->company_logo);
        if (Storage::exists($filePath))
          Storage::delete($filePath);
      }
      $request->file('company_logo')->store('public/company-logo');
      $companyProfile->company_logo = 'storage/company-logo/' . $request->file('company_logo')->hashName();
    }

    if ($request->hasFile('Organisational_image')) {
      if ($companyProfile->Organisational_image) {
        $filePath = str_replace('storage/', 'public/', $companyProfile->Organisational_image);
        if (Storage::exists($filePath))
          Storage::delete($filePath);
      }
      $request->file('Organisational_image')->store('public/OrganisationalImage');
      $companyProfile->Organisational_image = 'storage/OrganisationalImage/' . $request->file('Organisational_image')->hashName();
    }

    if ($request->hasFile('link_to_annual_report2')) {
      if ($companyProfile->link_to_annual_report2) {
        $filePath = str_replace('storage/', 'public/', $companyProfile->link_to_annual_report2);
        if (Storage::exists($filePath))
          Storage::delete($filePath);
      }
      $request->file('link_to_annual_report2')->store('public/annual-reports');
      $companyProfile->link_to_annual_report2 = 'storage/annual-reports/' . $request->file('link_to_annual_report2')->hashName();
    }



    // company profile
    $companyProfile->type_of_company = $request->type_of_company;
    $companyProfile->certificate = implode(",", $request->certificate ?? []);
    // $companyProfile->company_category_id = $request->company_category_id;
    // $companyProfile->company_sub_category_id = $request->company_subcategory_id;
    $companyProfile->industry = $request->industry;
    // $companyProfile->brand_name = $request->brand_name;
    $companyProfile->started_in = $request->started_in;
    $companyProfile->number_of_employee = $request->number_of_employee;
    $companyProfile->about_company = $request->about_company;
    $companyProfile->type_of_offering = $request->company_offering;
    // $companyProfile->company_logo = $copanyProfile_image_catalog;   // for temp

    // ------ company location    [ geographical presense]
    $companyProfile->country_id = $request->country_id;
    //company location
    $companyProfile->company_location_country_id = $request->geo_country_name;
    $companyProfile->company_location_state_id = $request->location_state_id;
    $companyProfile->company_location_city_id = $request->location_city_id;


    //   organisational structre //
    $companyProfile->profile_positions = $request->profile_positions;
    $companyProfile->organisational_structre_name = $request->organisational_structre_name;
    $companyProfile->organisational_structre_email = $request->organisational_structre_email;
    // $companyProfile->Organisational_image = $OrganisationalImageData; // for temp

    // product and service //
    // $companyProfile->add_product_catalog = $addproductcatalog;  // temp off
    // $companyProfile->add_company_brochure = $companyBrocher;   // temp off

    // useful information  [Primary Contact Information]
    $companyProfile->purpose = $request->purpose;
    $companyProfile->useful_information_name = $request->name;
    $companyProfile->useful_information_email = $request->useful_information_email;
    $companyProfile->contact_number = $request->contact_number;

    // [Mailing Address]
    if ($request->different_mailing == 'yes') {
      $companyProfile->usfl_info_address = $request->mailing_address;
      $companyProfile->usfl_info_country_id = $request->mailing_country_id;
      $companyProfile->usfl_info_state_id = $request->mailing_state_id;
      $companyProfile->usfl_info_city_id = $request->mailing_city_id;
      $companyProfile->usfl_info_zipcode = $request->mailing_zipcode;
    } else {
      $companyProfile->usfl_info_address = null;
      $companyProfile->usfl_info_country_id = null;
      $companyProfile->usfl_info_state_id = null;
      $companyProfile->usfl_info_city_id = null;
      $companyProfile->usfl_info_zipcode = null;
    }

    // Useful Information [ Company Financial]
    $companyProfile->currency_year = $request->currency_year;
    $companyProfile->currency_type = $request->currency_type;
    $companyProfile->annual_revenue = $request->annual_revenue;
    $companyProfile->link_to_annual_report = $request->link_to_annual_report;
    // $companyProfile->link_to_annual_report2 = $annual_reports_Image;   // temp off
    //  Useful Links
    $companyProfile->website = $request->website;
    $companyProfile->linkedIn = $request->linkedIn;
    $companyProfile->facebook = $request->facebook;
    $companyProfile->instagram = $request->instagram;
    $companyProfile->twitter = $request->twitter;
    $companyProfile->youtube = $request->youtube;

    $companyProfile->user_id = $user_id;

    $companyProfile->company_id = $company_id;
    //  dd( $companyProfile);
    $companyProfile->save();
    Log::info('all values save');

    // Customers/Client
    $copanyProfile = new Companyprofilecustomerandclient();

    $files = [];
    if ($request->hasfile('client_company_logo')) {

      foreach ($request->file('client_company_logo') as $key => $file) {
        $name = time() . rand(1, 100) . '.' . $file->extension();
        $file->storeAs('public/client_company_logo', $name);
        $files[$key] = $name;
      }
    }

    if (!empty($files)) {
      foreach ($files as $key => $filename) {
        $copanyProfile = new Companyprofilecustomerandclient();
        $copanyProfile->client_company_logo = 'storage/client_company_logo/' . $filename;
        $copanyProfile->user_id = $user_id;
        $copanyProfile->company_id = $company_id;
        $copanyProfile->client_company_name = $request->client_company_name[$key];
        $copanyProfile->client_product_or_service = $request->client_product_or_service[$key];
        $copanyProfile->client_website_link = $request->client_website_link[$key];
        $copanyProfile->client_review_link = $request->client_review_link[$key];
        $copanyProfile->save();
      }
    }

    return redirect()->route('admin.company.profile')->with('success', 'company profile store successfully !');
  }

  public function brandLog(Request $rquest, $id)
  {
    $del_logo = CompanyProfile::find($id);
    $del_logo->company_logo = 'null';
    $del_logo->save();
    return redirect()->route('admin.company.profile')->with('success', 'company profile store successfully !');
  }


  public function delelteProduct($id)
  {
    $delproduct = Companyproductandservice::find($id);
    $delproduct->delete();
    $values = [
      'success' => true,
      'message' => 'Deleted successfully .',
      'data' => $delproduct,
    ];
    $response = $values;
    return response()->json($response, 200);
  }

  public function delelteCompanyProfileBrandLogo($id)
  {
    Log::info('delelteCompanyProfileBrandLogo' . $id);
    $delbrnadLogo = Companyprofilebrandlogo::find($id);
    $delbrnadLogo->delete();
    $values = [
      'success' => true,
      'message' => 'Deleted successfully .',
      'data' => $delbrnadLogo,
    ];
    $response = $values;
    return response()->json($response, 200);
  }

  public function delelteCompanyLogo($id)
  {
    $delbrnadLogo = CompanyProfile::find($id);
    $delbrnadLogo->company_logo = 'NUll';
    $delbrnadLogo->update();
    $values = [
      'success' => true,
      'message' => 'Deleted successfully .',
      'data' => $delbrnadLogo,
    ];
    $response = $values;
    return response()->json($response, 200);
  }

  public function delelteCompanyLocation($id)
  {
    $delcompanyLocation = Companylocation::find($id);
    $delcompanyLocation->delete();
    $values = [
      'success' => true,
      'message' => 'Deleted successfully .',
      'data' => $delcompanyLocation,
    ];
    $response = $values;
    return response()->json($response, 200);
  }

  public function delelteOrganisationalStructer($id)
  {
    Log::info('hit on fuction delelteOrganisationalStructer' . $id);
    $delorganisaltionals = CompanyProfile::find($id);
    $delorganisaltionals->Organisational_image = 'NUll';
    $delorganisaltionals->update();
    $values = [
      'success' => true,
      'message' => 'Deleted successfully .',
      'data' => $delorganisaltionals,
    ];
    $response = $values;
    return response()->json($response, 200);
  }

  public function delelteProductCatelog($id)
  {
    Log::info('hit on fuction delelteProductCatelog' . $id);
    $delorganproductCatlog = CompanyProfile::find($id);
    $delorganproductCatlog->add_product_catalog = 'NULL';
    $delorganproductCatlog->update();
    $values = [
      'success' => true,
      'message' => 'Deleted successfully .',
      'data' => $delorganproductCatlog,
    ];
    $response = $values;
    return response()->json($response, 200);
  }
  public function delelteCompanyBrochure($id)
  {
    $delorcompanyBrochure = CompanyProfile::find($id);
    $delorcompanyBrochure->add_company_brochure = 'NULL';
    $delorcompanyBrochure->update();
    $values = [
      'success' => true,
      'message' => 'Deleted successfully .',
      'data' => $delorcompanyBrochure,
    ];
    $response = $values;
    return response()->json($response, 200);
  }



  public function delelteCustomerClient($id)
  {
    $delcustomerClient = Companyprofilecustomerandclient::find($id);
    $delcustomerClient->delete();
    $values = [
      'success' => true,
      'message' => 'Deleted successfully .',
      'data' => $delcustomerClient,
    ];
    $response = $values;
    return response()->json($response, 200);
  }



  public function delelteCompanyFinancialImage($id)
  {
    Log::info('hit on fuction delelteCompanyFinancialImage' . $id);
    $delorfinancialImage = CompanyProfile::find($id);
    $delorfinancialImage->link_to_annual_report2 = 'NULL';
    $delorfinancialImage->update();
    $values = [
      'success' => true,
      'message' => 'Deleted successfully .',
      'data' => $delorfinancialImage,
    ];
    $response = $values;
    return response()->json($response, 200);
  }
}
