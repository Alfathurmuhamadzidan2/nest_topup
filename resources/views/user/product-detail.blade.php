@extends('layouts.app')

@section('title', $product->name)

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    
    {{-- LEFT SIDE: GAMBAR + DESKRIPSI --}}
    <div class="bg-[#0b1220] p-5 rounded-xl shadow-lg">
        <img 
            src="{{ $product->image ? asset('storage/products/'.$product->image) : 'https://via.placeholder.com/600x300?text=No+Image' }}" 
            class="rounded-lg w-full mb-4"
        >

        <h2 class="text-2xl font-semibold text-white mb-2">{{ $product->name }}</h2>
        <p class="text-gray-400">{{ $product->description }}</p>

        <div class="mt-4">
            <span class="text-orange-400 font-bold text-xl">Rp {{ number_format($product->price,0,',','.') }}</span>
        </div>
    </div>



    {{-- MIDDLE: PILIH METODE PEMBAYARAN + INPUT FORM --}}
    <div class="bg-[#0b1220] p-5 rounded-xl shadow-lg">

        {{-- PEMILIHAN METODE BAYAR --}}
        <h3 class="text-lg font-semibold mb-3 text-orange-400">Pilih Metode Pembayaran</h3>

        <div class="space-y-2" id="paymentMethods">

            <label class="flex items-center justify-between px-4 py-3 bg-[#071225] rounded cursor-pointer hover:bg-[#111a33]">
                <div class="text-gray-200">Saldo Akun</div>
                <div>
                    <input type="radio" name="payment" value="saldo" class="paymentRadio">
                </div>
            </label>

            <label class="flex items-center justify-between px-4 py-3 bg-[#071225] rounded cursor-pointer hover:bg-[#111a33]">
                <div class="text-gray-200">Dana</div>
                <div>
                    <input type="radio" name="payment" value="dana" class="paymentRadio">
                </div>
            </label>

            <label class="flex items-center justify-between px-4 py-3 bg-[#071225] rounded cursor-pointer hover:bg-[#111a33]">
                <div class="text-gray-200">Gopay</div>
                <div>
                    <input type="radio" name="payment" value="gopay" class="paymentRadio">
                </div>
            </label>

            <label class="flex items-center justify-between px-4 py-3 bg-[#071225] rounded cursor-pointer hover:bg-[#111a33]">
                <div class="text-gray-200">QRIS</div>
                <div>
                    <input type="radio" name="payment" value="qris" class="paymentRadio">
                </div>
            </label>
        </div>


        {{-- INPUT DETAIL AKUN --}}
        <h3 class="text-lg font-semibold mt-6 mb-2 text-orange-400">Masukkan Detail Akun</h3>

        <div class="space-y-3">
            <input 
                type="text" 
                id="accountId"
                placeholder="User ID / Zone ID"
                class="w-full px-4 py-2 rounded bg-[#071225] border border-gray-700 text-gray-200"
            >

            <input 
                type="text" 
                id="contact"
                placeholder="Email atau Nomor Whatsapp"
                class="w-full px-4 py-2 rounded bg-[#071225] border border-gray-700 text-gray-200"
            >
        </div>

    </div>



    {{-- RIGHT SIDE: SUMMARY --}}
    <div class="bg-[#0b1220] p-5 rounded-xl shadow-lg sticky top-20">
        
        <h3 class="text-lg font-semibold mb-3 text-orange-400">Ringkasan Pembelian</h3>

        <div class="space-y-2">
            <div class="flex justify-between text-gray-300">
                <span>Harga Produk</span>
                <span id="summary_price">Rp {{ number_format($product->price,0,',','.') }}</span>
            </div>

            <div class="flex justify-between text-gray-300">
                <span>Biaya Admin</span>
                <span id="summary_admin">Rp 0</span>
            </div>

            <div class="flex justify-between text-gray-300 font-semibold text-orange-400 text-lg mt-3">
                <span>Total Bayar</span>
                <span id="summary_total">Rp {{ number_format($product->price,0,',','.') }}</span>
            </div>
        </div>

        {{-- BUTTON BELI --}}
        <form method="POST" action="{{ route('transactions.store') }}" class="mt-6">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <input type="hidden" name="payment_method" id="input_payment">
            <input type="hidden" name="account_id" id="input_account">
            <input type="hidden" name="contact" id="input_contact">

            <button 
                type="submit"
                onclick="prepareCheckout()"
                class="w-full py-3 bg-orange-500 hover:bg-orange-400 text-black font-bold rounded-lg mt-4">
                Beli Sekarang
            </button>
        </form>

    </div>

</div>



{{-- JAVASCRIPT: Kalkulasi Dinamis --}}
<script>
    const basePrice = {{ $product->price }};

    function updateSummary(cost) {
        const adminCost = cost;
        document.getElementById('summary_admin').textContent = 
            'Rp ' + adminCost.toLocaleString('id-ID');
        
        const total = basePrice + adminCost;
        document.getElementById('summary_total').textContent = 
            'Rp ' + total.toLocaleString('id-ID');
    }

    // Tarif admin tiap metode
    const admins = {
        saldo: 0,
        dana: 500,
        gopay: 700,
        qris: 350,
    };

    // ketika metode pembayaran dipilih
    document.querySelectorAll('.paymentRadio').forEach(r => {
        r.addEventListener('change', function(){
            updateSummary(admins[this.value]);
        });
    });

    // fungsi sebelum submit form
    function prepareCheckout(){
        document.getElementById('input_payment').value =
            document.querySelector('input[name="payment"]:checked')?.value;

        document.getElementById('input_account').value =
            document.getElementById('accountId').value;

        document.getElementById('input_contact').value =
            document.getElementById('contact').value;
    }
</script>
@endsection
