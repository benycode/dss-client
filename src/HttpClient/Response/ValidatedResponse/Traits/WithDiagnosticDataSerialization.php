<?php

declare(strict_types=1);

namespace DSS\HttpClient\Response\ValidatedResponse\Traits;

use DSS\HttpClient\Response\ValidatedResponse\DTO\DiagnosticData;
use DSS\HttpClient\Response\ValidatedResponse\DTO\DiagnosticData\TrustedList as DiagnosticDataTrustedList;
use DSS\HttpClient\Response\ValidatedResponse\DTO\DiagnosticData\Revocation as DiagnosticDataRevocation;
use DSS\HttpClient\Response\ValidatedResponse\DTO\DiagnosticData\Revocation\DigestAlgoAndValue as DiagnosticDataRevocationDigestAlgoAndValue;
use DSS\HttpClient\Response\ValidatedResponse\DTO\DiagnosticData\Revocation\BasicSignature as DiagnosticDataRevocationBasicSignature;
use DSS\HttpClient\Response\ValidatedResponse\DTO\DiagnosticData\Revocation\SigningCertificate as DiagnosticDataRevocationSigningCertificate;
use DSS\HttpClient\Response\ValidatedResponse\DTO\DiagnosticData\Revocation\ChainItem as DiagnosticDataRevocationChainItem;
use DSS\HttpClient\Response\ValidatedResponse\DTO\DiagnosticData\Revocation\FoundCertificates as DiagnosticDataRevocationFoundCertificates;
use DSS\HttpClient\Response\ValidatedResponse\DTO\DiagnosticData\Revocation\FoundCertificates\RelatedCertificate as DiagnosticDataRevocationFoundCertificatesRelatedCertificate;
use DSS\HttpClient\Response\ValidatedResponse\DTO\DiagnosticData\Revocation\FoundCertificates\RelatedCertificate\CertificateRef as DiagnosticDataRevocationFoundCertificatesRelatedCertificateCertificateRef;
use DSS\HttpClient\Response\ValidatedResponse\DTO\DiagnosticData\Revocation\FoundCertificates\RelatedCertificate\CertificateRef\DigestAlgoAndValue as DiagnosticDataRevocationFoundCertificatesRelatedCertificateCertificateRefDigestAlgoAndValue;
use DSS\HttpClient\Response\ValidatedResponse\DTO\DiagnosticData\Revocation\FoundCertificates\RelatedCertificate\CertificateRef\SerialInfo as DiagnosticDataRevocationFoundCertificatesRelatedCertificateCertificateRefSerialInfo;
use DSS\HttpClient\Response\ValidatedResponse\DTO\DiagnosticData\Certificate;
use DSS\HttpClient\Response\ValidatedResponse\DTO\DiagnosticData\Certificate\CertificatePolicy;
use DSS\HttpClient\Response\ValidatedResponse\DTO\DiagnosticData\Certificate\ChainItem;
use DSS\HttpClient\Response\ValidatedResponse\DTO\DiagnosticData\Certificate\ExtendedKeyUsagesOid;
use DSS\HttpClient\Response\ValidatedResponse\DTO\DiagnosticData\Certificate\SubjectDistinguishedName;
use DSS\HttpClient\Response\ValidatedResponse\DTO\DiagnosticData\Certificate\IssuerDistinguishedName;
use DSS\HttpClient\Response\ValidatedResponse\DTO\DiagnosticData\Certificate\BasicSignature;
use DSS\HttpClient\Response\ValidatedResponse\DTO\DiagnosticData\Certificate\DigestAlgoAndValue;
use DSS\HttpClient\Response\ValidatedResponse\DTO\DiagnosticData\Certificate\DistinguishedName;
use DSS\HttpClient\Response\ValidatedResponse\DTO\DiagnosticData\Certificate\SigningCertificate;
use DSS\HttpClient\Response\ValidatedResponse\DTO\DiagnosticData\Certificate\QcStatements;
use DSS\HttpClient\Response\ValidatedResponse\DTO\DiagnosticData\Certificate\QcStatements\QcCompliance;
use DSS\HttpClient\Response\ValidatedResponse\DTO\DiagnosticData\Certificate\QcStatements\QcSSCD;
use DSS\HttpClient\Response\ValidatedResponse\DTO\DiagnosticData\Certificate\QcStatements\PdsLocation;
use DSS\HttpClient\Response\ValidatedResponse\DTO\DiagnosticData\Certificate\QcStatements\QcType;
use DSS\HttpClient\Response\ValidatedResponse\DTO\DiagnosticData\Certificate\QcStatements\SemanticsIdentifier;
use Carbon\Carbon;

