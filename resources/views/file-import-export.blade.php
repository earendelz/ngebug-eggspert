<!DOCTYPE html>
<html>
<head>
    <title>Import & Export File</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        .btn-custom {
            background-color: #E59D2A;
            border-color: #E59D2A;
            color: #fff;
        }

        .btn-custom:hover {
            background-color: #c07c1f;
            border-color: #c07c1f;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2>Import dan Export User Dengan Excel/CSV (Khusus Admin)</h2>
        
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('file.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="file" class="form-label">Pilih File untuk Diimpor</label>
                <input type="file" name="file" class="form-control" id="file" required>
            </div>
            <button class="btn btn-custom">Import File</button>
        </form>

        <hr>

        <form action="{{ route('file.export') }}" method="GET">
            <button class="btn btn-custom">Export File</button>
        </form>
    </div>
</body>
</html>
