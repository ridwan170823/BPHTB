<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sertifikat Persetujuan BPHTB</title>
    <style>
        body { font-family: DejaVu Sans, Arial, sans-serif; margin: 40px; color: #111827; }
        h1 { text-align: center; font-size: 24px; text-transform: uppercase; letter-spacing: 1px; }
        h2 { font-size: 18px; margin-top: 32px; text-transform: uppercase; letter-spacing: 1px; }
        p { line-height: 1.5; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 16px; font-size: 12px; }
        th, td { border: 1px solid #d1d5db; padding: 8px 12px; text-align: left; }
        .meta { margin-top: 16px; font-size: 12px; }
        .signature { margin-top: 60px; text-align: right; font-size: 12px; }
        .signature span { display: block; }
    </style>
</head>
<body>
@php
    $issuedAt = now()->translatedFormat('d F Y');
@endphp
    <h1>Sertifikat Persetujuan BPHTB</h1>
    <p>Dokumen ini merupakan bukti bahwa pengajuan BPHTB dengan nomor <strong>{{ $pelayanan->no_urut_p }}</strong> telah disetujui oleh Kabid Pendapatan pada tanggal {{ $issuedAt }}.</p>

    <h2>Informasi Pengajuan</h2>
    <table>
        <tbody>
            <tr>
                <th>Nomor Pengajuan</th>
                <td>{{ $pelayanan->no_urut_p }}</td>
            </tr>
            <tr>
                <th>Nama Wajib Pajak</th>
                <td>{{ $pelayanan->nama_sppt ?? '-' }}</td>
            </tr>
            <tr>
                <th>Alamat Objek Pajak</th>
                <td>{{ $pelayanan->alamat_op ?? '-' }}</td>
            </tr>
            <tr>
                <th>NOP</th>
                <td>{{ $pelayanan->nopp ?? '-' }}</td>
            </tr>
            <tr>
                <th>Nilai Perolehan (Rp)</th>
                <td>{{ number_format((float) ($pelayanan->harga_trk ?? 0), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <th>Nilai BPHTB (Rp)</th>
                <td>{{ number_format((float) ($pelayanan->pokok_pajak ?? 0), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <th>Status</th>
                <td>{{ $pelayanan->status }}</td>
            </tr>
        </tbody>
    </table>

    <p class="meta">Sertifikat ini dihasilkan secara otomatis dari sistem pelayanan BPHTB Pemerintah Kota. Simpan dokumen ini sebagai arsip resmi.</p>

    <div class="signature">
        <span>Kepala Bidang Pendapatan</span>
        <span>{{ $approvedBy ?? 'Pejabat Berwenang' }}</span>
    </div>
</body>
</html>