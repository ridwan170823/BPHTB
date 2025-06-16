@extends('layouts.app')

@section('content')
<div class="p-6 max-w-4xl mx-auto bg-white shadow-lg rounded-lg">
    <h1 class="text-2xl font-semibold text-center mb-6">Data Wajib Pajak</h1>

    <form method="POST" action="{{ route('admin.wajib-pajak.store') }}" class="space-y-4">
        @csrf
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <!-- NIK -->
            <div class="mb-4">
                <label for="nik" class="block text-sm font-medium text-gray-700">NIK</label>
                <input type="text" id="nik" name="nik" class="border-gray-300 border rounded-lg p-2 w-full focus:ring-blue-500 focus:border-blue-500" autocomplete="off">
            </div>
            <!-- NPWP -->
            <div class="mb-4">
                <label for="npwp" class="block text-sm font-medium text-gray-700">NPWP</label>
                <input type="text" id="npwp" name="npwp" class="border-gray-300 border rounded-lg p-2 w-full bg-gray-100 cursor-not-allowed" readonly>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <!-- Nama WP -->
            <div class="mb-4">
                <label for="nama" class="block text-sm font-medium text-gray-700">Nama WP</label>
                <input type="text" id="nama" name="nama" class="border-gray-300 border rounded-lg p-2 w-full bg-gray-100 cursor-not-allowed" readonly>
            </div>
            <!-- Alamat -->
            <div class="mb-4">
                <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                <input type="text" id="alamat" name="alamat" class="border-gray-300 border rounded-lg p-2 w-full bg-gray-100 cursor-not-allowed" readonly>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <!-- No Telp -->
            <div class="mb-4">
                <label for="telp" class="block text-sm font-medium text-gray-700">No Telp</label>
                <input type="text" id="telp" name="telp" class="border-gray-300 border rounded-lg p-2 w-full bg-gray-100 cursor-not-allowed" readonly>
            </div>
            <!-- Kelurahan -->
            <div class="mb-4">
                <label for="kelurahan" class="block text-sm font-medium text-gray-700">Kelurahan</label>
                <input type="text" id="kelurahan" name="kelurahan" class="border-gray-300 border rounded-lg p-2 w-full bg-gray-100 cursor-not-allowed" readonly>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <!-- Kecamatan -->
            <div class="mb-4">
                <label for="kecamatan" class="block text-sm font-medium text-gray-700">Kecamatan</label>
                <input type="text" id="kecamatan" name="kecamatan" class="border-gray-300 border rounded-lg p-2 w-full bg-gray-100 cursor-not-allowed" readonly>
            </div>
            <!-- Kab/Kota -->
            <div class="mb-4">
                <label for="kota" class="block text-sm font-medium text-gray-700">Kab/Kota</label>
                <input type="text" id="kota" name="kota" class="border-gray-300 border rounded-lg p-2 w-full bg-gray-100 cursor-not-allowed" readonly>
            </div>
        </div>

        <div class="mb-4">
            <label for="tgl_daf" class="block text-sm font-medium text-gray-700">Tanggal Daftar</label>
            <input type="text" id="tgl_daf" name="tgl_daf" class="border-gray-300 border rounded-lg p-2 w-full bg-gray-100 cursor-not-allowed" readonly>
        </div>

        <div class="border-t pt-6">
           <h1 class="text-2xl font-semibold text-center mb-6">Data Objek Pajak</h1>
          <div class="mb-4">
    <label for="nop" class="block text-sm font-medium text-gray-700">NOP</label>
    <input 
        type="text" 
        id="nop" 
        name="nop" 
        class="border-gray-300 border rounded-lg p-2 w-full"
        placeholder="13.76.010.029.002.0255.0"
        maxlength="27"
    >
</div>
            <div class="mb-4">
                <label for="nama_sppt" class="block text-sm font-medium text-gray-700" >Nama SPPT</label>
                <input type="text" id="nama_sppt" name="nama_sppt" class="border-gray-300 border rounded-lg p-2 w-full bg-gray-100 cursor-not-allowed" placeholder="Nama SPPT" readonly>
            </div>
             <div class="mb-4">
                <label for="letak_op" class="block text-sm font-medium text-gray-700"  >Letak OP</label>
                <input type="text" id="letak_op" name="letak_op" class="border-gray-300 border rounded-lg p-2 w-full bg-gray-100 cursor-not-allowed" placeholder="Lokasi Objek Pajak" readonly>
            </div>
           <div class="grid grid-cols-12 gap-4">
    <div class="col-span-12 sm:col-span-6 mb-6">
        <label for="nomor" class="block text-sm font-medium text-gray-700">Nomor</label>
        <input type="text" id="nomor" name="nomor" class="border-gray-300 border rounded-lg p-2 w-full bg-gray-100 cursor-not-allowed" placeholder="Nomor Objek Pajak" readonly>
    </div>
    <div class="col-span-12 sm:col-span-2 mb-2">
        <label for="rt" class="block text-sm font-medium text-gray-700">RT</label>
        <input type="text" id="rt" name="rt" class="border-gray-300 border rounded-lg p-2 w-full bg-gray-100 cursor-not-allowed" placeholder="RT" readonly>
    </div>
    <div class="col-span-12 sm:col-span-2 mb-2">
        <label for="rt" class="block text-sm font-medium text-gray-700">RW</label>
        <input type="text" id="rt" name="rt" class="border-gray-300 border rounded-lg p-2 w-full bg-gray-100 cursor-not-allowed" placeholder="RW" readonly>
    </div>
