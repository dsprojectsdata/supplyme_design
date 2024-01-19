<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyProfileRequest;
use App\Models\AnnualRevenue;
use App\Models\Category;
use App\Models\Certification;
use App\Models\Company;
use App\Models\Companylocation;
use App\Models\Companyproductandservice;
use App\Models\CompanyProfile;
use App\Models\Companyprofilebrandlogo;
use App\Models\Companyprofilecustomerandclient;
use App\Models\CompanyType;
use App\Models\Countrie;
use App\Models\City;
use App\Models\State;
use App\Models\Currency;
use App\Models\Industry;
use App\Models\NumberOfEmployees;
use App\Models\ProfilePositions;
use App\Models\TypeOfOffering;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CompanyEditController extends Controller
{
    // Company Profile
    public function editProfile($id)
    {
        try {
            $company = Company::with('companyprofile')->findOrFail($id);
            $companyBrandLogos = $company->companyprofilebrandlogos()->get();
            $companyProfile = $company->companyprofile;

            $companyTypes = CompanyType::all();
            $certifications = Certification::all();
            $categories = Category::where('parent_id', 0)->get();
            $industries = Industry::all();
            $numberOfEmployees = NumberOfEmployees::all();

            return view('SuperAdmin.company-edit.profile', compact(
                'company',
                'companyProfile',
                'companyTypes',
                'certifications',
                'categories',
                'industries',
                'companyBrandLogos',
                'numberOfEmployees'
            ));
        } catch (\Exception $exception) {
            return back()->with('error', 'An error occurred: ' . $exception->getMessage());
        }
    }
    public function updateProfile(Request $request)
    {
        try {
            DB::beginTransaction();
            $company_id = $request->input('company_id');
            $company = Company::findOrFail($company_id);

            $company->company_name = $request->company_name;
            $company->company_type = $request->type_of_company;
            $company->save();
            if ($request->hasFile('brand_logo')) {
                foreach ($request->file('brand_logo') as $key => $file) {
                    $name = time() . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    Storage::putFileAs('public/brandlogo', $file, $name);
                    $uploadedLogos[] = [
                        'brand_logo' => 'storage/brandlogo/' . $name,
                        'user_id' => $company->user_id,
                        'company_id' => $company_id,
                        'brand_name' => $request->brand_name[$key],
                        'brand_website' => $request->brand_website[$key],
                    ];
                }
                Companyprofilebrandlogo::insert($uploadedLogos);
            }

            $companyProfile = $company->companyprofile ?? new CompanyProfile();

            if ($request->hasFile('company_logo')) {
                if ($companyProfile->company_logo) {
                    $filePath = str_replace('storage/', 'public/', $companyProfile->company_logo);
                    if (Storage::exists($filePath))
                        Storage::delete($filePath);
                }
                $request->file('company_logo')->store('public/company-logo');
                $companyProfile->company_logo = 'storage/company-logo/' . $request->file('company_logo')->hashName();
            }


            $companyProfile->type_of_company = implode(",", $request->type_of_company ?? []);
            $companyProfile->certificate = implode(",", $request->certificate ?? []);
            $companyProfile->company_category_id = $request->company_category_id;
            $companyProfile->company_sub_category_id = $request->company_sub_category_id;
            $companyProfile->industry = $request->industry;

            $companyProfile->started_in = $request->started_in;
            $companyProfile->number_of_employee = $request->number_of_employee;
            $companyProfile->about_company = $request->about_company;

            $company->companyprofile()->save($companyProfile);

            DB::commit();

            return back()->with('success', 'Company Profile Update Successfully');
            // return redirect()->route('company.show', [$company_id])->with('success', 'Company Profile Update Successfully');
        } catch (\Exception $exception) {
            DB::rollBack();
            return back()->with('error', 'An error occurred: ' . $exception->getMessage())->withInput();
        }
    }
    // Company Location

    public function editLocation($id)
    {
        try {
            $company = Company::with('companyprofile')->findOrFail($id);
            $companyProfile = $company->companyprofile;
            $user_id = $companyProfile->user_id;
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

            $category = Category::where('parent_id', 0)->get();

            $subcategory = Category::where('parent_id', '!=', 0)->get();
            $countries = Countrie::all();

            //  $ndas = NDA::limit(5)->get();
            $typesOfCompany = CompanyType::all();

            $profile_positions = ProfilePositions::all();

            return view('SuperAdmin.company-edit.location', compact(
                'company',
                'companyProfile',
                'profile_positions',
                'countries',
                'companyRegAddress',
                'typesOfCompany',
                'subcategory',
                'category'
            ));
        } catch (\Exception $exception) {
            return back()->with('error', 'An error occurred: ' . $exception->getMessage());
        }
    }

    public function updateLocation(Request $request)
    {
        try {
            DB::beginTransaction();
            $company_id = $request->input('company_id');
            $company = Company::findOrFail($company_id);

            $companyProfile = $company->companyprofile ?? new CompanyProfile();

            $companyLocations = [];

            foreach ($request->reg_office_address as $key => $typeslocations) {
                $companyLocations[] = [
                    'user_id' => $companyProfile->user_id,
                    'company_id' => $company_id,
                    'address' => $request->reg_office_address[$key],
                    'company_location_country_id' => $request->company_location_country_id[$key],
                    'company_location_state_id' => $request->company_location_state_id[$key],
                    'company_location_city_id' => $request->company_city_id[$key],
                    'zipcode' => $request->company_zipcode[$key],
                ];
            }

            Companylocation::insert($companyLocations);

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
            //company location   
            $companyProfile->company_location_country_id = $request->geo_country_name;
            $companyProfile->company_location_state_id = $request->location_state_id;
            $companyProfile->company_location_city_id = $request->location_city_id;

            $company->companyprofile()->save($companyProfile);

            DB::commit();

            return back()->with('success', 'Company Location Update Successfully');
        } catch (\Exception $exception) {
            DB::rollBack();
            return back()->with('error', 'An error occurred: ' . $exception->getMessage())->withInput();
        }
    }


    // Company Structure
    public function editStructure($id)
    {
        try {
            $company = Company::with('companyprofile')->findOrFail($id);
            $companyProfile = $company->companyprofile;

            $profile_positions = ProfilePositions::all();

            return view('SuperAdmin.company-edit.structure', compact(
                'company',
                'companyProfile',
                'profile_positions',
            ));
        } catch (\Exception $exception) {
            return back()->with('error', 'An error occurred: ' . $exception->getMessage());
        }
    }

    public function updateStructure(Request $request)
    {
        try {
            DB::beginTransaction();
            $company_id = $request->input('company_id');
            $company = Company::findOrFail($company_id);

            $companyProfile = $company->companyprofile ?? new CompanyProfile();

            if ($request->hasFile('Organisational_image')) {
                if ($companyProfile->Organisational_image) {
                    $filePath = str_replace('storage/', 'public/', $companyProfile->Organisational_image);
                    if (Storage::exists($filePath))
                        Storage::delete($filePath);
                }
                $request->file('Organisational_image')->store('public/OrganisationalImage');
                $companyProfile->Organisational_image = 'storage/OrganisationalImage/' . $request->file('Organisational_image')->hashName();
            }

            $companyProfile->profile_positions = $request->profile_positions;
            $companyProfile->organisational_structre_name = $request->organisational_structre_name;
            $companyProfile->organisational_structre_email = $request->organisational_structre_email;

            $company->companyprofile()->save($companyProfile);

            DB::commit();

            return back()->with('success', 'Company Organization Structure Update Successfully');
        } catch (\Exception $exception) {
            DB::rollBack();
            return back()->with('error', 'An error occurred: ' . $exception->getMessage())->withInput();
        }
    }

    // Company Product and Service
    public function editProducts($id)
    {
        try {
            $company = Company::with('companyproductandservicesWithRelationships')->findOrFail($id);

            $companyProductService = $company->companyproductandservicesWithRelationships;

            $typeOfOfferings = TypeOfOffering::all();
            $categories = Category::where('parent_id', 0)->get();
            $countries = Countrie::all();

            return view('SuperAdmin.company-edit.product-service', compact(
                'company',
                'typeOfOfferings',
                'categories',
                'countries',
                'companyProductService',
            ));
        } catch (\Exception $exception) {
            return back()->with('error', 'An error occurred: ' . $exception->getMessage());
        }
    }

    public function updateProducts(Request $request)
    {
        try {
            DB::beginTransaction();
            $company_id = $request->input('company_id');
            $company = Company::findOrFail($company_id);

            foreach ($request->product_name as $key => $product) {
                if ($request->type_of_offering[$key] == 'product') {
                    $product_annual = $request->product_annual[$key];
                } else {
                    $product_annual = null;
                }

                if ($request->product_currently_export[$key] == 'yes') {
                    $product_country = $request->product_country[$key];
                } else {
                    $product_country = null;
                }

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

                $products[] = [
                    'user_id' => $company->user_id,
                    'company_id' => $company_id,
                    'type_of_offering' => $request->type_of_offering[$key],
                    'product_category' => $request->product_category[$key],
                    'product_sub_category' => $request->product_sub_category[$key],
                    'product_name' => $request->product_name[$key],
                    'product_annual' => $product_annual,
                    'product_currently_export' => $request->product_currently_export[$key],
                    'product_country' => $product_country,
                    'product_description' => $request->product_description[$key],
                    'product_images' => implode(",", $fileNames),
                ];
            }
            Companyproductandservice::insert($products);

            DB::commit();

            return back()->with('success', 'Company Product and service Added Successfully');
        } catch (\Exception $exception) {
            DB::rollBack();
            return back()->with('error', 'An error occurred: ' . $exception->getMessage())->withInput();
        }
    }

    // Company Clients and Customers
    public function editCustomers($id)
    {
        try {
            $company = Company::with('companyprofilecustomerandclients')->findOrFail($id);

            $companyCustomerClient = $company->companyprofilecustomerandclients;

            return view('SuperAdmin.company-edit.customer', compact(
                'company',
                'companyCustomerClient',
            ));
        } catch (\Exception $exception) {
            return back()->with('error', 'An error occurred: ' . $exception->getMessage());
        }
    }

    public function updateCustomers(Request $request)
    {
        try {
            DB::beginTransaction();
            $company_id = $request->input('company_id');
            $company = Company::findOrFail($company_id);

            if ($request->hasFile('client_company_logo')) {
                foreach ($request->file('client_company_logo') as $key => $file) {
                    $name = time() . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    Storage::putFileAs('public/client_company_logo', $file, $name);
                    $companyClients[] = [
                        'user_id' => $company->user_id,
                        'company_id' => $company_id,
                        'client_company_logo' => 'storage/client_company_logo/' . $name,
                        'client_company_name' => $request->client_company_name[$key],
                        'client_product_or_service' => $request->client_product_or_service[$key],
                        'client_website_link' => $request->client_website_link[$key],
                        'client_review_link' => $request->client_review_link[$key],
                    ];
                }
                Companyprofilecustomerandclient::insert($companyClients);
            }

            DB::commit();

            return back()->with('success', 'Company Clients Added Successfully');
        } catch (\Exception $exception) {
            DB::rollBack();
            return back()->with('error', 'An error occurred: ' . $exception->getMessage())->withInput();
        }
    }

    // Company Information
    public function editInformation($id)
    {
        try {
            $company = Company::with('companyprofile')->findOrFail($id);
            $companyProfile = $company->companyprofile;

            $currencies = Currency::all();
            $annual_revenues = AnnualRevenue::all();

            return view('SuperAdmin.company-edit.information', compact(
                'company',
                'companyProfile',
                'annual_revenues',
                'currencies'
            ));
        } catch (\Exception $exception) {
            return back()->with('error', 'An error occurred: ' . $exception->getMessage());
        }
    }

    public function updateInformation(Request $request)
    {
        try {
            DB::beginTransaction();
            $company_id = $request->input('company_id');
            $company = Company::findOrFail($company_id);

            $companyProfile = $company->companyprofile ?? new CompanyProfile();

            if ($request->hasFile('link_to_annual_report2')) {
                if ($companyProfile->link_to_annual_report2) {
                    $filePath = str_replace('storage/', 'public/', $companyProfile->link_to_annual_report2);
                    if (Storage::exists($filePath))
                        Storage::delete($filePath);
                }
                $request->file('link_to_annual_report2')->store('public/annual-reports');
                $companyProfile->link_to_annual_report2 = 'storage/annual-reports/' . $request->file('link_to_annual_report2')->hashName();
            }

            $companyProfile->currency_year = $request->currency_year;
            $companyProfile->currency_type = $request->currency_type;
            $companyProfile->annual_revenue = $request->annual_revenue;
            $companyProfile->link_to_annual_report = $request->link_to_annual_report;

            $company->companyprofile()->save($companyProfile);

            DB::commit();

            return back()->with('success', 'Company Information Update Successfully');
        } catch (\Exception $exception) {
            DB::rollBack();
            return back()->with('error', 'An error occurred: ' . $exception->getMessage())->withInput();
        }
    }

    // Company Social Links
    public function editLinks($id)
    {
        try {
            $company = Company::with('companyprofile')->findOrFail($id);
            $companyProfile = $company->companyprofile;

            return view('SuperAdmin.company-edit.links', compact(
                'company',
                'companyProfile',
            ));
        } catch (\Exception $exception) {
            return back()->with('error', 'An error occurred: ' . $exception->getMessage());
        }
    }
    public function updateLinks(Request $request)
    {
        try {
            $company_id = $request->input('company_id');

            $company = Company::with('companyprofile')->findOrFail($company_id);
            $companyProfile = $company->companyprofile;

            $companyProfile->website = $request->input('website');
            $companyProfile->linkedIn = $request->input('linkedIn');
            $companyProfile->facebook = $request->input('facebook');
            $companyProfile->instagram = $request->input('instagram');
            $companyProfile->twitter = $request->input('twitter');
            $companyProfile->youtube = $request->input('youtube');

            $companyProfile->save();


            return back()->with('success', 'Company Links Update Successfully');
        } catch (\Exception $exception) {
            return back()->with('error', 'An error occurred: ' . $exception->getMessage())->withInput();
        }
    }
}
