@extends('layouts.app')

@section('content')

    <div class="container">

        <h3 align="center" class="mt-5">Employee Management</h3>

        <div class="row">
            <div class="col-md-2">
            </div>
            <div class="col-md-8">

            <div class="form-area">
                <form method="POST" action="{{ route('employee.update', $employee->id) }}">
                    @csrf
                    @method('PATCH')
                    <div class="row">
                        <div class="col-md-6">
                            <label class="label-custom">Employee Name</label>
                            <input type="text" class="form-control" name="emp_name" value="{{ $employee->emp_name }}">
                        </div>
                        <div class="col-md-6">
                            <label class="label-custom">Employee DOB</label>
                            <input type="date" class="form-control" name="dob" value="{{ $employee->dob }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label class="label-custom">Phone</label>
                            <input type="text" class="form-control" name="phone" value="{{ $employee->phone }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mt-3">
                            <input type="submit" class="btn btn-info" value="Update">
                        </div>
                    </div>
                </form>
            </div>

            </div>
        </div>
    </div>

@endsection

@push('css')
    <style>
        .form-area {
            padding: 20px;
            margin-top: 20px;
            background-color: rgba(255, 255, 255, 0.8);
            background-image: url('https://images.unsplash.com/photo-1542744095-fcf48d80b0fd?fit=crop&w=750&q=80');
            background-size: cover;
            background-position: center;
            border-radius: 10px;
            color: #333;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            position: relative; /* Required for overlay */
        }

        .form-area::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5); /* Dark overlay */
            z-index: 1; /* Make sure overlay is above the background image */
            border-radius: 10px;
        }

        .form-area > * {
            position: relative; /* Ensure content appears above the overlay */
            z-index: 2;
        }

        .form-control {
            background-color: rgba(255, 255, 255, 0.7);
            border: none;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            color: #000000; /* Change this to the desired text color */
        }

        .btn-info {
            background-color: #28a745;
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .bi-trash-fill {
            color: red;
            font-size: 18px;
        }

        .bi-pencil {
            color: green;
            font-size: 18px;
            margin-left: 20px;
        }

        .label-custom {
            color: #ffffff; /* Change this to the desired text color */
            font-weight: bold; /* Optional: Make the label text bold */
        }
    </style>
@endpush
