<?php

declare(strict_types=1);

namespace DSS\HttpClient\Response\ValidatedResponse\Traits;

use DSS\HttpClient\Response\ValidatedResponse\DTO\ValidatedCertificate;
use DSS\HttpClient\Response\ValidatedResponse\Traits\WithDiagnosticDataSerialization;
use DSS\HttpClient\Response\ValidatedResponse\Traits\WithSimpleCertificateReportSerialization;
use DSS\HttpClient\Response\ValidatedResponse\Traits\WithDetailedReportSerialization;

trait WithValidatedCertificateSerialization
{
    use WithDiagnosticDataSerialization;
    use WithSimpleCertificateReportSerialization;
    use WithDetailedReportSerialization;
    
    private function validatedCertificateSerialization(array $validatedCertificate): ValidatedCertificate {
            
        $diagnosticData = $validatedCertificate['diagnosticData'];
        
        $diagnosticDataDTO = $this->diagnosticDataSerialization($diagnosticData);
        
        $simpleCertificateReport = $validatedCertificate['simpleCertificateReport'];
        
        $simpleCertificateReportDTO = $this->simpleCertificateReportSerialization($simpleCertificateReport);
        
        $detailedReport = $validatedCertificate['detailedReport'];
        
        $detailedReportDTO = $this->detailedReportSerialization($detailedReport);
              
        return (new ValidatedCertificate())
            ->setDiagnosticData($diagnosticDataDTO)
            ->setSimpleCertificateReport($simpleCertificateReportDTO)
            ->setDetailedReport($detailedReportDTO)
            ;
    }
}  