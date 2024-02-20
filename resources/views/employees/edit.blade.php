@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span class="font-weight-bold">Edit Employee</span>
                    <a href="{{ route('employees.index') }}" class="btn btn-secondary">Back</a>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('employees.update', $employee->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row mt-2">
                            <div class="form-group col-md-6">
                                <label class="font-weight-bold" for="firstname">First Name:</label>
                                <input type="text" class="form-control" id="firstname" name="firstname" value="{{ $employee->firstname }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="font-weight-bold" for="lastname">Last Name:</label>
                                <input type="text" class="form-control" id="lastname" name="lastname" value="{{ $employee->lastname }}">
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="form-group col-md-6">
                                <label class="font-weight-bold" for="date_of_birth">Date of Birth:</label>
                                <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" value="{{ $employee->date_of_birth }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="font-weight-bold" for="education_qualification">Education Qualification:</label>
                                <input type="text" class="form-control" id="education_qualification" name="education_qualification" value="{{ $employee->education_qualification }}">
                            </div>
                        </div>

                        <div class="form-group mt-2">
                            <label class="font-weight-bold" for="address">Address:</label>
                            <textarea class="form-control" id="address" name="address" rows="3">{{ $employee->address }}</textarea>
                        </div>

                        <div class="row mt-2">
                            <div class="form-group col-md-6">
                                <label class="font-weight-bold" for="email">Email:</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ $employee->email }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="font-weight-bold" for="phone">Phone:</label>
                                <input type="tel" class="form-control" id="phone" name="phone" value="{{ $employee->phone }}">
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="form-group col-md-6">
                                <label class="font-weight-bold" for="photo">Photo:</label>
                                <input type="file" class="form-control-file" id="photo" name="photo">
                                @if ($employee->photo)
                                    <img src="{{ asset('storage/' . $employee->photo) }}" alt="Employee Photo" class="mt-2" style="max-width: 100px; max-height: 100px;">
                                @else
                                    <span>No photo available</span>
                                @endif
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label class="font-weight-bold" for="resume">Resume:</label>
                                <input type="file" class="form-control-file" id="resume" name="resume">
                            </div>
                        </div>

                        <div>
                            <button type="submit" class="btn  btn-primary mt-3">Update</button>
                            <a href="{{ route('employees.index') }}" class="btn btn-secondary mt-3">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