trait WithDiagnosticDataSerialization
{    
    private function subjectDistinguishedNameSerialization(array $subjectDistinguishedName): DistinguishedName {
        
         return (new SubjectDistinguishedName())
             ->setValue($subjectDistinguishedName['value'])
             ->setFormat($subjectDistinguishedName['Format'])
             ;
    }
    
    private function issuerDistinguishedNameSerialization(array $issuerDistinguishedName): DistinguishedName {
        
         return (new IssuerDistinguishedName())
             ->setValue($issuerDistinguishedName['value'])
             ->setFormat($issuerDistinguishedName['Format'])
             ;
    }
    
    private function digestAlgoAndValueSerialization(array $digestAlgoAndValue): DigestAlgoAndValue {
        
        return (new DigestAlgoAndValue())
             ->setDigestMethod($digestAlgoAndValue['DigestMethod'])
             ->setDigestValue($digestAlgoAndValue['DigestValue'])
             ->setMatch($digestAlgoAndValue['match'])
             ;
    }
    
    private function basicSignatureSerialization(array $basicSignature): BasicSignature {
        
        return (new BasicSignature())
            ->setEncryptionAlgoUsedToSignThisToken($basicSignature['EncryptionAlgoUsedToSignThisToken'])
            ->setKeyLengthUsedToSignThisToken($basicSignature['KeyLengthUsedToSignThisToken'])
            ->setDigestAlgoUsedToSignThisToken($basicSignature['DigestAlgoUsedToSignThisToken'])
            ->setMaskGenerationFunctionUsedToSignThisToken($basicSignature['MaskGenerationFunctionUsedToSignThisToken'])
            ->setSignatureIntact($basicSignature['SignatureIntact'])
            ->setSignatureValid($basicSignature['SignatureValid'])
            ;
    }
    
    private function signingCertificateSerialization(array $signingCertificate): SigningCertificate {
        
        return (new SigningCertificate())
            ->setPublicKey($signingCertificate['PublicKey'])
            ->setCertificate($signingCertificate['Certificate'])
            ;
    }
    
    private function qcComplianceSerialization(array $qcCompliance): QcCompliance {
        
        return (new QcCompliance())
            ->setPresent($qcCompliance['present'])
            ;
    }
    
    private function qcSSCDSerialization(array $qcSSCD): QcSSCD {
        
        return (new QcSSCD())
            ->setPresent($qcSSCD['present'])
            ;
    }

    private function pdsLocationSerialization(array $pdsLocation): PdsLocation {
        
        return (new PdsLocation())
            ->setValue($pdsLocation['value'])
            ->setLang($pdsLocation['lang'])
            ;
    }
    
    private function qcTypeSerialization(array $qcType): QcType {
        
        return (new QcType())
            ->setValue($qcType['value'])
            ->setDescription($qcType['Description'])
            ;
    }
    
    private function semanticsIdentifierSerialization(array $semanticsIdentifier): SemanticsIdentifier {
        
        return (new SemanticsIdentifier())
            ->setValue($semanticsIdentifier['value'])
            ->setDescription($semanticsIdentifier['Description'])
            ;
    }
    
    private function qcStatementsSerialization(array $qcStatements): QcStatements {
        
        $qcCompliance = $qcStatements['QcCompliance'];
        $qcComplianceDTO = $this->qcComplianceSerialization($qcCompliance);
        
        $qcSSCD = $qcStatements['QcSSCD'];
        $qcSSCDDTO = $this->qcSSCDSerialization($qcSSCD);
        
        $semanticsIdentifier = $qcStatements['SemanticsIdentifier'];
        $semanticsIdentifierDTO = $this->semanticsIdentifierSerialization($semanticsIdentifier);
        
        $qcStatementsDTO = (new QcStatements())
            ->setQcCompliance($qcComplianceDTO)
            ->setQcEuLimitValue($qcStatements['QcEuLimitValue'])
            ->setQcEuRetentionPeriod($qcStatements['QcEuRetentionPeriod'])
            ->setQcSSCD($qcSSCDDTO)
            ->setCountryName($qcStatements['CountryName'])
            ->setSemanticsIdentifier($semanticsIdentifierDTO)
            ->setPSD2QcInfo($qcStatements['PSD2QcInfo'])
            ;
        
        $pdsLocations = $qcStatements['PdsLocation'];
        
        foreach ($pdsLocations as $pdsLocation) {       
            $pdsLocationDTO = $this->pdsLocationSerialization($pdsLocation);
            $qcStatementsDTO->appendPdsLocation($pdsLocationDTO);
        }
        
        $qcTypes = $qcStatements['QcType'];
        
        foreach ($qcTypes as $qcType) {       
            $qcTypeDTO = $this->qcTypeSerialization($qcType);
            $qcStatementsDTO->appendQcType($qcTypeDTO);
        }
            
        return $qcStatementsDTO;
    }

