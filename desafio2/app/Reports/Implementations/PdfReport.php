<?php

// app/Reports/Implementations/PdfReport.php

namespace App\Reports\Implementations;

use App\Interfaces\ReportInterface;

class PdfReport implements ReportInterface
{
    public function generate(array $data): string
    {
        // Lógica real: usar uma biblioteca como DomPDF ou Snappy para gerar PDF
        $count = count($data);
        return "Conteúdo PDF Gerado: Relatório de {$count} itens com cabeçalho e rodapé.";
    }

    public function getFileType(): string
    {
        return 'pdf';
    }
}
