@extends('layouts.app')

@section('content')
<form method="POST" enctype="multipart/form-data" action="{{ isset($isEdit) && $isEdit ? route('products.update', $product->id) : route('products.store') }}">
    @csrf
    @if(isset($isEdit) && $isEdit)
        @method('PUT')
    @endif
<div class="mb-3">
    <label for="image" class="form-label">Gambar Produk</label>
    <input type="file" name="image" id="image" class="form-control" accept="image/*">
</div>
    <div class="mb-3">
        <label for="name" class="form-label">Nama Produk</label>
        <input type="text" name="name" id="name" class="form-control"
            value="{{ old('name', $product->name ?? '') }}" required>
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Deskripsi</label>
        <textarea name="description" id="description" class="form-control" rows="3" required>{{ old('description', $product->description ?? '') }}</textarea>
    </div>

    <div class="mb-3">
        <label for="price" class="form-label">Harga</label>
        <input type="number" name="price" id="price" class="form-control"
            value="{{ old('price', $product->price ?? '') }}" required>
    </div>

    <div class="mb-3">
        <label for="category_id" class="form-label">Kategori</label>
        <select name="category_id" id="category_id" class="form-select" required>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}"
                    {{ old('category_id', $product->category_id ?? '') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <button type="button" class="btn btn-sm btn-outline-info" id="toggleNewCategory">
            + Tambahkan Kategori Baru
        </button>

        <div id="newCategoryContainer" class="mt-2 d-none">
            <input type="text" name="new_category" id="new_category" class="form-control mb-2"
                placeholder="Nama kategori baru">
            <small class="text-muted">Kategori ini akan otomatis digunakan jika diisi.</small>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">
        {{ isset($isEdit) && $isEdit ? 'Simpan Perubahan' : 'Tambah Produk' }}
    </button>
</form>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const toggleBtn = document.getElementById('toggleNewCategory');
        const inputContainer = document.getElementById('newCategoryContainer');

        if (toggleBtn && inputContainer) {
            toggleBtn.addEventListener('click', () => {
                inputContainer.classList.toggle('d-none');
            });
        }
    });
</script>
@endsection