    private function extendedKeyUsagesOidSerialization(array $extendedKeyUsagesOid): ExtendedKeyUsagesOid {
        
        return (new ExtendedKeyUsagesOid())
            ->setValue($extendedKeyUsagesOid['value'])
            ->setDescription($extendedKeyUsagesOid['Description'])
            ;
    }
    
    private function diagnosticDataCertificateChainItemSerialization(array $chainItem): ChainItem {
        
        return (new ChainItem())
            ->setCertificate($chainItem['Certificate'])
            ;
    }
    
    private function diagnosticDataCertificatePolicySerialization(array $certificatePolicy): CertificatePolicy {
        
        return (new CertificatePolicy())
            ->setValue($certificatePolicy['value'])
            ->setDescription($certificatePolicy['Description'])
            ->setCpsUrl($certificatePolicy['cpsUrl'])
            ;
    }
    
    private function certificateSerialization(array $certificate): Certificate {
                
         $basicSignature = $this->basicSignatureSerialization($certificate['BasicSignature']);
                
         $digestAlgoAndValue = $this->digestAlgoAndValueSerialization($certificate['DigestAlgoAndValue']);
                         
         $certificateDTO = (new Certificate())
                ->setId($certificate['Id'])
                ->setSerialNumber($certificate['SerialNumber'])
                ->setSubjectSerialNumber($certificate['SubjectSerialNumber'])
                ->setCommonName($certificate['CommonName'])
                ->setLocality($certificate['Locality'])
                ->setState($certificate['State'])
                ->setCountryName($certificate['CountryName'])
                ->setOrganizationIdentifier($certificate['OrganizationIdentifier'])
                ->setOrganizationName($certificate['OrganizationName'])
                ->setOrganizationalUnit($certificate['OrganizationalUnit'])
                ->setTitle($certificate['Title'])
                ->setGivenName($certificate['GivenName'])
                ->setSurname($certificate['Surname'])
                ->setPseudonym($certificate['Pseudonym'])
                ->setEmail($certificate['Email'])
                ->setSubjectAlternativeName($certificate['subjectAlternativeName'])
                ->setAiaUrl($certificate['aiaUrl'])
                ->setCrlUrl($certificate['crlUrl'])
                ->setOcspServerUrl($certificate['ocspServerUrl'])
                ->setSource($certificate['Source'])
                ->setNotAfter(Carbon::parse($certificate['NotAfter']))
                ->setNotBefore(Carbon::parse($certificate['NotAfter']))
                ->setPublicKeySize($certificate['PublicKeySize'])
                ->setPublicKeyEncryptionAlgo($certificate['PublicKeyEncryptionAlgo'])
                ->setEntityKey($certificate['EntityKey'])
                ->setKeyUsage($certificate['KeyUsage'])
                ->setIdPkixOcspNoCheck($certificate['IdPkixOcspNoCheck'])
                ->setBasicSignature($basicSignature)
                ->setTrusted($certificate['Trusted'])
                ->setSelfSigned($certificate['SelfSigned'])
                ->setTrustedServiceProvider($certificate['TrustedServiceProvider'])
                ->setCertificateRevocation($certificate['CertificateRevocation'])
                ->setBase64Encoded($certificate['Base64Encoded'])
                ->setDigestAlgoAndValue($digestAlgoAndValue)
                ;
                
            $certificatePolicies = $certificate['certificatePolicy'];
            
            if(!is_null($certificatePolicies)){ 
                foreach ($certificatePolicies as $certificatePolicy) {
                    $certificatePolicyDTO = $this->diagnosticDataCertificatePolicySerialization($certificatePolicy);
                    $certificateDTO->appendCertificatePolicy($certificatePolicyDTO);
                }
            }
                
            $extendedKeyUsagesOids = $certificate['extendedKeyUsagesOid'];
            
            if(!is_null($extendedKeyUsagesOids)){ 
                foreach ($extendedKeyUsagesOids as $extendedKeyUsagesOid) {
                    $extendedKeyUsagesOidDTO = $this->extendedKeyUsagesOidSerialization($extendedKeyUsagesOid);
                    $certificateDTO->appendExtendedKeyUsagesOid($extendedKeyUsagesOidDTO);
                }
            }
            
            $chainItems = $certificate['ChainItem'];
            
            if(!is_null($chainItems)){ 
                foreach ($chainItems as $chainItem) {
                    $chainItemDTO = $this->diagnosticDataCertificateChainItemSerialization($chainItem);
                    $certificateDTO->appendChainItem($chainItemDTO);
                }
            }
                
            $signingCertificate = $certificate['SigningCertificate'];
            
            if(!is_null($signingCertificate)){
                $signingCertificateDTO = $this->signingCertificateSerialization($signingCertificate);
                $certificateDTO->setSigningCertificate($signingCertificateDTO);
            }
            
            $qcStatements = $certificate['QcStatements'];
            
            if(!is_null($qcStatements)){
                $qcStatementsDTO = $this->qcStatementsSerialization($qcStatements);
                $certificateDTO->setQcStatements($qcStatementsDTO);
            }
            
            $subjectDistinguishedNames = $certificate['SubjectDistinguishedName'];
            
            if(!is_null($subjectDistinguishedNames)){
                foreach($subjectDistinguishedNames as $subjectDistinguishedName){   
                    $subjectDistinguishedName = $this->subjectDistinguishedNameSerialization($subjectDistinguishedName);
                    $certificateDTO->appendSubjectDistinguishedName($subjectDistinguishedName);
                }
            }
            
            $issuerDistinguishedNames = $certificate['IssuerDistinguishedName'];
            
            if(!is_null($issuerDistinguishedNames)){
                foreach($issuerDistinguishedNames as $issuerDistinguishedName){
                    
                    $issuerDistinguishedName = $this->issuerDistinguishedNameSerialization($issuerDistinguishedName);                    
                    $certificateDTO->appendIssuerDistinguishedName($issuerDistinguishedName);
                }
            }
                
            return $certificateDTO;
    }

