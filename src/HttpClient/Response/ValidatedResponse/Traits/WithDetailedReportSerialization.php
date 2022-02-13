<?php

declare(strict_types=1);

namespace DSS\HttpClient\Response\ValidatedResponse\Traits;

use DSS\HttpClient\Response\ValidatedResponse\DTO\DetailedReport;
use DSS\HttpClient\Response\ValidatedResponse\DTO\DetailedReport\ConstraintName;
use DSS\HttpClient\Response\ValidatedResponse\DTO\DetailedReport\ConstraintWarning;
use DSS\HttpClient\Response\ValidatedResponse\DTO\DetailedReport\ConclusionWarning;
use DSS\HttpClient\Response\ValidatedResponse\DTO\DetailedReport\ConstraintError;
use DSS\HttpClient\Response\ValidatedResponse\DTO\DetailedReport\ConclusionError;
use DSS\HttpClient\Response\ValidatedResponse\DTO\DetailedReport\SignatureOrTimestampOrCertificate;
use DSS\HttpClient\Response\ValidatedResponse\DTO\DetailedReport\SignatureOrTimestampOrCertificate\Certificate as DetailedReportCertificate;
use DSS\HttpClient\Response\ValidatedResponse\DTO\DetailedReport\SignatureOrTimestampOrCertificate\Certificate\Constraint as DetailedReportCertificateConstraint;
use DSS\HttpClient\Response\ValidatedResponse\DTO\DetailedReport\SignatureOrTimestampOrCertificate\Certificate\Constraint\Name as DetailedReportCertificateConstraintName;
use DSS\HttpClient\Response\ValidatedResponse\DTO\DetailedReport\SignatureOrTimestampOrCertificate\Certificate\Constraint\Warning as DetailedReportCertificateConstraintWarning;
use DSS\HttpClient\Response\ValidatedResponse\DTO\DetailedReport\SignatureOrTimestampOrCertificate\Certificate\Conclusion as DetailedReportCertificateConclusion;
use DSS\HttpClient\Response\ValidatedResponse\DTO\DetailedReport\SignatureOrTimestampOrCertificate\Certificate\Conclusion\Warning as DetailedReportCertificateConclusionWarning;
use DSS\HttpClient\Response\ValidatedResponse\DTO\DetailedReport\BasicBuildingBlock;
use DSS\HttpClient\Response\ValidatedResponse\DTO\DetailedReport\BasicBuildingBlock\Conclusion as BasicBuildingBlockConclusion;
use DSS\HttpClient\Response\ValidatedResponse\DTO\DetailedReport\BasicBuildingBlock\Conclusion\Error as BasicBuildingBlockConclusionError;
use DSS\HttpClient\Response\ValidatedResponse\DTO\DetailedReport\BasicBuildingBlock\Xcv;
use DSS\HttpClient\Response\ValidatedResponse\DTO\DetailedReport\BasicBuildingBlock\Xcv\Constraint as XcvConstraint;
use DSS\HttpClient\Response\ValidatedResponse\DTO\DetailedReport\BasicBuildingBlock\Xcv\Constraint\Name as XcvConstraintName;
use DSS\HttpClient\Response\ValidatedResponse\DTO\DetailedReport\BasicBuildingBlock\Xcv\Constraint\Error as XcvConstraintError;
use DSS\HttpClient\Response\ValidatedResponse\DTO\DetailedReport\BasicBuildingBlock\Xcv\Conclusion as XcvConclusion;
use DSS\HttpClient\Response\ValidatedResponse\DTO\DetailedReport\BasicBuildingBlock\Xcv\Conclusion\Error as XcvConclusionError;
use Carbon\Carbon;

trait WithDetailedReportSerialization
{
    
    private function detailedReportCertificateConstraintSerialization(array $constraint): DetailedReportCertificateConstraint {
                                   
        $detailedReportCertificateConstraintDTO = (new DetailedReportCertificateConstraint())
            ->setStatus($constraint['Status'])
            ->setError($constraint['Error'])
            ->setInfo($constraint['Info'])
            ->setAdditionalInfo($constraint['AdditionalInfo'])
            ->setId($constraint['Id'])
            ->setBlockType($constraint['BlockType'])
            ;
            
        $name = $constraint['Name'];
        
        if(!is_null($name)){                
            $nameDTO = $this->detailedReportCertificateConstraintNameSerialization($name);
            $detailedReportCertificateConstraintDTO->setName($nameDTO);
        }
        
        $warning = $constraint['Warning'];       
        
        if(!is_null($warning)){
            $warningDTO = $this->detailedReportCertificateConstraintWarningSerialization($warning);
            $detailedReportCertificateConstraintDTO->setWarning($warningDTO);
        }
            
        return $detailedReportCertificateConstraintDTO;
    }
    
