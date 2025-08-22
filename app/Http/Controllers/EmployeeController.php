<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\User;

class EmployeeController extends Controller 
{
    
    public function index() {
        $employees = Employee::all();
        return view('employees.index', compact('employees'));
    }

    public function create() {
        return view('employees.create');
    }

    public function store(Request $request) {
        $request->validate([
            'FirstName' => 'required|string|max:100',
            'LastName' => 'required|string|max:100',
            'Position' => 'required|string|max:100',
            'Salary' => 'required|numeric|min:0',
            'Gender' => 'required|in:Male,Female,Other',
            'Birthdate' => 'required|date'
        ]);

        Employee::create($request->all());
        return redirect()->route('employees.index')->with('success', 'Employee added successfully!');
    }

    public function edit($id) {
        $employee = Employee::findOrFail($id);
        return view('employees.edit', compact('employee'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'FirstName' => 'required|string|max:100',
            'LastName' => 'required|string|max:100',
            'Position' => 'required|string|max:100',
            'Salary' => 'required|numeric|min:0',
            'Gender' => 'required|in:Male,Female,Other',
            'Birthdate' => 'required|date'
        ]);

        $employee = Employee::findOrFail($id);
        $employee->update($request->all());
        return redirect()->route('employees.index')->with('success', 'Employee updated successfully!');
    }

    public function destroy($id) {
        $employee = Employee::findOrFail($id);
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully!');
    }

    public function summary()
    {
        $maleCount = Employee::where('Gender', 'Male')->count();
        $femaleCount = Employee::where('Gender', 'Female')->count();
        $averageAge = Employee::avg(\DB::raw('TIMESTAMPDIFF(YEAR, Birthdate, CURDATE())'));
        $totalSalary = Employee::sum('Salary');

        return view('employees.summary', compact('maleCount', 'femaleCount', 'averageAge', 'totalSalary'));
    }

}