    private function diagnosticDataRevocationBasicSignatureSerialization(array $basicSignature): DiagnosticDataRevocationBasicSignature {
        
        return (new DiagnosticDataRevocationBasicSignature())
            ->setEncryptionAlgoUsedToSignThisToken($basicSignature['EncryptionAlgoUsedToSignThisToken'])
            ->setKeyLengthUsedToSignThisToken($basicSignature['KeyLengthUsedToSignThisToken'])
            ->setDigestAlgoUsedToSignThisToken($basicSignature['DigestAlgoUsedToSignThisToken'])
            ->setMaskGenerationFunctionUsedToSignThisToken($basicSignature['MaskGenerationFunctionUsedToSignThisToken'])
            ->setSignatureIntact($basicSignature['SignatureIntact'])
            ->setSignatureValid($basicSignature['SignatureValid'])
            ;
    }
    
    private function diagnosticDataRevocationSigningCertificateSerialization(array $signingCertificate): DiagnosticDataRevocationSigningCertificate {
        
        return (new DiagnosticDataRevocationSigningCertificate())
            ->setPublicKey($signingCertificate['PublicKey'])
            ->setCertificate($signingCertificate['Certificate'])
            ;
    }
    
    private function diagnosticDataRevocationChainItemSerialization(array $chainItem): DiagnosticDataRevocationChainItem {
        
        return (new DiagnosticDataRevocationChainItem())
            ->setCertificate($chainItem['Certificate'])
            ;
    }
    
    private function diagnosticDataRevocationFoundCertificatesRelatedCertificateCertificateRefDigestAlgoAndValueSerialization(array $digestAlgoAndValue): DiagnosticDataRevocationFoundCertificatesRelatedCertificateCertificateRefDigestAlgoAndValue {
             
         return (new DiagnosticDataRevocationFoundCertificatesRelatedCertificateCertificateRefDigestAlgoAndValue())
             ->setDigestMethod($digestAlgoAndValue['DigestMethod'])
             ->setDigestValue($digestAlgoAndValue['DigestValue'])
             ->setMatch($digestAlgoAndValue['match'])
             ;
    }
    
    private function diagnosticDataRevocationFoundCertificatesRelatedCertificateCertificateRefSerialInfoSerialization(array $serialInfo): DiagnosticDataRevocationFoundCertificatesRelatedCertificateCertificateRefSerialInfo {
        
        return (new DiagnosticDataRevocationFoundCertificatesRelatedCertificateCertificateRefSerialInfo())
            ->setIssuerName($serialInfo['IssuerName'])
            ->setSerialNumber($serialInfo['SerialNumber'])
            ->setSki($serialInfo['Ski'])
            ->setCurrent($serialInfo['Current'])
            ;
    }
    
