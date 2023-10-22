<?php

namespace App\Http\Controllers;
use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::simplePaginate(10);
        return view('companies.index', compact('companies'));
    }

    public function create()
    {
        return view('companies.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:companies',
            'email' => 'nullable|string|email:rfc,dns',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'website' => 'nullable|regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/',
        ]);
        
        $company = Company::create($request->post());

        if ($request->hasFile('logo')){
            $file_name = $request->file('logo')->hashName();
            $request->file('logo')->move(storage_path('app/public'), $file_name);
            $company->update(['logo' => $file_name]);
        }

        return redirect()->route('companies.index')->with('success','Company has been created successfully.');
    }

    public function edit(Company $company)
    {
        return view('companies.edit',compact('company'));
    }

    public function update(Request $request, Company $company)
    {
        $request->validate([
            'name' => 'required|string|unique:companies',
            'email' => 'nullable|string|email:rfc,dns',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'website' => 'nullable|regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/',
        ]);

        $company->fill($request->post())->save();

        if ($request->hasFile('logo')){
            $file_name = $request->file('logo')->hashName();
            $request->file('logo')->move(storage_path('app/public'), $file_name);
            $company->update(['logo' => $file_name]);
        }

        return redirect()->route('companies.index')->with('success','Company has been updated successfully.');
    }

    public function destroy(Company $company)
    {
        if (Employee::where('company_id', $company->id)->count() != 0){
            return redirect()->route('companies.index')->with('error','There is an employee using said company.');
        }
        $company->delete();
        return redirect()->route('companies.index')->with('success','Company has been deleted successfully.');
    }
}
