<?php
$pdf = new FPDF("L", "cm", "A4"); // Orientasi Landscape, satuan cm, ukuran A4
$pdf->AddPage();
$pdf->SetTitle("Laporan Data Pendaftaran Akun Beasiswa");

// Header Judul
$pdf->SetFont("Arial", "B", 12);
$pdf->Cell(28, 1, "Kemahasiswaan Uniska Banjarmasin", 0, 1, "C");

$pdf->SetFont("Arial", "", 11);
$pdf->Cell(28, 1, "Alamat: Jl. Simpang Adhyaksa No.3 Kel. Sungai Miai Kec. Banjarmasin Utara", 0, 1, "C");
$pdf->Line(1, 3, 28, 3); // Garis horizontal sepanjang kertas
$pdf->Ln(1);

$pdf->SetFont("Arial", "B", 12);
$pdf->Cell(28, 1, "Laporan Data Pendaftaran Akun Beasiswa", 0, 1, "C");
$pdf->Ln(1);

// Header Kolom
$pdf->SetFont("Arial", "B", 11);
$pdf->SetFillColor(0, 255, 0);

// Lebar kolom diatur agar muat dalam kertas orientasi landscape
$pdf->Cell(2, 1, "No", 1, 0, "C", true);             // Kolom No
$pdf->Cell(5, 1, "No Pendaftaran", 1, 0, "C", true);  // Kolom No Pendaftaran
$pdf->Cell(7, 1, "Nama Lengkap", 1, 0, "C", true);    // Kolom Nama Lengkap
$pdf->Cell(5, 1, "No Handphone", 1, 0, "C", true);    // Kolom No Handphone
$pdf->Cell(4, 1, "Bukti Daftar", 1, 0, "C", true);    // Kolom Bukti Daftar
$pdf->Cell(5, 1, "Keterangan", 1, 1, "C", true);      // Kolom Keterangan

// Data
$pdf->SetFont("Arial", "", 11);
$no = 1;
foreach ($pendaftaran as $a) {
    $rowHeight = 4; // Menyesuaikan tinggi baris untuk menyesuaikan dengan gambar

    // Kolom No
    $pdf->Cell(2, $rowHeight, $no++, 1, 0, "C");

    // Kolom No Pendaftaran
    $pdf->Cell(5, $rowHeight, $a->no_pendaftaran, 1, 0, "C");

    // Kolom Nama Lengkap
    $pdf->Cell(7, $rowHeight, $a->nama_lengkap, 1, 0, "C");

    // Kolom No Handphone
    $pdf->Cell(5, $rowHeight, $a->no_handphone, 1, 0, "C");

    // Kolom Bukti Daftar (gambar jika ada)
    if (file_exists("upload/bukti_daftar/" . $a->bukti_daftar)) {
        $pdf->Cell(4, $rowHeight, '', 1, 0, "C");
        $pdf->Image("upload/bukti_daftar/" . $a->bukti_daftar, $pdf->GetX() - 4, $pdf->GetY() + 0.1, 3.8, 3.8); // Sesuaikan tinggi gambar dengan tinggi baris
    } else {
        $pdf->Cell(4, $rowHeight, "Tidak Ada", 1, 0, "C");
    }

    // Kolom Keterangan
    $pdf->Cell(5, $rowHeight, $a->keterangan, 1, 1, "C");
}

$pdf->Output();
?>
