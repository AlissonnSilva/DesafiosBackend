<?php

// app/Services/ReportService.php

namespace App\Services;

use App\Reports\Factories\ReportFactory;
use App\Interfaces\ReportInterface;

class ReportService
{
    protected ReportFactory $reportFactory;

    // Injeta a Factory via construtor
    public function __construct(ReportFactory $reportFactory)
    {
        $this->reportFactory = $reportFactory;
    }

    public function generateReport(string $type, array $sourceData): ReportInterface
    {
        // 1. A Factory cria a instância correta (PDF ou CSV)
        $reportGenerator = $this->reportFactory->createReport($type);

        // 2. Chama o método generate no objeto criado (sem saber se é PDF ou CSV)
        $reportContent = $reportGenerator->generate($sourceData);

        // 3. Retorna o objeto gerado para que o Controller possa lidar com o download/resposta
        return $reportGenerator;
    }
}
