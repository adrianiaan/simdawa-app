<?php
$pdf = new FPDF("P", "cm", "A4"); // Orientasi kertas (P/L), satuan kertas(cm/mm), ukuran kertas
$pdf->AddPage();
$pdf->SetTitle("Laporan Data Persyaratan Beasiswa");

// Header Judul
$pdf->SetFont("Arial", "B", 12);
$pdf->Cell(19, 1, "Kemahasiswaan Uniska Banjarmasin", 0, 1, "C");

$pdf->SetFont("Arial", "", 11);
$pdf->Cell(19, 1, "Alamat: Jl. Simpang Adhyaksa No.3 Kel. Sungai Miai Kec. Banjarmasin Utara", 0, 1, "C");
$pdf->Line(1, 3, 20, 3); // Garis horizontal
$pdf->Ln(1);

$pdf->SetFont("Arial", "B", 12);
$pdf->Cell(19, 1, "Laporan Data Persyaratan Beasiswa", 0, 1, "C");
$pdf->Ln(1);

// Header Kolom
$pdf->SetFont("Arial", "B", 11);
$pdf->SetFillColor(0, 255, 0); // Mengatur background cell
$pdf->Cell(1, 1, "No", 1, 0, "C", true); // Kolom No
$pdf->Cell(8, 1, "Nama Persyaratan", 1, 0, "C", true); // Kolom Nama Jenis
$pdf->Cell(10, 1, "Keterangan", 1, 1, "C", true); // Kolom Keterangan

// Data
$pdf->SetFont("Arial", "", 11);
$no = 1;
foreach ($persyaratan as $a) {
    $pdf->Cell(1, 1, $no++, 1, 0, "C"); // Kolom No
    $pdf->Cell(8, 1, $a->nama_persyaratan, 1, 0, "C"); // Kolom Nama Jenis
    $pdf->Cell(10, 1, $a->keterangan, 1, 1, "C"); // Kolom Keterangan
}

$pdf->Output();
?>
