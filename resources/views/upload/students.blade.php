@extends('layouts.upload')

@section('title', 'Upload JSON File')

@section('content')
    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.students_upload') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="file">Upload JSON File:</label>
        <input type="file" name="file" id="file" accept=".json">
        <button type="submit">Upload</button>
    </form>
@endsection
