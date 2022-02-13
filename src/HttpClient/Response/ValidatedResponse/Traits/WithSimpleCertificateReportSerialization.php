<?php

declare(strict_types=1);

namespace DSS\HttpClient\Response\ValidatedResponse\Traits;

use DSS\HttpClient\Response\ValidatedResponse\DTO\SimpleCertificateReport;
use DSS\HttpClient\Response\ValidatedResponse\DTO\SimpleCertificateReport\ChainItem;
use DSS\HttpClient\Response\ValidatedResponse\DTO\SimpleCertificateReport\ChainItem\Subject;
use DSS\HttpClient\Response\ValidatedResponse\DTO\SimpleCertificateReport\ChainItem\Revocation;
use DSS\HttpClient\Response\ValidatedResponse\DTO\SimpleCertificateReport\ChainItem\TrustAnchor;
use Carbon\Carbon;

trait WithSimpleCertificateReportSerialization
{
    private function revocationSerialization(array $revocation): Revocation {
        
        return (new Revocation())
            ->setProductionDate($revocation['productionDate'])
            ->setRevocationDate($revocation['revocationDate'])
            ->setRevocationReason($revocation['revocationReason'])
            ;
    }
    
    private function subjectSerialization(array $subject): Subject {
        
        return (new Subject())
            ->setCommonName($subject['commonName'])
            ->setSurname($subject['surname'])
            ->setGivenName($subject['givenName'])
            ->setPseudonym($subject['pseudonym'])
            ->setOrganizationName($subject['organizationName'])
            ->setOrganizationUnit($subject['organizationUnit'])
            ->setEmail($subject['email'])
            ->setLocality($subject['locality'])
            ->setState($subject['state'])
            ->setCountry($subject['country'])
            ;
    }
    
    private function simpleCertificateReportSerialization(array $simpleCertificateReport): SimpleCertificateReport {
        
        $simpleCertificateReportDTO = (new SimpleCertificateReport());
            
        foreach ($simpleCertificateReport['ChainItem'] as $chainItem) {
            
            $chainItemDTO = $this->chainItemSerialization($chainItem);

            $simpleCertificateReportDTO->appendChainItem($chainItemDTO);
        }

        $simpleCertificateReportDTO->setValidationTime(Carbon::parse($simpleCertificateReport['ValidationTime']));
        
        return $simpleCertificateReportDTO;
    }
    
    private function trustAnchorSerialization(array $trustAnchor): TrustAnchor {
        
        return (new TrustAnchor())
            ->setCountryCode($trustAnchor['countryCode'])
            ->setTrustServiceProvider($trustAnchor['trustServiceProvider'])
            ->setTrustServiceProviderRegistrationId($trustAnchor['trustServiceProviderRegistrationId'])
            ->setTrustServiceName($trustAnchor['trustServiceName'])
            ;
    }
    
    private function chainItemSerialization(array $chainItem): ChainItem {
        
        $subject = $chainItem['subject'];
            
        $subjectDTO = $this->subjectSerialization($subject);
                
        $revocation = $chainItem['revocation'];
                
        $revocationDTO = $this->revocationSerialization($revocation);
            
        $chainItemDTO = (new ChainItem())
            ->setId($chainItem['id'])
            ->setSubject($subjectDTO)
            ->setIssuerId($chainItem['issuerId'])
            ->setNotBefore(Carbon::parse($chainItem['notBefore']))
            ->setNotAfter(Carbon::parse($chainItem['notAfter']))
            ->setKeyUsage($chainItem['keyUsage'])
            ->setExtendedKeyUsage($chainItem['extendedKeyUsage'])
            ->setOcspUrl($chainItem['ocspUrl'])
            ->setCrlUrl($chainItem['crlUrl'])
            ->setAiaUrl($chainItem['aiaUrl'])
            ->setCpsUrl($chainItem['cpsUrl'])
            ->setPdsUrl($chainItem['pdsUrl'])
            ->setQualificationAtIssuance($chainItem['qualificationAtIssuance'])
            ->setQualificationAtValidation($chainItem['qualificationAtValidation'])
            ->setRevocation($revocationDTO)
            ->setIndication($chainItem['Indication'])
            ->setSubIndication($chainItem['SubIndication'])
            ;
            
        $trustAnchors = $chainItem['trustAnchor'];
        
        if(!is_null($trustAnchors)){           
            foreach ($trustAnchors as $trustAnchor) {        
                $trustAnchorDTO = $this->trustAnchorSerialization($trustAnchor);
                $chainItemDTO->appendTrustAnchor($trustAnchorDTO);       
            }         
        }
       
        return $chainItemDTO;
    }
}  