    private function diagnosticDataRevocationFoundCertificatesRelatedCertificateCertificateRefSerialization(array $certificateRef): DiagnosticDataRevocationFoundCertificatesRelatedCertificateCertificateRef {
        
        $certificateRefDTO = (new DiagnosticDataRevocationFoundCertificatesRelatedCertificateCertificateRef())
            ->setOrigin($certificateRef['Origin'])
            ->setIssuerSerial($certificateRef['IssuerSerial'])
            ;
            
        $digestAlgoAndValue = $certificateRef['DigestAlgoAndValue'];
        
        if(!is_null($digestAlgoAndValue)){
            $digestAlgoAndValueDTO = $this->diagnosticDataRevocationFoundCertificatesRelatedCertificateCertificateRefDigestAlgoAndValueSerialization($digestAlgoAndValue);
            $certificateRefDTO->setDigestAlgoAndValue($digestAlgoAndValueDTO);
        }
        
        $serialInfo = $certificateRef['SerialInfo'];
        
        if(!is_null($serialInfo)){
            $serialInfoDTO = $this->diagnosticDataRevocationFoundCertificatesRelatedCertificateCertificateRefSerialInfoSerialization($serialInfo);
            $certificateRefDTO->setSerialInfo($serialInfoDTO);
        }
            
        return $certificateRefDTO;
    }
    
    private function diagnosticDataRevocationFoundCertificatesRelatedCertificateSerialization(array $relatedCertificate): DiagnosticDataRevocationFoundCertificatesRelatedCertificate {
        
        $relatedCertificateDTO = (new DiagnosticDataRevocationFoundCertificatesRelatedCertificate())
            ->setOrigin($relatedCertificate['Origin'])
            ->setCertificate($relatedCertificate['Certificate'])
            ;
            
        $certificateRefs = $relatedCertificate['CertificateRef'];
        
        if(!is_null($certificateRefs)){
            foreach ($certificateRefs as $certificateRef) {
                $certificateRefDTO = $this->diagnosticDataRevocationFoundCertificatesRelatedCertificateCertificateRefSerialization($certificateRef);
                $relatedCertificateDTO->appendCertificateRef($certificateRefDTO);
            }
        }
            
        return $relatedCertificateDTO;   
    }
    
    private function diagnosticDataRevocationFoundCertificatesSerialization(array $foundCertificates): DiagnosticDataRevocationFoundCertificates {
        
        $foundCertificatesDTO = (new DiagnosticDataRevocationFoundCertificates());
        
        $relatedCertificates = $foundCertificates['RelatedCertificate'];
        
        if(!is_null($relatedCertificates)){
            foreach ($relatedCertificates as $relatedCertificate) {
                $relatedCertificateDTO = $this->diagnosticDataRevocationFoundCertificatesRelatedCertificateSerialization($relatedCertificate);
                $foundCertificatesDTO->appendRelatedCertificate($relatedCertificateDTO);
            }
        }
        
        $foundCertificatesDTO->setOrphanCertificates($foundCertificates['OrphanCertificate']);
        
        return $foundCertificatesDTO;
    }
    
    private function diagnosticDataRevocationDigestAlgoAndValueSerialization(array $digestAlgoAndValue): DiagnosticDataRevocationDigestAlgoAndValue {
             
         return (new DiagnosticDataRevocationDigestAlgoAndValue())
             ->setDigestMethod($digestAlgoAndValue['DigestMethod'])
             ->setDigestValue($digestAlgoAndValue['DigestValue'])
             ->setMatch($digestAlgoAndValue['match'])
             ;
    }

