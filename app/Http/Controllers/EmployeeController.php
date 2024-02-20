<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        if($search) {
            // search query
            $employees = Employee::where('firstname', 'LIKE', "%$search%")
                ->orWhere('lastname', 'LIKE', "%$search%")
                ->orWhere('email', 'LIKE', "%$search%")
                ->orWhere('education_qualification', 'LIKE', "%$search%")
                ->orWhere('phone', 'LIKE', "%$search%")
                ->paginate(5);
        } else {
            $employees = Employee::paginate(5); 
        }
       
        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        return view('employees.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'date_of_birth' => 'required|date',
            'education_qualification' => 'required|string',
            'address' => 'required|string',
            'email' => 'required|email|unique:employees',
            'phone' => 'required|string|numeric|digits:10',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'resume' => 'nullable|mimes:pdf', 
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        // Handle file uploads
        $photoPath = null;
        $resumePath = null; 
    
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos', 'public');
        }
    
        if ($request->hasFile('resume')) {
            $resumePath = $request->file('resume')->store('resumes', 'public');
        }
    
        // Create new employee record
        Employee::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'date_of_birth' => $request->date_of_birth,
            'education_qualification' => $request->education_qualification,
            'address' => $request->address,
            'email' => $request->email,
            'phone' => $request->phone,
            'photo' => $photoPath,
            'resume' => $resumePath,
        ]);

        return redirect()->route('employees.index')->with('success', 'Employee created successfully.');
    }

    public function show(string $id)
    {
        $employee = Employee::findOrFail($id);

        return view('employees.show', compact('employee'));
    }

    public function edit(string $id)
    {
        $employee = Employee::findOrFail($id);

        return view('employees.edit', compact('employee'));
    }

    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'date_of_birth' => 'required|date',
            'education_qualification' => 'required|string',
            'address' => 'required|string',
            'email' => 'required|email|unique:employees,email,'.$id,
            'phone' => 'required|string|numeric|digits:10',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'resume' => 'nullable|mimes:pdf',   
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $employee = Employee::findOrFail($id);

        // Handle file uploads
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos', 'public');
            $employee->photo = $photoPath;
        }

        if ($request->hasFile('resume')) {
            $resumePath = $request->file('resume')->store('resumes', 'public');
            $employee->resume = $resumePath;
        }

        // Update employee record
        $employee->update($request->only(['firstname', 'lastname', 'date_of_birth', 'education_qualification', 'address', 'email', 'phone']));

        return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
    }

    public function destroy(string $id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();

        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
    }
}
