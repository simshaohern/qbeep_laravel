<?php

namespace App\Http\Controllers;
use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::simplePaginate(10);
        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        $companies = Company::all();
        return view('employees.create', compact('companies'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'company_id' => 'required|string',
            'email' => 'nullable|string|email:rfc,dns',
            'phone_number' => [
                'nullable',
                'regex:/(0[1-7,9][0-9]{8})|(011[0-9]{8})|(08[0-9]{7})/',
            ],
        ]);
        
        Employee::create($request->post());

        return redirect()->route('employees.index')->with('success','Employee has been created successfully.');
    }

    public function edit(Employee $employee)
    {
        $companies = Company::all();
        return view('employees.edit',compact(['employee', 'companies']));
    }

    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'company_id' => 'required|string',
            'email' => 'nullable|string|email:rfc,dns',
            'phone_number' => [
                'nullable',
                'regex:/(0[1-7,9][0-9]{8})|(011[0-9]{8})|(08[0-9]{7})/',
            ],
        ]);
        
        $employee->fill($request->post())->save();

        return redirect()->route('employees.index')->with('success','Employee has been updated successfully');
    }

    public function destroy(employee $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index')->with('success','Employee has been deleted successfully');
    }
}