    private function diagnosticDataRevocationSerialization(array $revocation): DiagnosticDataRevocation {
        
        $revocationDTO = (new DiagnosticDataRevocation())
            ->setId($revocation['Id'])
            ->setOrigin($revocation['Origin'])
            ->setType($revocation['Type'])
            ->setSourceAddress($revocation['SourceAddress'])
            ->setProductionDate(Carbon::parse($revocation['ProductionDate']))
            ->setThisUpdate(Carbon::parse($revocation['ThisUpdate']))
            ->setNextUpdate(Carbon::parse($revocation['NextUpdate']))
            ->setExpiredCertsOnCRL($revocation['ExpiredCertsOnCRL'])
            ->setArchiveCutOff($revocation['ArchiveCutOff'])
            ->setCertHashExtensionPresent($revocation['CertHashExtensionPresent'])
            ->setCertHashExtensionMatch($revocation['CertHashExtensionMatch'])
            ->setBase64Encoded($revocation['Base64Encoded'])
            ;
        
        $basicSignature = $revocation['BasicSignature'];
        
        if(!is_null($basicSignature)){
            $basicSignatureDTO = $this->diagnosticDataRevocationBasicSignatureSerialization($basicSignature);
            $revocationDTO->setBasicSignature($basicSignatureDTO);
        }
        
        $signingCertificate = $revocation['SigningCertificate'];
        
        if(!is_null($signingCertificate)){
            $signingCertificateDTO = $this->diagnosticDataRevocationSigningCertificateSerialization($signingCertificate);
            $revocationDTO->setSigningCertificate($signingCertificateDTO);
        }
        
        $chainItems = $revocation['ChainItem'];
        
        if(!is_null($chainItems)){
            foreach ($chainItems as $chainItem) {
                $chainItemDTO = $this->diagnosticDataRevocationChainItemSerialization($chainItem);
                $revocationDTO->appendChainItem($chainItemDTO);
            }
        }
        
        $foundCertificates = $revocation['FoundCertificates'];
        
        if(!is_null($foundCertificates)){
            $foundCertificatesDTO = $this->diagnosticDataRevocationFoundCertificatesSerialization($foundCertificates);
            $revocationDTO->setFoundCertificates($foundCertificatesDTO);
        }
        
        $digestAlgoAndValue = $revocation['DigestAlgoAndValue'];
        
        if(!is_null($digestAlgoAndValue)){
            $digestAlgoAndValueDTO = $this->diagnosticDataRevocationDigestAlgoAndValueSerialization($digestAlgoAndValue);
            $revocationDTO->setDigestAlgoAndValue($digestAlgoAndValueDTO);
        }
        
        return $revocationDTO;
    }
    
    private function diagnosticDataTrustedListSerialization(array $trustedList): DiagnosticDataTrustedList {
        
        return (new DiagnosticDataTrustedList())
            ->setId($trustedList['Id'])
            ->setCountryCode($trustedList['CountryCode'])
            ->setUrl($trustedList['Url'])
            ->setSequenceNumber($trustedList['SequenceNumber'])
            ->setVersion($trustedList['Version'])
            ->setLastLoading(Carbon::parse($trustedList['LastLoading']))
            ->setIssueDate(Carbon::parse($trustedList['IssueDate']))
            ->setNextUpdate(Carbon::parse($trustedList['NextUpdate']))
            ->setWellSigned($trustedList['WellSigned'])
            ->setLOTL($trustedList['LOTL'])
            ;
    }
    
    private function diagnosticDataSerialization(array $diagnosticData): DiagnosticData {
        
        $diagnosticDataDTO =  (new DiagnosticData())
            ->setDocumentName($diagnosticData['DocumentName'])
            ->setValidationDate(Carbon::parse($diagnosticData['ValidationDate']))
            ->setContainerInfo($diagnosticData['ContainerInfo'])
            ->setSignature($diagnosticData['Signature'])
            ->setTimestamp($diagnosticData['Timestamp'])
            ->setOrphanTokens($diagnosticData['OrphanTokens'])
            ->setSignerData($diagnosticData['SignerData'])
            //->setTrustedList($diagnosticData['TrustedList'])
            ;
            
        $revocations = $diagnosticData['Revocation'];
        
        if(!is_null($revocations)){   
            foreach($revocations as $revocation){       
                $revocationDTO = $this->diagnosticDataRevocationSerialization($revocation);
                $diagnosticDataDTO->appendRevocation($revocationDTO);
            }
        }
        
        $certificates = $diagnosticData['Certificate'];
        
        if(!is_null($certificates)){  
            foreach($certificates as $certificate){       
                $certificateDTO = $this->certificateSerialization($certificate);
                $diagnosticDataDTO->appendCertificate($certificateDTO);
            }
        }
        
        $trustedLists = $diagnosticData['TrustedList'];
        
        if(!is_null($trustedLists)){  
            foreach($trustedLists as $trustedList){       
                $trustedListDTO = $this->diagnosticDataTrustedListSerialization($trustedList);
                $diagnosticDataDTO->appendTrustedList($trustedListDTO);
            }
        }
        
        return $diagnosticDataDTO;   
    }
}  