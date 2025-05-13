<!DOCTYPE html>
<html>
<head>
    <title>Upload File</title>
</head>
<body>
    <h1>Upload a File</h1>

    @if(session('success'))
        <p style="color: green">{{ session('success') }}</p>
    @endif

    <form action="/upload" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="document" required>
        <button type="submit">Upload</button>
    </form>
</body>
</html>
