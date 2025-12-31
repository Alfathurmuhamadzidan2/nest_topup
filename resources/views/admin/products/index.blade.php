@extends('layouts.app')

@section('title', 'Kelola Produk')

@section('content')

<div class="max-w-6xl mx-auto text-white space-y-10">

    {{-- HEADER --}}
    <div class="flex justify-between items-center bg-[#111] p-6 rounded-xl border border-gray-800 shadow">
        <h2 class="text-2xl font-bold">Kelola Produk</h2>

        <button id="toggleFormBtn"
            class="px-5 py-2 rounded-lg bg-indigo-600 hover:bg-indigo-500 text-white font-semibold shadow">
            + Tambah Produk
        </button>
    </div>

    {{-- FORM --}}
    <div id="formContainer"
        class="hidden bg-[#0d0d0d] p-6 rounded-xl border border-gray-700 shadow-md space-y-6">

        <h3 id="formTitle" class="text-xl font-semibold text-indigo-400">Tambah Produk</h3>

        <form id="productForm" action="{{ route('admin.products.store') }}" method="POST"
              enctype="multipart/form-data" class="space-y-4">

            @csrf
            <input type="hidden" name="_method" id="formMethod" value="POST">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                {{-- Nama --}}
                <div class="col-span-2">
                    <label class="block font-semibold">Nama Produk</label>
                    <input id="name" type="text" name="name"
                        class="w-full rounded-lg p-3 bg-[#111] border border-gray-700 text-white focus:ring-indigo-500"
                        required>
                </div>

                {{-- Kategori --}}
                <div>
                    <label class="block font-semibold">Kategori</label>
                    <input id="category" type="text" name="category"
                        class="w-full rounded-lg p-3 bg-[#111] border border-gray-700 text-white focus:ring-indigo-500">
                </div>

                {{-- Status --}}
                <div>
                    <label class="block font-semibold">Status Produk</label>
                    <select id="status" name="status"
                        class="w-full rounded-lg p-3 bg-[#111] border border-gray-700 text-white focus:ring-indigo-500"
                        required>
                        <option value="1">Aktif</option>
                        <option value="0">Tidak Aktif</option>
                    </select>
                </div>

            </div>

            {{-- Deskripsi --}}
            <div>
                <label class="block font-semibold">Deskripsi</label>
                <textarea id="description" name="description" rows="4"
                    class="w-full rounded-lg p-3 bg-[#111] border border-gray-700 text-white focus:ring-indigo-500"></textarea>
            </div>

            {{-- Gambar --}}
            <div>
                <label class="block font-semibold">Gambar Produk</label>
                <input id="imageInput" type="file" name="image"
                    class="w-full rounded-lg p-3 bg-[#111] border border-gray-700 text-white">
            </div>

            {{-- Preview --}}
            <img id="previewImage" class="hidden w-32 h-32 rounded border border-gray-700">

            {{-- Tombol --}}
            <div class="flex gap-3 pt-3">
                <button type="submit"
                    class="px-5 py-3 bg-indigo-600 rounded-lg font-semibold hover:bg-indigo-500">
                    Simpan
                </button>

                <button type="button" id="cancelBtn"
                    class="px-5 py-3 bg-red-600 rounded-lg font-semibold hover:bg-red-500">
                    Batal
                </button>
            </div>

        </form>
    </div>

    {{-- TABEL --}}
    <div class="bg-[#111] p-6 rounded-xl border border-gray-800 shadow overflow-x-auto">

        <table class="w-full text-left">
            <thead class="bg-gray-900 text-gray-300">
                <tr>
                    <th class="p-3">Gambar</th>
                    <th class="p-3">Nama</th>
                    <th class="p-3">Kategori</th>
                    <th class="p-3">Status</th>
                    <th class="p-3 text-center">Varian</th>
                    <th class="p-3 text-center">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($products as $product)
                <tr class="border-b border-gray-700 hover:bg-gray-800">

                    {{-- Gambar --}}
                    <td class="p-3">
                        @if ($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}"
                                class="w-14 h-14 object-cover rounded border border-gray-700">
                        @else
                            <div class="w-14 h-14 bg-gray-900 rounded flex items-center justify-center text-gray-400">
                                No Img
                            </div>
                        @endif
                    </td>

                    {{-- Nama --}}
                    <td class="p-3">{{ $product->name }}</td>

                    {{-- Kategori --}}
                    <td class="p-3">{{ $product->category }}</td>

                    {{-- Status --}}
                    <td class="p-3">
                        @if ($product->status == 1)
                            <span class="px-3 py-1 bg-green-600/40 text-green-300 rounded text-xs">Aktif</span>
                        @else
                            <span class="px-3 py-1 bg-red-600/40 text-red-300 rounded text-xs">Tidak Aktif</span>
                        @endif
                    </td>

                    {{-- Varian --}}
                    <td class="p-3 text-center">
                        <a href="{{ route('admin.products.show', $product->id) }}"
                           class="px-3 py-1 bg-indigo-600 hover:bg-indigo-500 rounded text-sm">
                           Varian
                        </a>
                    </td>

                    {{-- Aksi --}}
                    <td class="p-3 flex justify-center gap-3">

                        <button onclick='editProduct(@json($product))'
                            class="px-3 py-1 bg-yellow-600 hover:bg-yellow-500 rounded text-sm">
                            Edit
                        </button>

                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST"
                              onsubmit="return confirm("Yakin ingin menghapus produk ini?")">
                            @csrf @method('DELETE')
                            <button class="px-3 py-1 bg-red-600 hover:bg-red-700 rounded text-sm">
                                Hapus
                            </button>
                        </form>

                    </td>

                </tr>
                @endforeach
            </tbody>

        </table>

    </div>

