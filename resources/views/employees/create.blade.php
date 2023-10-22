<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Employee</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-2">
        <div class="row">
            <div class="col-12 mb-2 d-flex justify-content-between align-items-center">
                <div class="me-3"><h2>Create Employee</h2></div>
                <a class="btn btn-primary" href="{{ route('employees.index') }}">Back</a>
            </div>
        </div>
        @if(session('status'))
        <div class="alert alert-success mb-1 mt-1">
            {{ session('status') }}
        </div>
        @endif
        <form action="{{ route('employees.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <strong>First Name:</strong>
                        <input type="text" name="first_name" class="form-control" placeholder="First Name">
                        @error('first_name')
                        <div class="alert alert-danger mx-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <strong>Last Name:</strong>
                        <input type="text" name="last_name" class="form-control" placeholder="Last Name">
                        @error('last_name')
                        <div class="alert alert-danger mx-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <strong>Company:</strong>
                        <select name="company_id" class="form-select">
                            <option value="0">Select Company</option>
                            @foreach ($companies as $company)
                            <option value="{{$company->id}}">{{$company->name}}</option>
                            @endforeach
                        </select>
                        @error('company_id')
                        <div class="alert alert-danger mx-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <strong>Email:</strong>
                        <input type="email" name="email" class="form-control" placeholder="Email">
                        @error('email')
                        <div class="alert alert-danger mx-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <strong>Phone Number:</strong>
                        <input type="text" name="phone_number" class="form-control" placeholder="Phone Number">
                        @error('phone_number')
                        <div class="alert alert-danger mx-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary ml-3">Submit</button>
                </div>
            </div>
        </form>
    </div>
</body>

</html>