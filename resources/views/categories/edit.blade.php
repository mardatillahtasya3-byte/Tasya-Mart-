
@extends('layouts.app')

@section('content')
<style>
.category-form{max-width:700px;margin:auto;padding:30px 20px;font-family:Arial,sans-serif;color:#263746}
.category-form h1{color:#34465a}
.card{padding:25px;border:1px solid #dce4ec;border-radius:12px;background:#fff}
.group{display:flex;flex-direction:column;gap:8px;margin-bottom:20px}
label{font-size:13px;font-weight:bold}
input{width:100%;box-sizing:border-box;padding:12px;border:1px solid #cbd5e1;border-radius:8px}
.btn{display:inline-block;padding:11px 15px;border:0;border-radius:7px;background:#455a70;color:#fff;text-decoration:none;font-weight:bold;cursor:pointer}
.btn-light{background:#e2e8f0;color:#334155}
.alert{padding:12px;background:#fef2f2;border:1px solid #fecaca;border-radius:8px;color:#991b1b;margin-bottom:15px}
.field-error{color:#b91c1c;font-size:12px}
</style>

<div class="category-form">
    <h1>Edit Kategori</h1>
    <p>Perbarui nama kategori.</p>

    @if ($errors->any())
        <div class="alert">
            <strong>Periksa kembali data:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <form action="{{ route('categories.update', $category) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="group">
                <label for="name">Nama Kategori</label>
                <input id="name" name="name" type="text"
                       value="{{ old('name', $category->name) }}"
                       maxlength="100" required>

                @error('name')
                    <span class="field-error">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn">Simpan Perubahan</button>
            <a href="{{ route('categories.index') }}" class="btn btn-light">Kembali</a>
        </form>
    </div>
</div>
@endsection
