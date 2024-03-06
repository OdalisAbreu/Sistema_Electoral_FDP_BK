<!DOCTYPE html>
<html>

<head>
    <title>Subir Archivo Excel</title>
</head>

<body>

    @if(session('success'))
    <div>{{ session('success') }}</div>
    @endif

    <form action="{{ route('subir.archivo') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="archivo">
        <button type="submit">Subir Archivo</button>
    </form>

</body>

</html>