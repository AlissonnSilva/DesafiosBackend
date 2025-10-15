<?php

// app/Reports/Factories/ReportFactory.php

namespace App\Reports\Factories;

use App\Interfaces\ReportInterface;
use App\Reports\Implementations\CsvReport;
use App\Reports\Implementations\PdfReport;
use App\Reports\Implementations\JsonReport;
use InvalidArgumentException;

class ReportFactory
{
    /**
     * O método factory que decide qual objeto concreto instanciar.
     *
     * @param string $type O tipo de relatório solicitado ('pdf' ou 'csv').
     * @return ReportInterface
     * @throws InvalidArgumentException
     */
    public function createReport(string $type): ReportInterface
    {
        switch (strtolower($type)) {
            case 'pdf':
                return new PdfReport();
            case 'csv':
                return new CsvReport();
            case 'json':
                return new JsonReport();
            default:
                throw new InvalidArgumentException("Tipo de relatório '{$type}' não suportado.");
        }
    }
}
