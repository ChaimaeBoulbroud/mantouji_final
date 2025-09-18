<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/jammiyaInformation.css') }}">
    <title>Document</title>
</head>
<body>
<div class="container">
    <h2>Update Your Company Information</h2>

    @if ($information)
        <form action="{{ route('updateInfo') }}" method="post">
            @csrf
            @method('PUT')

            <div>
                <label for="description">Description</label>
                <textarea name="description" id="description">{{ old('description', $information->description) }}</textarea>
            </div>

            <div>
                <label for="contuct">Contact</label>
                <textarea name="contuct" id="contuct">{{ old('contuct', $information->contact) }}</textarea>
            </div>

            <button type="submit">Update Information</button>
        </form>
    @else
        <form action="{{ route('insertInfoJaam') }}" method="post">
            @csrf

            <div>
                <label for="description">Description</label>
                <textarea name="description" id="description">{{ old('description') }}</textarea>
            </div>

            <div>
                <label for="contuct">Contact</label>
                <textarea name="contuct" id="contuct">{{ old('contuct') }}</textarea>
            </div>

            <button type="submit">Confirmer Information</button>
        </form>
    @endif
</div>


    
</body>
</html>