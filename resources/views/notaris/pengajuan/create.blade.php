@extends('layouts.app')

@section('content')
<div class="p-6 max-w-4xl mx-auto bg-white shadow-lg rounded-lg">
    <h1 class="text-2xl font-semibold text-center mb-6">Data Wajib Pajak</h1>
    @if ($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        <strong>Terjadi kesalahan:</strong>
        <ul class="list-disc pl-5 mt-2">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <form method="POST" action="{{ route('notaris.pengajuan.store') }}" enctype="multipart/form-data" class="space-y-4">
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
                <input type="text" id="npwp" name="npwp" class="border-gray-300 border rounded-lg p-2 w-full">
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <!-- Nama WP -->
            <div class="mb-4">
                <label for="nama" class="block text-sm font-medium text-gray-700">Nama WP</label>
                <input type="text" id="nama" name="nama" class="border-gray-300 border rounded-lg p-2 w-full" >
            </div>
            <!-- Alamat -->
            <div class="mb-4">
                <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                <input type="text" id="alamat" name="alamat" class="border-gray-300 border rounded-lg p-2 w-full" >
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <!-- No Telp -->
            <div class="mb-4">
                <label for="telp" class="block text-sm font-medium text-gray-700">No Telp</label>
                <input type="text" id="telp" name="telp" class="border-gray-300 border rounded-lg p-2 w-full" >
            </div>
            <!-- Kelurahan -->
            <div class="mb-4">
                <label for="kelurahan" class="block text-sm font-medium text-gray-700">Kelurahan</label>
                <input type="text" id="kelurahan" name="kelurahan" class="border-gray-300 border rounded-lg p-2 w-full"y>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <!-- Kecamatan -->
            <div class="mb-4">
                <label for="kecamatan" class="block text-sm font-medium text-gray-700">Kecamatan</label>
                <input type="text" id="kecamatan" name="kecamatan" class="border-gray-300 border rounded-lg p-2 w-full">
            </div>
            <!-- Kab/Kota -->
            <div class="mb-4">
                <label for="kota" class="block text-sm font-medium text-gray-700">Kab/Kota</label>
                <input type="text" id="kota" name="kota" class="border-gray-300 border rounded-lg p-2 w-full">
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <div class="mb-4">
            <label for="kd_jns" class="block text-sm font-medium text-gray-700">Jenis Wajib Pajak</label>
    <select id="kd_jns" name="kd_jns" class="border-gray-300 border rounded-lg p-2 w-full">
        <option value="">Pilih Jenis Wajib Pajak</option>
        @foreach ($jenisTransaksis as $jenis)
            <option value="{{ $jenis->kd_jns }}">{{ $jenis->label }}</option>
        @endforeach
    </select>
</div>
            <div class="mb-4">
                <label for="tgl_daf" class="block text-sm font-medium text-gray-700">Tanggal Daftar</label>
            <input type="text" id="tgl_daf" name="tgl_daf" class="border-gray-300 border rounded-lg p-2 w-full">
            </div>
        </div>
        <div class="mb-4">
   
</div>
        <div class="border-t pt-6">
           <h1 class="text-2xl font-semibold text-center mb-6">Data Objek Pajak</h1>


    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <div class="mb-4">
    <label for="nop" class="block text-sm font-medium text-gray-700">NOP</label>
    <input 
        type="text" 
        id="nop" 
        name="nop" 
        class="border-gray-300 border rounded-lg p-2 w-full"
        autocomplete="off"
        placeholder="13.76.010.029.002.0255.0"
        maxlength="27">
</div>
            <div class="mb-4">
                <label for="nama_sppt" class="block text-sm font-medium text-gray-700" >Nama SPPT</label>
                <input type="text" id="nama_sppt" name="nama_sppt" class="border-gray-300 border rounded-lg p-2 w-full bg-gray-100 cursor-not-allowed" placeholder="Nama SPPT" readonly>
            </div>
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
        <label for="rw" class="block text-sm font-medium text-gray-700">RW</label>
        <input type="text" id="rw" name="rw" class="border-gray-300 border rounded-lg p-2 w-full bg-gray-100 cursor-not-allowed" placeholder="RW" readonly>
    </div>
</div>
<div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
  <div class="mb-4">
                <label for="kelurahan_op" class="block text-sm font-medium text-gray-700" >Kelurahan</label>
                <input type="text" id="kelurahan_op" name="kelurahan_op" class="border-gray-300 border rounded-lg p-2 w-full bg-gray-100 cursor-not-allowed" placeholder="Kelurahan Objek Pajak" readonly>
            </div>
              <div class="mb-4">
                <label for="Kecamatan_op" class="block text-sm font-medium text-gray-700"  >Kecamatan</label>
                <input type="text" id="Kecamatan_op" name="Kecamatan_op" class="border-gray-300 border rounded-lg p-2 w-full bg-gray-100 cursor-not-allowed" placeholder="Kecamatan Objek Pajak" readonly>
            </div>
</div>
<div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
              <div class="mb-4">
                <label for="njop_bumi" class="block text-sm font-medium text-gray-700"  >NJOP Bumi</label>
                <input type="text" id="njop_bumi" name="njop_bumi" class="border-gray-300 border rounded-lg p-2 w-full bg-gray-100 cursor-not-allowed" placeholder="NJOP Bumi" readonly>
            </div>
              <div class="mb-4">
                <label for="njop_bangunan" class="block text-sm font-medium text-gray-700"  >NJOP Bangunan</label>
                <input type="text" id="njop_bangunan" name="njop_bangunan" class="border-gray-300 border rounded-lg p-2 w-full bg-gray-100 cursor-not-allowed" placeholder="NJOP Bangunan" readonly>
            </div>
</div>
<div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
              <div class="mb-4">
                <label for="luas_bumi" class="block text-sm font-medium text-gray-700"  >Luas Bumi</label>
                <input type="text" id="luas_bumi" name="luas_bumi" class="border-gray-300 border rounded-lg p-2 w-full bg-gray-100 cursor-not-allowed" placeholder="Luas Bumi" readonly>
            </div>
              <div class="mb-4">
                <label for="luas_bangunan" class="block text-sm font-medium text-gray-700"  >Luas Bangunan</label>
                <input type="text" id="luas_bangunan" name="luas_bangunan" class="border-gray-300 border rounded-lg p-2 w-full bg-gray-100 cursor-not-allowed" placeholder="Luas Bangunan" readonly>
            </div>
        </div>
</div>

        <div class="border-t pt-6">
    <h1 class="text-2xl font-semibold text-center mb-6">Data Transaksi</h1>
<div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
    {{-- PPAT --}}
<div class="mb-4">
    <label for="id_ppat" class="block text-sm font-medium text-gray-700">PPAT</label>
    <select id="id_ppat" name="id_ppat" class="border-gray-300 border rounded-lg p-2 w-full" disabled>
        @foreach($ppats as $ppat)
            <option value="{{ $ppat->id }}" {{ $selectedPpatId == $ppat->id ? 'selected' : '' }}>
                {{ $ppat->nama_ppat }}
            </option>
        @endforeach
    </select>
    <input type="hidden" name="id_ppat" value="{{ $selectedPpatId }}"> {{-- agar tetap tersubmit --}}
</div>

    {{-- Jenis Transaksi --}}
    <div class="mb-4">
        <label for="id_transaksi" class="block text-sm font-medium text-gray-700">Jenis Transaksi</label>
        <select id="id_transaksi" name="id_transaksi" class="border-gray-300 border rounded-lg p-2 w-full">
            @foreach($transaksis as $trx)
                <option value="{{ $trx->id }}">{{ $trx->nm_transaksi }}</option>
            @endforeach
        </select>
    </div>
</div>

    {{-- Jenis Kepemilikan --}}
   <div class="grid grid-cols-12 gap-4">
    <div class="col-span-12 sm:col-span-5 mb-7">
        <label for="kode_p" class="block text-sm font-medium text-gray-700">Jenis Kepemilikan</label>
        <select id="kode_p" name="kode_p" class="border-gray-300 border rounded-lg p-2 w-full">
            @foreach($kepemilikans as $kp)
                <option value="{{ $kp->kd_keg_usaha }}">{{ $kp->nm_keg_usaha }}</option>
            @endforeach
        </select>
    </div>


    {{-- Luas Bumi Transaksi --}}
    <div class="col-span-12 sm:col-span-2 mb-2">
        <label for="luas_bumi_transaksi" class="block text-sm font-medium text-gray-700">Luas Bumi Transaksi</label>
        <input type="number" id="luas_bumi_transaksi" name="luas_bumi_transaksi" class="border-gray-300 border rounded-lg p-2 w-full bg-gray-100" readonly>
    </div>

    {{-- Luas Bangunan Transaksi --}}
    <div class="col-span-12 sm:col-span-2 mb-2">
        <label for="luas_bangunan_transaksi" class="block text-sm font-medium text-gray-700">Luas Bangunan Transaksi</label>
        <input type="number" id="luas_bangunan_transaksi" name="luas_bangunan_transaksi" class="border-gray-300 border rounded-lg p-2 w-full bg-gray-100" readonly>
    </div>
    </div>

    {{-- Nomor Sertifikat --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
    <div class="mb-4">
        <label for="sertifikat" class="block text-sm font-medium text-gray-700">Nomor Sertifikat</label>
        <input type="text" id="sertifikat" name="sertifikat" class="border-gray-300 border rounded-lg p-2 w-full">
    </div>

    {{-- Harga Transaksi --}}
    <div class="mb-4">
        <label for="harga_trk" class="block text-sm font-medium text-gray-700">Harga Transaksi</label>
        <input type="text" id="harga_trk" name="harga_trk" class="border-gray-300 border rounded-lg p-2 w-full" onkeydown="return numbersonly(this, event);" onkeyup="tandaPemisahTitik(this);">
    </div>
</div>

    {{-- Akumulasi Nilai Sebelumnya --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
    <div class="mb-4">
        <label for="akumulasi" class="block text-sm font-medium text-gray-700">Akumulasi Nilai Sebelumnya</label>
        <input type="text" id="akumulasi" name="akumulasi" class="border-gray-300 border rounded-lg p-2 w-full">
    </div>

    {{-- Pengurangan --}}
    <div class="mb-4">
        <label for="pengurangan" class="block text-sm font-medium text-gray-700">Pengurangan</label>
        <select id="pengurangan" name="pengurangan" class="border-gray-300 border rounded-lg p-2 w-full">
            @foreach($tarifs as $tarif)
                <option value="{{ $tarif->tarif }}">{{ $tarif->tarif * 100 }}%</option>
            @endforeach
        </select>
    </div>
</div>

    {{-- Tanggal Verifikasi --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
    <div class="mb-4">
        <label for="tgl_verifikasi" class="block text-sm font-medium text-gray-700">Tanggal Verifikasi</label>
        <input type="date" id="tgl_verifikasi" name="tgl_verifikasi" class="border-gray-300 border rounded-lg p-2 w-full">
    </div>

    {{-- Tanggal Selesai --}}
    <div class="mb-4">
        <label for="tgl_selesai" class="block text-sm font-medium text-gray-700">Tanggal Selesai</label>
        <input type="date" id="tgl_selesai" name="tgl_selesai" class="border-gray-300 border rounded-lg p-2 w-full">
    </div>
</div>

    {{-- Keterangan --}}
    <div class="mb-4">
        <label for="ket" class="block text-sm font-medium text-gray-700">Keterangan</label>
        <input type="text" id="ket" name="ket" class="border-gray-300 border rounded-lg p-2 w-full">
    </div>
</div>


<div class="border-t pt-6 mt-8">
    <h1 class="text-2xl font-semibold text-center mb-6">Upload Persyaratan</h1>

    <p class="text-sm text-gray-500 mb-4 text-center">Silakan unggah dokumen persyaratan berikut sesuai kebutuhan</p>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        @php
            $fields = [
                ['ktp', 'Fotocopy Identitas (KTP) Wajib Pajak atau Kuasa Wajib Pajak', true],
                ['sertifikat', 'Fotocopy Sertifikat yang Dilegalisir', true],
                ['fc_spptpbb', 'Fotocopy SPPT PBB dan Bukti Pelunasan Pembayaran PBB Tahun Berjalan', true],
                ['denah_lokasi', 'Denah Lokasi Objek Pajak', true],
                ['bukti_lunas_pbb', 'Bukti Lunas PBB/STTS/TTS', true],
                ['fc_kartukeluarga', 'Fotocopy Kartu Keluarga', true],
                ['sspd_diisi', 'SSPD - BPHTB yang Telah Diisi Secara Lengkap', false],
                ['surat_k_w_p', 'Surat Kuasa Wajib Pajak', false],
                ['sk_lurah', 'Surat Keterangan Lurah (Bila Nama Disertifikat Berbeda dengan SPPT PBB)', false],
                ['fc_surat_waris', 'Fotocopy Surat Keterangan Waris/Hibah (Jika Peralihan Hak Merupakan Waris/Hibah)', false],
                ['s_permohonan', 'Surat Permohonan', false],
                ['s_pernyataan', 'Surat Pernyataan', false],
                ['b_p_pln', 'Bukti Pembayaran PLN', false],
            ];
        @endphp

        @foreach ($fields as [$name, $label, $required])
            <div>
                <label for="{{ $name }}" class="block text-sm font-medium text-gray-700">
                    {{ $label }} {{ $required ? '*' : '' }}
                </label>
                <input type="file"
                       name="{{ $name }}"
                       id="{{ $name }}"
                       class="w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm"
                       accept=".jpg,.jpeg,.png,.pdf"
                       {{ $required ? 'required' : '' }}>
                @error($name) <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>
        @endforeach
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
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
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
                    $('#kd_jns').val(data.kd_jns ?? '');
                    $('#tgl_daf').val(data.tgl_daf ?? '');
                });
                return false;
            }
        });

        // === AUTOCOMPLETE NOP ===
    $("#nop").autocomplete({
        source: function (request, response) {
            $.ajax({
                url: "/api/autocomplete-nop",
                dataType: "json",
                data: { term: request.term },
                success: function (data) {
                    response($.map(data, function (item) {
                        return {
                            label: item.nop,
                            value: item.nop
                        };
                    }));
                }
            });
        },
        minLength: 5,
        select: function (event, ui) {
            $("#nop").val(ui.item.value);

            $.post("{{ url('/api/get-data-nop') }}", { nop: ui.item.value }, function (data) {
                if (data.status === "ok") {
                    $("#nama_sppt").val(data.nama_sppt);
                    $("#letak_op").val(data.letak_op);
                    $("#nomor").val(data.nomor_op);
                    $("#rt").val(data.rt_op);
                    $("#rw").val(data.rw_op);
                    $("#kelurahan_op").val(data.nama_kel);
                    $("#Kecamatan_op").val(data.nama_kec);
                    $("#njop_bumi").val(data.njop_tanah);
                    $("#njop_bangunan").val(data.njop_bng);
                    $("#luas_bumi").val(data.luas_bumi);
                    $("#luas_bangunan").val(data.luas_bng);
                    // Auto salin ke form transaksi
                    $("#luas_bumi_transaksi").val(data.luas_bumi);
                    $("#luas_bangunan_transaksi").val(data.luas_bng);
                } else {
                    alert("Data tidak ditemukan");
                }
            });

            return false;
        }
    });
     // Sinkron manual jika field objek diubah
        $('#luas_bumi').on('input', function () {
            $('#luas_bumi_transaksi').val($(this).val());
        });

        $('#luas_bangunan').on('input', function () {
            $('#luas_bangunan_transaksi').val($(this).val());
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