</div>
  <div class="mb-4">
                <label for="kelurahan_op" class="block text-sm font-medium text-gray-700" >Kelurahan</label>
                <input type="text" id="kelurahan_op" name="kelurahan_op" class="border-gray-300 border rounded-lg p-2 w-full bg-gray-100 cursor-not-allowed" placeholder="Kelurahan Objek Pajak" readonly>
            </div>
              <div class="mb-4">
                <label for="Kecamatan_op" class="block text-sm font-medium text-gray-700"  >Kecamatan</label>
                <input type="text" id="Kecamatan_op" name="Kecamatan_op" class="border-gray-300 border rounded-lg p-2 w-full bg-gray-100 cursor-not-allowed" placeholder="Kecamatan Objek Pajak" readonly>
            </div>
              <div class="mb-4">
                <label for="njop_bumi" class="block text-sm font-medium text-gray-700"  >NJOP Bumi</label>
                <input type="text" id="njop_bumi" name="njop_bumi" class="border-gray-300 border rounded-lg p-2 w-full bg-gray-100 cursor-not-allowed" placeholder="NJOP Bumi" readonly>
            </div>
              <div class="mb-4">
                <label for="njop_bangunan" class="block text-sm font-medium text-gray-700"  >NJOP Bangunan</label>
                <input type="text" id="njop_bangunan" name="njop_bangunan" class="border-gray-300 border rounded-lg p-2 w-full bg-gray-100 cursor-not-allowed" placeholder="NJOP Bangunan" readonly>
            </div>
              <div class="mb-4">
                <label for="luas_bumi" class="block text-sm font-medium text-gray-700"  >Luas Bumi</label>
                <input type="text" id="luas_bumi" name="luas_bumi" class="border-gray-300 border rounded-lg p-2 w-full bg-gray-100 cursor-not-allowed" placeholder="Luas Bumi" readonly>
            </div>
              <div class="mb-4">
                <label for="luas_bangunan" class="block text-sm font-medium text-gray-700"  >Luas Bangunan</label>
                <input type="text" id="luas_bangunan" name="luas_bangunan" class="border-gray-300 border rounded-lg p-2 w-full bg-gray-100 cursor-not-allowed" placeholder="Luas Bangunan" readonly>
            </div>
        </div>

        {{-- === FORM 3 === --}}
        <div class="border-t pt-6">
            <h1 class="text-2xl font-semibold text-center mb-6">Data Transaksi</h1>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="mb-4">
                    <label for="field_d" class="block text-sm font-medium text-gray-700">Field D</label>
                    <input type="text" id="field_d" name="field_d" class="border-gray-300 border rounded-lg p-2 w-full">
                </div>
                <div class="mb-4">
                    <label for="field_e" class="block text-sm font-medium text-gray-700">Field E</label>
                    <input type="text" id="field_e" name="field_e" class="border-gray-300 border rounded-lg p-2 w-full">
                </div>
            </div>
            <div class="mb-4">
                <label for="field_f" class="block text-sm font-medium text-gray-700">Field F</label>
                <input type="text" id="field_f" name="field_f" class="border-gray-300 border rounded-lg p-2 w-full">
            </div>
        </div>

        <button type="submit" class="w-full py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-300">Simpan</button>
    </form>
</div>
@endsection
@section('styles')
<style>
    .ui-autocomplete {
        max-height: 200px;
        overflow-y: auto;
        z-index: 10500 !important;
        background-color: white;
        border: 1px solid #d1d5db;
        border-radius: 0.5rem;
        box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
        font-size: 0.875rem;
        padding: 0.25rem 0;
    }

    .ui-menu-item-wrapper {
        padding: 0.5rem 1rem;
        color: #374151;
        cursor: pointer;
        transition: background-color 0.2s;
    }

    .ui-menu-item-wrapper:hover,
    .ui-state-active {
        background-color: #e0f2fe !important;
        color: #1d4ed8 !important;
    }

    .ui-autocomplete::-webkit-scrollbar {
        width: 6px;
    }

    .ui-autocomplete::-webkit-scrollbar-thumb {
        background-color: #94a3b8;
        border-radius: 3px;
    }
</style>
@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        $('#nik').autocomplete({
            source: function (request, response) {
                $.ajax({
                    url: '/api/nik-autocomplete',
                    data: { term: request.term },
                    success: function (data) {
                        response(data);
                    }
                });
            },
            minLength: 4,
            select: function (event, ui) {
                $('#nik').val(ui.item.value);
                $.get('/api/wajibpajak-detail', { nik: ui.item.value }, function (data) {
                    $('#npwp').val(data.npwp ?? '');
                    $('#nama').val(data.nama ?? '');
                    $('#alamat').val(data.alamat ?? '');
                    $('#telp').val(data.telp ?? '');
                    $('#kelurahan').val(data.kelurahan ?? '');
                    $('#kecamatan').val(data.kecamatan ?? '');
                    $('#kota').val(data.kota ?? '');
                    $('#tgl_daf').val(data.tgl_daf ?? '');
                });
                return false;
            }
        });
    });
</script>
<script>
document.getElementById('nop').addEventListener('input', function (e) {
    let value = e.target.value.replace(/\D/g, ''); // hanya angka
    let formatted = '';
    const pattern = [2, 2, 3, 3, 3, 4, 1]; // pola NOP
    let i = 0;

    for (const len of pattern) {
        if (value.length > i) {
            formatted += value.substr(i, len);
            if (i + len < value.length) formatted += '.';
        }
        i += len;
    }

    e.target.value = formatted;
});
</script>
@endsection
