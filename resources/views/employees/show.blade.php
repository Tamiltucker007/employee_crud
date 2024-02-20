@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span class="font-weight-bold">Employee Details</span>
                        <a href="{{ route('employees.index') }}" class="btn btn-secondary">Back</a>
                    </div>
                    <div class="card-body">

                        @if ($employee->photo)
                            <img src="{{ asset('storage/' . $employee->photo) }}" alt="Employee Photo"
                                style="max-width: 200px;">
                        @endif

                        <p><strong>First Name:</strong> {{ $employee->firstname }}</p>
                        <p><strong>Last Name:</strong> {{ $employee->lastname }}</p>
                        <p><strong>Date of Birth:</strong> {{ $employee->date_of_birth }}</p>
                        <p><strong>Education Qualification:</strong> {{ $employee->education_qualification }}</p>
                        <p><strong>Address:</strong> {{ $employee->address }}</p>
                        <p><strong>Email:</strong> {{ $employee->email }}</p>
                        <p><strong>Phone:</strong> {{ $employee->phone }}</p>

                        @if ($employee->resume)
                            <p>Resume: <a href="{{ asset('storage/' . $employee->resume) }}" target="_blank">View Resume</a>
                            </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