</div>

{{-- SCRIPT --}}
<script>
const formContainer  = document.getElementById("formContainer");
const toggleFormBtn  = document.getElementById("toggleFormBtn");
const cancelBtn      = document.getElementById("cancelBtn");
const productForm    = document.getElementById("productForm");
const formMethod     = document.getElementById("formMethod");
const formTitle      = document.getElementById("formTitle");

const nameInput      = document.getElementById("name");
const categoryInput  = document.getElementById("category");
const statusInput    = document.getElementById("status");
const descriptionInput = document.getElementById("description");
const imageInput     = document.getElementById("imageInput");
const previewImage   = document.getElementById("previewImage");

toggleFormBtn.addEventListener("click", () => {
    resetForm();
    formContainer.classList.remove("hidden");
    formTitle.textContent = "Tambah Produk";
    productForm.action = "{{ route('admin.products.store') }}";
    formMethod.value = "POST";
});

cancelBtn.addEventListener("click", () => {
    formContainer.classList.add("hidden");
});

imageInput.addEventListener("change", e => {
    const file = e.target.files[0];
    if (file) {
        previewImage.classList.remove("hidden");
        previewImage.src = URL.createObjectURL(file);
    }
});

function resetForm() {
    productForm.reset();
    previewImage.classList.add("hidden");
    previewImage.src = "";
}

function editProduct(product) {
    formContainer.classList.remove("hidden");
    formTitle.textContent = "Edit Produk";

    productForm.action = `/admin/products/${product.id}`;
    formMethod.value = "PUT";

    nameInput.value = product.name;
    categoryInput.value = product.category ?? '';
    descriptionInput.value = product.description ?? '';

    // STATUS INTEGER → 1 atau 0
    statusInput.value = product.status == 1 ? 1 : 0;

    if (product.image) {
        previewImage.classList.remove("hidden");
        previewImage.src = `/storage/${product.image}`;
    } else {
        previewImage.classList.add("hidden");
    }

    window.scrollTo({ top: 0, behavior: "smooth" });
}
</script>

@endsection
