<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Company</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-2">
        <div class="row">
            <div class="col-12 mb-2 d-flex justify-content-between align-items-center">
                <div class="me-3"><h2>Edit Company</h2></div>
                <a class="btn btn-primary" href="{{ route('companies.index') }}">Back</a>
            </div>
        </div>
        @if(session('status'))
        <div class="alert alert-success mb-1 mt-1">
            {{ session('status') }}
        </div>
        @endif
        <form action="{{ route('companies.update',$company->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <strong>Name:</strong>
                        <input type="text" name="name" class="form-control" placeholder="Name" value="{{ $company->name }}">
                        @error('name')
                        <div class="alert alert-danger mx-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <strong>Email:</strong>
                        <input type="email" name="email" class="form-control" placeholder="Email" value="{{ $company->email }}">
                        @error('email')
                        <div class="alert alert-danger mx-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <strong>Logo:</strong>
                        <input type="file" name="logo" class="form-control">
                        @error('logo')
                        <div class="alert alert-danger mx-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <strong>Website:</strong>
                        <input type="text" name="website" class="form-control" placeholder="Website" value="{{ $company->website }}">
                        @error('website')
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