    private function detailedReportCertificateConstraintNameSerialization(array $name): ConstraintName {
        
        return (new DetailedReportCertificateConstraintName())
            ->setValue($name['value'])
            ->setKey($name['Key'])
            ;
    }
    
    private function detailedReportCertificateConstraintWarningSerialization(array $warning): ConstraintWarning {
        
        return (new DetailedReportCertificateConstraintWarning())
            ->setValue($warning['value'])
            ->setKey($warning['Key'])
            ;
    }
    
    private function detailedReportCertificateConclusionWarningSerialization(array $warning): ConclusionWarning {
        
        return (new DetailedReportCertificateConclusionWarning())
            ->setValue($warning['value'])
            ->setKey($warning['Key'])
            ;
    }
    
    private function detailedReportCertificateConclusionSerialization(array $conclusion): DetailedReportCertificateConclusion {
        
         $conclusionDTO = (new DetailedReportCertificateConclusion())
            ->setIndication($conclusion['Indication'])
            ->setSubIndication($conclusion['SubIndication'])
            ->setErrors($conclusion['Errors'])
            ->setInfos($conclusion['Infos'])
            ;
                                 
         $warnings = $conclusion['Warnings'];
                    
         foreach ($warnings as $warning) {
                        
            $warningDTO = $this->detailedReportCertificateConclusionWarningSerialization($warning);               
            $conclusionDTO->appendWarning($warningDTO);
         }
         
         return $conclusionDTO;
    }

    private function xcvConclusionErrorSerialization(array $error): ConclusionError {
        
        return (new XcvConclusionError())
            ->setValue($error['value'])
            ->setKey($error['Key'])
            ;
    }
    
    private function xcvConclusionSerialization(array $conclusion): XcvConclusion {
        
        $conclusionDTO = (new XcvConclusion())
            ->setIndication($conclusion['Indication'])
            ->setSubIndication($conclusion['SubIndication'])
        ;
        
        $errors = $conclusion['Errors'];
            
        foreach ($errors as $error) {
                
            $errorDTO = $this->xcvConclusionErrorSerialization($error);     
            $conclusionDTO->appendError($errorDTO);
        }
            
        $conclusionDTO->setWarnings($conclusion['Warnings']);
        $conclusionDTO->setInfos($conclusion['Infos']);
        
        return $conclusionDTO;
    }
    
    private function xcvSerialization(array $xcv): Xcv {
        
        $xcvDTO = (new Xcv())
            ->setSubXCV($xcv['SubXCV'])
            ;
            
        $constraints = $xcv['Constraint'];
            
        foreach ($constraints as $constraint) {
                
            $constraintDTO = $this->xcvConstraintSerialization($constraint);  
            $xcvDTO->appendConstraint($constraintDTO);
        }

        $conclusion = $xcv['Conclusion'];     
        $conclusionDTO = $this->xcvConclusionSerialization($conclusion);
                
        $xcvDTO->setConclusion($conclusionDTO);
        $xcvDTO->setTitle($xcv['Title']);
            
        return $xcvDTO;
    }
    
    private function xcvConstraintNameSerialization(array $name): ConstraintName {
        
        return (new XcvConstraintName())
            ->setValue($name['value'])
            ->setKey($name['Key'])
            ;
    }
    
    private function xcvConstraintErrorSerialization(array $error): ConstraintError {
        
        return (new XcvConstraintError())
            ->setValue($error['value'])
            ->setKey($error['Key'])
            ;
    }
    
    private function xcvConstraintSerialization(array $constraint): XcvConstraint {
        
        $name = $constraint['Name'];        
        $nameDTO = $this->xcvConstraintNameSerialization($name);
            
        $xcvConstraintDTO = (new XcvConstraint())
            ->setName($nameDTO)
            ->setStatus($constraint['Status'])
            ->setWarning($constraint['Warning'])
            ->setInfo($constraint['Info'])
            ->setAdditionalInfo($constraint['AdditionalInfo'])
            ->setId($constraint['Id'])
            ->setBlockType($constraint['BlockType'])
            ;
            
        $error = $constraint['Error'];
        
        if(!is_null($error)){      
            $errorDTO = $this->xcvConstraintErrorSerialization($error);
            $xcvConstraintDTO->setError($errorDTO);
        }
        
        return $xcvConstraintDTO;
    }
    
    
    private function basicBuildingBlockConclusionErrorSerialization(array $error): ConclusionError {
        
        return (new BasicBuildingBlockConclusionError())
            ->setValue($error['value'])
            ->setKey($error['Key'])
            ;
    }
 
