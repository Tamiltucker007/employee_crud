@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-3">
        <h1>Employee List</h1>
        <div class="col-md-4">
            <a href="{{ route('employees.create') }}" class="btn btn-sm btn-primary">Add Employee</a>
        </div>
        <div class="col-md-2">
            <a href="{{ route('export-employees') }}" class="btn btn-outline-success">Export Employees</a>
        </div>
        <div class="col-md-6 text-right">
            <form action="{{ route('employees.index') }}" method="GET" class="form-inline">
                <div class="input-group">
                    <input type="text" class="form-control" name="search" placeholder="Search...">
                    <div class="input-group-append">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                        <button class="btn btn-outline-secondary" type="button" onclick="resetForm()">Reset</button>
                    </div>
                </div>
            </form>
        </div>        
    </div>
    @if(session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <table class="table table-striped ">
        <thead>
            <tr>
                <th>Image</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Date of Birth</th>
                <th> Qualification</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if($employees)
                @foreach ($employees as $employee)
                    <tr>
                        <td>
                            @if($employee->photo)
                                <img src="{{ asset('storage/' . $employee->photo) }}" alt="Employee Photo" style="max-width: 50px; max-height: 50px;">
                            @endif
                        </td>                        
                        <td>{{ $employee->firstname }}</td>
                        <td>{{ $employee->lastname }}</td>
                        <td>{{ $employee->date_of_birth }}</td>
                        <td>{{ $employee->education_qualification }}</td>
                        <td>{{ $employee->email }}</td>
                        <td>{{ $employee->phone }}</td>
                        <td>
                            <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-sm btn-info">Edit</a>
                            <a href="{{ route('employees.show', $employee->id) }}" class="btn btn-sm btn-success">Show</a>
                            <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this employee?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    <div class="mt-3">
         {{ $employees->links() }}
    </div>
</div>
@endsection

@push('scripts')
    <script>
        function resetForm() {
            document.querySelector("form").reset();
            // Remove the search query parameter from the URL
            history.replaceState({}, document.title, window.location.pathname);

            window.location.reload();

            return false;
        }
    </script>
@endpush
