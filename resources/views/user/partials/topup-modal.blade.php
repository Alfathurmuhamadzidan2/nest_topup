<div id="topupModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex justify-center items-center">
    <div class="bg-white rounded-xl shadow-lg w-full max-w-md p-6 relative">
        <h2 class="text-xl font-semibold mb-4 text-center text-indigo-700">Konfirmasi Topup</h2>

        <form method="POST" action="{{ route('transactions.store') }}">
            @csrf
            <input type="hidden" name="product_id" id="product_id">

            <div class="mb-3">
                <label class="text-sm font-medium">Nama Produk</label>
                <input id="product_name" type="text" class="w-full border rounded px-3 py-2" readonly>
            </div>

            <div class="mb-3">
                <label class="text-sm font-medium">Harga</label>
                <input id="product_price" type="text" class="w-full border rounded px-3 py-2" readonly>
            </div>

            <div class="mb-3">
                <label class="text-sm font-medium">ID Akun / Username Game</label>
                <input type="text" name="account_id" class="w-full border rounded px-3 py-2" placeholder="Masukkan ID Game Anda" required>
            </div>

            <div class="flex justify-end space-x-2 mt-4">
                <button type="button" onclick="closeTopupModal()" class="bg-gray-300 px-4 py-2 rounded">Batal</button>
                <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">Lanjutkan</button>
            </div>
        </form>

        <button onclick="closeTopupModal()" class="absolute top-3 right-3 text-gray-500 hover:text-gray-700">✕</button>
    </div>
</div>

<script>
function openTopupModal(id, name, price) {
    document.getElementById('topupModal').classList.remove('hidden');
    document.getElementById('product_id').value = id;
    document.getElementById('product_name').value = name;
    document.getElementById('product_price').value = 'Rp ' + Number(price).toLocaleString('id-ID');
}

function closeTopupModal() {
    document.getElementById('topupModal').classList.add('hidden');
}
</script>
