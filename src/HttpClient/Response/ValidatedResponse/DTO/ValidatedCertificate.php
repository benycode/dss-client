<?php

declare(strict_types=1);

namespace DSS\HttpClient\Response\ValidatedResponse\DTO;

use DSS\HttpClient\Response\ValidatedResponse\ValidatedObject;
use DSS\HttpClient\Response\ValidatedResponse\DTO\DiagnosticData;
use DSS\HttpClient\Response\ValidatedResponse\DTO\SimpleCertificateReport;
use DSS\HttpClient\Response\ValidatedResponse\DTO\DetailedReport;

final class ValidatedCertificate implements ValidatedObject
{   
    private DiagnosticData $diagnosticData;
    
    private SimpleCertificateReport $simpleCertificateReport;
    
    private DetailedReport $detailedReport;
        
    public function setDiagnosticData(DiagnosticData $diagnosticData): self
    {
        $this->diagnosticData = $diagnosticData;
        return $this;
    }
    
    public function getDiagnosticData(): DiagnosticData
    {
        return $this->diagnosticData;
    }
    
    public function setSimpleCertificateReport(SimpleCertificateReport $simpleCertificateReport): self
    {
        $this->simpleCertificateReport = $simpleCertificateReport;
        return $this;
    }
    
    public function getSimpleCertificateReport(): SimpleCertificateReport
    {
        return $this->simpleCertificateReport;
    }
    
    public function setDetailedReport(DetailedReport $detailedReport): self
    {
        $this->detailedReport = $detailedReport;
        return $this;
    }
    
    public function getDetailedReport(): DetailedReport
    {
        return $this->detailedReport;
    }
}
