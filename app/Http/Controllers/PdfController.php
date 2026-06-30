use PDF;

public function venda($id)
{
    $venda = Venda::with('cliente','produto')->findOrFail($id);

    $pdf = PDF::loadView('pdf.venda', compact('venda'));

    return $pdf->download('recibo-venda.pdf');
}