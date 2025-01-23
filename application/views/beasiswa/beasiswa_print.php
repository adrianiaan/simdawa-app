<?php
$pdf = new FPDF("P", "cm", "A4"); //orientasi kertas (P/L), satuan kertas(cm/mm), ukuran kertas
$pdf->AddPage();
$pdf->SetTitle("Laporan Data Beasiswa");
$pdf->SetFont("Arial", "B", "12"); //setfont(jenis font, style (B), ukuran font) setfont berlaku sampai ada setfont berikutnya
$pdf->Cell(19, 1, "Kemahasiswaan Uniska Banjarmasin", 0, 1, "C");
//cell = Textbox (lebar, tinggi, teks, border(0,1), posisi cell selanjutnya (0,1), perataan teks(C,R,L,J))
$pdf->SetFont("Arial", "", 11);
$pdf->Cell(19, 1, "Alamat: Jl. Simpang Adhyaksa No.3 Kel. Sungai Miai Kec. Banjarmasin Utara", 0, 1, "C");
$pdf->Line(1, 3, 20, 3); //Line untuk membuat garis dengan 4 parameter(x1, y1, x2, y2)
$pdf->Ln(1);
$pdf->SetFont("Arial", "B", 12);
$pdf->Cell(19, 1, "Laporan Data Beasiswa", 0, 1, "C");
$pdf->Ln(1);
$pdf->SetFont("Arial", "B", 11);
$pdf->SetFillColor(0, 255, 0); //mengatur background cell
$pdf->Cell(1, 1, "No", 1, 0, "C", true); //nilai true pada cell untuk mengaktifkan background dari cell
$pdf->Cell(6, 1, "Nama Beasiswa", 1, 0, "C", true);
$pdf->Cell(4, 1, "Tanggal Mulai", 1, 0, "C", true);
$pdf->Cell(4, 1, "Tanggal Selesai", 1, 0, "C", true);
$pdf->Cell(4, 1, "Jenis Beasiswa", 1, 1, "C", true);
$pdf->SetFont("Arial", "", 11);
$no = 1;
foreach ($beasiswa as $a) {
    $pdf->Cell(1, 1, $no++, 1, 0, "C");
    $pdf->Cell(6, 1, $a->nama_beasiswa, 1, 0, "C");
    $pdf->Cell(4, 1, $a->tanggal_mulai, 1, 0, "C");
    $pdf->Cell(4, 1, $a->tanggal_selesai, 1, 0, "C");
    $pdf->Cell(4, 1, $a->nama_jenis, 1, 1, "C");
}
$pdf->Output();
?>