    private function basicBuildingBlockConclusionSerialization(array $conclusion): BasicBuildingBlockConclusion {
        
        $conclusionDTO = (new BasicBuildingBlockConclusion())
            ->setIndication($conclusion['Indication'])
            ->setSubIndication($conclusion['SubIndication'])
            ;
        
        $errors = $conclusion['Errors'];
        
        if(!is_null($errors)){
            foreach ($errors as $error) {      
                $errorDTO = $this->basicBuildingBlockConclusionErrorSerialization($error);       
                $conclusionDTO->appendError($errorDTO);
            }
        }
            
        $conclusionDTO->setWarnings($conclusion['Warnings']);
        $conclusionDTO->setInfos($conclusion['Infos']);
        
        return $conclusionDTO;
            
    }
 
    private function detailedReportCertificateSerialization(array $certificate): DetailedReportCertificate {
        
        $certificateDTO = (new DetailedReportCertificate())
            ->setValidationCertificateQualification($certificate['ValidationCertificateQualification'])
            ;
                        
        $constraints = $certificate['Constraint'];
                    
        foreach ($constraints as $constraint) {
                            
            $constraintDTO = $this->detailedReportCertificateConstraintSerialization($constraint);                        
            $certificateDTO->appendConstraint($constraintDTO);                   
         }

        $conclusion = $certificate['Conclusion'];
                    
        $conclusionDTO = $this->detailedReportCertificateConclusionSerialization($conclusion);      
                                               
        $certificateDTO->setConclusion($conclusionDTO)
            ->setTitle($certificate['Title'])
            ->setId($certificate['Id'])
            ;
        
        return $certificateDTO;
    }
    
    private function basicBuildingBlockSerialization(array $basicBuildingBlock): BasicBuildingBlock {
        
        $xcv = $basicBuildingBlock['XCV']; 
        $xcvDTO = $this->xcvSerialization($xcv);
            
        $conclusion = $basicBuildingBlock['Conclusion'];
        $conclusionDTO = $this->basicBuildingBlockConclusionSerialization($conclusion);
             
        return (new BasicBuildingBlock())
            ->setFc($basicBuildingBlock['FC'])
            ->setIsc($basicBuildingBlock['ISC'])
            ->setVci($basicBuildingBlock['VCI'])
            ->setXcv($xcvDTO)
            ->setCv($basicBuildingBlock['CV'])
            ->setSav($basicBuildingBlock['SAV'])
            ->setSav($basicBuildingBlock['SAV'])
            ->setPsv($basicBuildingBlock['PSV'])
            ->setPcv($basicBuildingBlock['PCV'])
            ->setVts($basicBuildingBlock['VTS'])
            ->setCertificateChain($basicBuildingBlock['CertificateChain'])
            ->setConclusion($conclusionDTO)
            ->setId($basicBuildingBlock['Id'])
            ->setType($basicBuildingBlock['Type'])
            ;
    }

    private function signatureOrTimestampOrCertificateSerialization(array $signatureOrTimestampOrCertificate): SignatureOrTimestampOrCertificate {
        
        $signatureOrTimestampOrCertificateDTO  = (new SignatureOrTimestampOrCertificate());
        
        foreach ($signatureOrTimestampOrCertificate as $object) {
            switch (strtoupper(key($object))) {
                case 'CERTIFICATE':
                                           
                    $certificateDTO = $this->detailedReportCertificateSerialization($object['Certificate']);     
                    $signatureOrTimestampOrCertificateDTO->appendCertificate($certificateDTO);
                            
                    break;
                
                default:
                    
                    throw \ValueError(sprintf('signatureOrTimestampOrCertificate element %s not delcared', key($object)));
                    
                    break;
            }
        }

        return $signatureOrTimestampOrCertificateDTO;
    }
    
    private function detailedReportSerialization(array $detailedReport): DetailedReport {
        
        $signatureOrTimestampOrCertificate = $detailedReport['signatureOrTimestampOrCertificate'];
        
        $signatureOrTimestampOrCertificateDTO  = $this->signatureOrTimestampOrCertificateSerialization($signatureOrTimestampOrCertificate);
        
        $detailedReportDTO = (new DetailedReport())
            ->setSignatureOrTimestampOrCertificate($signatureOrTimestampOrCertificateDTO)
            ; 
            
        $basicBuildingBlocks = $detailedReport['BasicBuildingBlocks'];
         
        foreach ($basicBuildingBlocks as $basicBuildingBlock) {
            
             $basicBuildingBlockDTO = $this->basicBuildingBlockSerialization($basicBuildingBlock);   
             $detailedReportDTO->appendBasicBuildingBlock($basicBuildingBlockDTO);
        }
        
        $detailedReportDTO->setTLAnalysis($detailedReport['TLAnalysis'])
            ->setSemantic($detailedReport['Semantic'])
            ->setValidationTime($detailedReport['ValidationTime'])
            ;
            
        return $detailedReportDTO;
    }
}
    