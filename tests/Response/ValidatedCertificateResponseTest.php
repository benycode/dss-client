<?php

declare(strict_types=1);

namespace DSS\Tests;

use GuzzleHttp\Psr7\Response;

use DSS\Tests\Resource;
use DSS\HttpClient\Response\ValidatedCertificateResponse;
use DSS\HttpClient\Response\ValidatedResponse\DTO\DiagnosticData\Revocation as DiagnosticDataRevocation;
use DSS\HttpClient\Response\ValidatedResponse\DTO\DiagnosticData\Revocation\SigningCertificate as DiagnosticDataRevocationSigningCertificate;
use DSS\HttpClient\Response\ValidatedResponse\DTO\DiagnosticData\Revocation\ChainItem as DiagnosticDataRevocationChainItem;
use DSS\HttpClient\Response\ValidatedResponse\DTO\DiagnosticData\Revocation\FoundCertificates as DiagnosticDataRevocationFoundCertificates;
use DSS\HttpClient\Response\ValidatedResponse\DTO\DiagnosticData\Revocation\FoundCertificates\RelatedCertificate as DiagnosticDataRevocationFoundCertificatesRelatedCertificate;
use DSS\HttpClient\Response\ValidatedResponse\DTO\DiagnosticData\Revocation\FoundCertificates\RelatedCertificate\CertificateRef as DiagnosticDataRevocationFoundCertificatesRelatedCertificateCertificateRef;
use DSS\HttpClient\Response\ValidatedResponse\DTO\DiagnosticData\Revocation\FoundCertificates\RelatedCertificate\CertificateRef\SerialInfo as DiagnosticDataRevocationFoundCertificatesRelatedCertificateCertificateRefSerialInfo;
use DSS\HttpClient\Response\ValidatedResponse\DTO\DiagnosticData\Revocation\DigestAlgoAndValue as DiagnosticDataRevocationDigestAlgoAndValue;
use DSS\HttpClient\Response\ValidatedResponse\DTO\DiagnosticData\TrustedList;
use DSS\HttpClient\Response\ValidatedResponse\DTO\DiagnosticData\Certificate;
use DSS\HttpClient\Response\ValidatedResponse\DTO\DiagnosticData\Certificate\BasicSignature;
use DSS\HttpClient\Response\ValidatedResponse\DTO\DiagnosticData\Certificate\DigestAlgoAndValue;
use DSS\HttpClient\Response\ValidatedResponse\DTO\DiagnosticData\Certificate\ExtendedKeyUsagesOid;
use DSS\HttpClient\Response\ValidatedResponse\DTO\DiagnosticData\Certificate\SigningCertificate;
use DSS\HttpClient\Response\ValidatedResponse\DTO\DiagnosticData\Certificate\ChainItem as DiagnosticDataCertificateChainItem;
use DSS\HttpClient\Response\ValidatedResponse\DTO\DiagnosticData\Certificate\CertificatePolicy as DiagnosticDataCertificateCertificatePolicy;
use DSS\HttpClient\Response\ValidatedResponse\DTO\SimpleCertificateReport;
use DSS\HttpClient\Response\ValidatedResponse\DTO\SimpleCertificateReport\ChainItem;
use DSS\HttpClient\Response\ValidatedResponse\DTO\SimpleCertificateReport\ChainItem\Subject;
use DSS\HttpClient\Response\ValidatedResponse\DTO\SimpleCertificateReport\ChainItem\Revocation;
use DSS\HttpClient\Response\ValidatedResponse\DTO\DetailedReport\SignatureOrTimestampOrCertificate;
use DSS\HttpClient\Response\ValidatedResponse\DTO\DetailedReport\SignatureOrTimestampOrCertificate\Certificate\Constraint;
use DSS\HttpClient\Response\ValidatedResponse\DTO\DetailedReport\SignatureOrTimestampOrCertificate\Certificate\Constraint\Name as DetailedReportCertificateConstraintName;
use DSS\HttpClient\Response\ValidatedResponse\DTO\DetailedReport\SignatureOrTimestampOrCertificate\Certificate\Constraint\Warning as DetailedReportCertificateConstraintWarning;
use DSS\HttpClient\Response\ValidatedResponse\DTO\DetailedReport\SignatureOrTimestampOrCertificate\Certificate\Conclusion;
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
use PHPUnit\Framework\TestCase;
use Carbon\Carbon;


final class ValidatedCertificateResponseTest extends TestCase
{
    /*public function testResponse(): void
    {    
		$string = Resource::get('CertificateValidationResponse/fakeCertificate.json');
		
		$response = new Response(200, ['Content-Type' => 'application/json'], $string);
		
		$validatedCertificateResponse = (new ValidatedCertificateResponse($response))
			->toDTO()
			;
	    
        // DiagnosticData
        $diagnosticData = $validatedCertificateResponse->getDiagnosticData();
    
		$this->assertEquals(null, $diagnosticData->getDocumentName());
		$this->assertInstanceOf(Carbon::class, $diagnosticData->getValidationDate());
		$this->assertEquals(null, $diagnosticData->getContainerInfo());
		$this->assertEquals(null, $diagnosticData->getSignature());
		$this->assertEquals([], $diagnosticData->getRevocation());
		$this->assertEquals(null, $diagnosticData->getTimestamp());
		$this->assertEquals(null, $diagnosticData->getOrphanTokens());
		$this->assertEquals(null, $diagnosticData->getSignerData());
		$this->assertEquals([], $diagnosticData->getTrustedList());
		
		// DiagnosticData -> Certificate
		list($firstCertificate) = $diagnosticData->getCertificate();	
		$this->assertInstanceOf(Certificate::class, $firstCertificate);
        $this->assertEquals('C-02F3EBCA0163274253BC809D27498DD41BB0316D7E6B066960115DE155589D9C', $firstCertificate->getId());
        
        // DiagnosticData -> Certificate -> GetSubjectDistinguishedName
        list($firstSubjectDistinguishedName, $secondSubjectDistinguishedName) = $firstCertificate->GetSubjectDistinguishedName();
        
        $this->assertEquals('o=dss-test,cn=signerfake', $firstSubjectDistinguishedName->getValue());
        $this->assertEquals('CANONICAL', $firstSubjectDistinguishedName->getFormat());
        
        $this->assertEquals('O=DSS-test,CN=SignerFake', $secondSubjectDistinguishedName->getValue());
        $this->assertEquals('RFC2253', $secondSubjectDistinguishedName->getFormat());
        
        // DiagnosticData -> Certificate -> GetIssuerDistinguishedName
        list($firstIssuerDistinguishedName, $secondIssuerDistinguishedName) = $firstCertificate->GetIssuerDistinguishedName();
        
        $this->assertEquals('o=dss-test,cn=rootselfsignedfake', $firstIssuerDistinguishedName->getValue());
        $this->assertEquals('CANONICAL', $firstIssuerDistinguishedName->getFormat());
        
        $this->assertEquals('O=DSS-test,CN=RootSelfSignedFake', $secondIssuerDistinguishedName->getValue());
        $this->assertEquals('RFC2253', $secondIssuerDistinguishedName->getFormat());
        
        // DiagnosticData -> Certificate
        $this->assertEquals(51497007561559, $firstCertificate->GetSerialNumber());
        $this->assertEquals(null, $firstCertificate->GetSubjectSerialNumber());
        $this->assertEquals('SignerFake', $firstCertificate->GetCommonName());
        $this->assertEquals(null, $firstCertificate->GetState());
        $this->assertEquals(null, $firstCertificate->GetLocality());
        $this->assertEquals(null, $firstCertificate->GetCountryName());
        $this->assertEquals(null, $firstCertificate->GetOrganizationIdentifier());
        $this->assertEquals('DSS-test', $firstCertificate->GetOrganizationName());
        $this->assertEquals(null, $firstCertificate->GetOrganizationalUnit());
        $this->assertEquals(null, $firstCertificate->GetTitle());
        $this->assertEquals(null, $firstCertificate->GetGivenName());
        $this->assertEquals(null, $firstCertificate->GetSurname());
        $this->assertEquals(null, $firstCertificate->GetPseudonym());
        $this->assertEquals(null, $firstCertificate->GetEmail());
        $this->assertEquals(null, $firstCertificate->GetSubjectAlternativeName());
        $this->assertEquals([], $firstCertificate->GetAiaUrl());
        $this->assertEquals([], $firstCertificate->GetCrlUrl());
        $this->assertEquals([], $firstCertificate->GetOcspServerUrl());
        $this->assertEquals(['OTHER'], $firstCertificate->GetSource());
        $this->assertInstanceOf(Carbon::class, $firstCertificate->GetNotAfter());
        $this->assertInstanceOf(Carbon::class, $firstCertificate->GetNotBefore());
        $this->assertEquals(2048, $firstCertificate->GetPublicKeySize());
        $this->assertEquals('RSA', $firstCertificate->GetPublicKeyEncryptionAlgo());
        $this->assertEquals('PK-3CFCA257859E202BCC83864D02B267B08A997C357AB98D923BBC63F00607C7B6', $firstCertificate->GetEntityKey());
        $this->assertEquals(['keyCertSign', 'crlSign'], $firstCertificate->GetKeyUsage());
        $this->assertEquals([], $firstCertificate->GetExtendedKeyUsagesOid());
        $this->assertEquals([], $firstCertificate->GetExtendedKeyUsagesOid());
        $this->assertEquals(false, $firstCertificate->GetIdPkixOcspNoCheck());
        
        // DiagnosticData -> Certificate -> BasicSignature    
        $basicSignature = $firstCertificate->GetBasicSignature();
        
        $this->assertInstanceOf(BasicSignature::class, $basicSignature);
        $this->assertEquals('RSA', $basicSignature->getEncryptionAlgoUsedToSignThisToken());
        $this->assertEquals('?', $basicSignature->getKeyLengthUsedToSignThisToken());
        $this->assertEquals('SHA256', $basicSignature->getDigestAlgoUsedToSignThisToken());
        $this->assertEquals(null, $basicSignature->getMaskGenerationFunctionUsedToSignThisToken());
        $this->assertEquals(null, $basicSignature->getSignatureIntact());
        $this->assertEquals(null, $basicSignature->getSignatureValid());
        
        // DiagnosticData -> Certificate
        $this->assertEquals(null, $firstCertificate->getSigningCertificate());
        $this->assertEquals([], $firstCertificate->getChainItem());
        $this->assertEquals(false, $firstCertificate->getTrusted());
        $this->assertEquals(false, $firstCertificate->getSelfSigned());
        $this->assertEquals([], $firstCertificate->getCertificatePolicy());
        $this->assertEquals(null, $firstCertificate->getQcStatements());
        $this->assertEquals([], $firstCertificate->getTrustedServiceProvider());
        $this->assertEquals([], $firstCertificate->getCertificateRevocation());
        $this->assertEquals(null, $firstCertificate->getBase64Encoded());
        
        // DiagnosticData -> Certificate -> DigestAlgoAndValue
        $digestAlgoAndValue = $firstCertificate->getDigestAlgoAndValue();
          
        $this->assertInstanceOf(DigestAlgoAndValue::class, $digestAlgoAndValue);     
        $this->assertEquals('SHA256', $digestAlgoAndValue->getDigestMethod());
        $this->assertEquals('AvPrygFjJ0JTvICdJ0mN1BuwMW1+awZpYBFd4VVYnZw=', $digestAlgoAndValue->getDigestValue());
        $this->assertEquals(null, $digestAlgoAndValue->getMatch());
        
        // DiagnosticData
        $this->assertEquals([], $diagnosticData->getRevocation());
        $this->assertEquals(null, $diagnosticData->getTimestamp());
        $this->assertEquals(null, $diagnosticData->getOrphanTokens());
        $this->assertEquals(null, $diagnosticData->getSignerData());
        $this->assertEquals([], $diagnosticData->getTrustedList());
        
        // SimpleCertificateReport
        $simpleCertificateReport = $validatedCertificateResponse->getSimpleCertificateReport();
        
        $this->assertInstanceOf(SimpleCertificateReport::class, $simpleCertificateReport);
        
        // SimpleCertificateReport -> ChainItem
        list($firstChainItem) = $simpleCertificateReport->getChainItem();
        
        $this->assertInstanceOf(ChainItem::class, $firstChainItem);
        $this->assertEquals('C-02F3EBCA0163274253BC809D27498DD41BB0316D7E6B066960115DE155589D9C', $firstChainItem->getId());
        
        // SimpleCertificateReport -> ChainItem -> subject
        $subject = $firstChainItem->getSubject();
        
        $this->assertInstanceOf(Subject::class, $subject);
        $this->assertEquals('SignerFake', $subject->getCommonName());
        $this->assertEquals(null, $subject->getSurname());
        $this->assertEquals(null, $subject->getGivenName());
        $this->assertEquals(null, $subject->getPseudonym());
        $this->assertEquals('DSS-test', $subject->getOrganizationName());
        $this->assertEquals(null, $subject->getOrganizationUnit());
        $this->assertEquals(null, $subject->getEmail());
        $this->assertEquals(null, $subject->getLocality());
        $this->assertEquals(null, $subject->getState());
        $this->assertEquals(null, $subject->getCountry());
        
        // SimpleCertificateReport -> ChainItem
        
        $this->assertEquals(null, $firstChainItem->getIssuerId());
        $this->assertInstanceOf(Carbon::class, $firstChainItem->getNotBefore());
        $this->assertInstanceOf(Carbon::class, $firstChainItem->getNotAfter());
        $this->assertEquals(['keyCertSign', 'crlSign'], $firstChainItem->getKeyUsage());
        $this->assertEquals(null, $firstChainItem->getExtendedKeyUsage());
        $this->assertEquals(null, $firstChainItem->getOcspUrl());
        $this->assertEquals(null, $firstChainItem->getCrlUrl());
        $this->assertEquals(null, $firstChainItem->getAiaUrl());
        $this->assertEquals(null, $firstChainItem->getCpsUrl());
        $this->assertEquals(null, $firstChainItem->getPdsUrl());
        $this->assertEquals('N/A', $firstChainItem->getQualificationAtIssuance());
        $this->assertEquals('N/A', $firstChainItem->getQualificationAtValidation());
        
        // SimpleCertificateReport -> ChainItem -> revocation
        $revocation = $firstChainItem->getRevocation();
        
        $this->assertInstanceOf(Revocation::class, $revocation);
        $this->assertEquals(null, $revocation->getProductionDate());
        $this->assertEquals(null, $revocation->getRevocationDate());
        $this->assertEquals(null, $revocation->getRevocationReason());
        
        // SimpleCertificateReport -> ChainItem
        $this->assertEquals(null, $firstChainItem->getTrustAnchor());
        $this->assertEquals('INDETERMINATE', $firstChainItem->getIndication());
        $this->assertEquals('NO_CERTIFICATE_CHAIN_FOUND', $firstChainItem->getSubIndication());
        
        // SimpleCertificateReport
        $this->assertInstanceOf(Carbon::class, $simpleCertificateReport->getValidationTime());
        
        // detailedReport
        $detailedReport = $validatedCertificateResponse->getDetailedReport();
        
        // detailedReport -> signatureOrTimestampOrCertificate
        $signatureOrTimestampOrCertificate = $detailedReport->getSignatureOrTimestampOrCertificate();
        $this->assertInstanceOf(SignatureOrTimestampOrCertificate::class, $signatureOrTimestampOrCertificate);
        
        // detailedReport -> signatureOrTimestampOrCertificate -> Certificate
        list($firstCertificate) = $signatureOrTimestampOrCertificate->getCertificate();
        
        // detailedReport -> signatureOrTimestampOrCertificate -> Certificate
        $this->assertEquals([], $firstCertificate->getValidationCertificateQualification());
        
        // detailedReport -> signatureOrTimestampOrCertificate -> Certificate -> Constraint
        list($firstConstraint) = $firstCertificate->getConstraint();
        $this->assertInstanceOf(Constraint::class, $firstConstraint);
        
        // detailedReport -> signatureOrTimestampOrCertificate -> Certificate -> Constraint -> Name
        $name = $firstConstraint->getName();
        
        $this->assertInstanceOf(DetailedReportCertificateConstraintName::class, $name);
        $this->assertEquals('Is the result of the Basic Building Block conclusive?', $name->getValue());
        $this->assertEquals('BBB_ACCEPT', $name->getKey());
        
        // detailedReport -> signatureOrTimestampOrCertificate -> Certificate -> Constraint
        $this->assertEquals('WARNING', $firstConstraint->getStatus());
        $this->assertEquals(null, $firstConstraint->getError());
        
        // detailedReport -> signatureOrTimestampOrCertificate -> Certificate -> Constraint -> Warning
        $warning = $firstConstraint->getWarning();
        
        $this->assertInstanceOf(DetailedReportCertificateConstraintWarning::class, $warning);
        $this->assertEquals('The result of the Basic Building Block is not conclusive!', $warning->getValue());
        $this->assertEquals('BBB_ACCEPT_ANS', $warning->getKey());
        
        // detailedReport -> signatureOrTimestampOrCertificate -> Certificate -> Constraint
        $this->assertEquals(null, $firstConstraint->getInfo());
        $this->assertEquals(null, $firstConstraint->getAdditionalInfo());
        $this->assertEquals(null, $firstConstraint->getId());
        $this->assertEquals(null, $firstConstraint->getBlockType());
        
        // detailedReport -> signatureOrTimestampOrCertificate -> Certificate -> Conclusion
        $conclusion = $firstCertificate->getConclusion();
        
        $this->assertInstanceOf(Conclusion::class, $conclusion);
        $this->assertEquals('INDETERMINATE', $conclusion->getIndication());
        $this->assertEquals(null, $conclusion->getSubIndication());
        $this->assertEquals([], $conclusion->getErrors());
        
        // detailedReport -> signatureOrTimestampOrCertificate -> Certificate -> Conclusion -> Warnings
        list($firstWarning) = $conclusion->getWarnings();
        
        $this->assertInstanceOf(DetailedReportCertificateConclusionWarning::class, $firstWarning);
        $this->assertEquals('The result of the Basic Building Block is not conclusive!', $firstWarning->getValue());
        $this->assertEquals('BBB_ACCEPT_ANS', $firstWarning->getKey());
        
        // detailedReport -> signatureOrTimestampOrCertificate -> Certificate -> Conclusion
        $this->assertEquals(null, $conclusion->getInfos());
        
        // detailedReport -> signatureOrTimestampOrCertificate -> Certificate
        $this->assertEquals('Certificate Qualification', $firstCertificate->getTitle());
        $this->assertEquals('C-02F3EBCA0163274253BC809D27498DD41BB0316D7E6B066960115DE155589D9C', $firstCertificate->getId());
        
        // detailedReport -> BasicBuildingBlocks
        list($firstBasicBuildingBlock) = $detailedReport->getBasicBuildingBlocks();
        
        $this->assertInstanceOf(BasicBuildingBlock::class, $firstBasicBuildingBlock);
        $this->assertEquals(null, $firstBasicBuildingBlock->getFc());
        $this->assertEquals(null, $firstBasicBuildingBlock->getFc());
        $this->assertEquals(null, $firstBasicBuildingBlock->getIsc());
        $this->assertEquals(null, $firstBasicBuildingBlock->getVci());
        
        // detailedReport -> BasicBuildingBlocks -> XCV
        
        $xcv = $firstBasicBuildingBlock->getXcv();
        
        $this->assertInstanceOf(Xcv::class, $xcv);
        $this->assertEquals([], $xcv->getSubXCV());
        
        // detailedReport -> BasicBuildingBlocks -> XCV -> Constraint
        list($firstConstraint) = $xcv->getConstraint();
        
        $this->assertInstanceOf(XcvConstraint::class, $firstConstraint);
        
        // detailedReport -> BasicBuildingBlocks -> XCV -> Constraint -> Name  
        $name = $firstConstraint->getName();
        
        $this->assertInstanceOf(XcvConstraintName::class, $name);
        $this->assertEquals('Can the certificate chain be built till a trust anchor?', $name->getValue());
        $this->assertEquals('BBB_XCV_CCCBB', $name->getKey());
        
        // detailedReport -> BasicBuildingBlocks -> XCV -> Constraint
        $this->assertEquals('NOT OK', $firstConstraint->getStatus());
        
        // detailedReport -> BasicBuildingBlocks -> XCV -> Constraint -> Error  
        $error = $firstConstraint->getError();
        
        $this->assertInstanceOf(XcvConstraintError::class, $error);
        $this->assertEquals('The certificate chain is not trusted, it does not contain a trust anchor.', $error->getValue());
        $this->assertEquals('BBB_XCV_CCCBB_ANS', $error->getKey());
        
        // detailedReport -> BasicBuildingBlocks -> XCV -> Constraint
        $this->assertEquals(null, $firstConstraint->getWarning());
        $this->assertEquals(null, $firstConstraint->getInfo());
        $this->assertEquals(null, $firstConstraint->getAdditionalInfo());
        $this->assertEquals(null, $firstConstraint->getId());
        $this->assertEquals(null, $firstConstraint->getBlockType());
        
        // detailedReport -> BasicBuildingBlocks -> XCV -> Conclusion
        $conclusion = $xcv->getConclusion();
        
        $this->assertInstanceOf(XcvConclusion::class, $conclusion);
        $this->assertEquals('INDETERMINATE', $conclusion->getIndication());
        $this->assertEquals('NO_CERTIFICATE_CHAIN_FOUND', $conclusion->getSubIndication());
        
        // detailedReport -> BasicBuildingBlocks -> XCV -> Conclusion -> Errors
        list($firstError) = $conclusion->getErrors();
        
        $this->assertInstanceOf(XcvConclusionError::class, $firstError);
        $this->assertEquals('The certificate chain is not trusted, it does not contain a trust anchor.', $firstError->getValue());
        $this->assertEquals('BBB_XCV_CCCBB_ANS', $firstError->getKey());
        
        // detailedReport -> BasicBuildingBlocks -> XCV -> Conclusion
        $this->assertEquals([], $conclusion->getWarnings());
        $this->assertEquals([], $conclusion->getInfos());
        
        // detailedReport -> BasicBuildingBlocks -> XCV
        $this->assertEquals('X509 Certificate Validation', $xcv->getTitle());
        
        // detailedReport -> BasicBuildingBlocks
        $this->assertEquals(null, $firstBasicBuildingBlock->getCv());
        $this->assertEquals(null, $firstBasicBuildingBlock->getSav());
        $this->assertEquals(null, $firstBasicBuildingBlock->getPsv());
        $this->assertEquals(null, $firstBasicBuildingBlock->getPcv());
        $this->assertEquals(null, $firstBasicBuildingBlock->getVts());
        $this->assertEquals(null, $firstBasicBuildingBlock->getCertificateChain());
        
        // detailedReport -> BasicBuildingBlocks -> Conclusion
        $conclusion = $firstBasicBuildingBlock->getConclusion();
        
        $this->assertInstanceOf(BasicBuildingBlockConclusion::class, $conclusion);
        $this->assertEquals('INDETERMINATE', $conclusion->getIndication());
        $this->assertEquals('NO_CERTIFICATE_CHAIN_FOUND', $conclusion->getSubIndication());
        
        // detailedReport -> BasicBuildingBlocks-> Conclusion -> Errors
        list($firstError) = $conclusion->getErrors();
        
        $this->assertInstanceOf(BasicBuildingBlockConclusionError::class, $firstError);
        $this->assertEquals('The certificate chain is not trusted, it does not contain a trust anchor.', $firstError->getValue());
        $this->assertEquals('BBB_XCV_CCCBB_ANS', $firstError->getKey());
        
        // detailedReport -> BasicBuildingBlocks -> Conclusion
        $this->assertEquals([], $conclusion->getWarnings());
        $this->assertEquals([], $conclusion->getInfos());
        
        // detailedReport -> BasicBuildingBlocks
        $this->assertEquals('C-02F3EBCA0163274253BC809D27498DD41BB0316D7E6B066960115DE155589D9C', $firstBasicBuildingBlock->getId());
        $this->assertEquals('CERTIFICATE', $firstBasicBuildingBlock->getType());
        
        // detailedReport
        $this->assertEquals([], $detailedReport->getTLAnalysis());
        $this->assertEquals(null, $detailedReport->getSemantic());
        $this->assertEquals(null, $detailedReport->getValidationTime());
   
    }
    
    public function testResponse(): void
    {    
        $string = Resource::get('CertificateValidationResponse/randomEsetCertificate.json');
        
        $response = new Response(200, ['Content-Type' => 'application/json'], $string);
        
        $validatedCertificateResponse = (new ValidatedCertificateResponse($response))
            ->toDTO()
            ;
        
        // DiagnosticData
        $diagnosticData = $validatedCertificateResponse->getDiagnosticData();
    
        $this->assertEquals(null, $diagnosticData->getDocumentName());
        $this->assertInstanceOf(Carbon::class, $diagnosticData->getValidationDate());
        $this->assertEquals(null, $diagnosticData->getContainerInfo());
        $this->assertEquals(null, $diagnosticData->getSignature());
        $this->assertEquals([], $diagnosticData->getRevocation());
        $this->assertEquals(null, $diagnosticData->getTimestamp());
        $this->assertEquals(null, $diagnosticData->getOrphanTokens());
        $this->assertEquals(null, $diagnosticData->getSignerData());
        $this->assertEquals([], $diagnosticData->getTrustedList());
        
        // DiagnosticData -> Certificate
        list($firstCertificate) = $diagnosticData->getCertificate();    
        $this->assertInstanceOf(Certificate::class, $firstCertificate);
        $this->assertEquals('C-130E8A844934A8563663BF6A2E27AADE2E4418D17E0B5EDAF17EC06DB0E50A5A', $firstCertificate->getId());
        
        // DiagnosticData -> Certificate -> GetSubjectDistinguishedName
        list($firstSubjectDistinguishedName, $secondSubjectDistinguishedName) = $firstCertificate->GetSubjectDistinguishedName();
        
        $this->assertEquals('c=sk,o=eset\\, spol. s r. o.,cn=eset ssl filter ca', $firstSubjectDistinguishedName->getValue());
        $this->assertEquals('CANONICAL', $firstSubjectDistinguishedName->getFormat());
        
        $this->assertEquals('C=SK,O=ESET\\, spol. s r. o.,CN=ESET SSL Filter CA', $secondSubjectDistinguishedName->getValue());
        $this->assertEquals('RFC2253', $secondSubjectDistinguishedName->getFormat());
        
        // DiagnosticData -> Certificate -> GetIssuerDistinguishedName
        list($firstIssuerDistinguishedName, $secondIssuerDistinguishedName) = $firstCertificate->GetIssuerDistinguishedName();
        
        $this->assertEquals('c=sk,o=eset\\, spol. s r. o.,cn=eset ssl filter ca', $firstIssuerDistinguishedName->getValue());
        $this->assertEquals('CANONICAL', $firstIssuerDistinguishedName->getFormat());
        
        $this->assertEquals('C=SK,O=ESET\\, spol. s r. o.,CN=ESET SSL Filter CA', $secondIssuerDistinguishedName->getValue());
        $this->assertEquals('RFC2253', $secondIssuerDistinguishedName->getFormat());
        
        // DiagnosticData -> Certificate
        $this->assertEquals('66047738372942723461930335409922617671', $firstCertificate->GetSerialNumber());
        $this->assertEquals(null, $firstCertificate->GetSubjectSerialNumber());
        $this->assertEquals('ESET SSL Filter CA', $firstCertificate->GetCommonName());
        $this->assertEquals(null, $firstCertificate->GetState());
        $this->assertEquals(null, $firstCertificate->GetLocality());
        $this->assertEquals('SK', $firstCertificate->GetCountryName());
        $this->assertEquals(null, $firstCertificate->GetOrganizationIdentifier());
        $this->assertEquals('ESET, spol. s r. o.', $firstCertificate->GetOrganizationName());
        $this->assertEquals(null, $firstCertificate->GetOrganizationalUnit());
        $this->assertEquals(null, $firstCertificate->GetTitle());
        $this->assertEquals(null, $firstCertificate->GetGivenName());
        $this->assertEquals(null, $firstCertificate->GetSurname());
        $this->assertEquals(null, $firstCertificate->GetPseudonym());
        $this->assertEquals(null, $firstCertificate->GetEmail());
        $this->assertEquals(null, $firstCertificate->GetSubjectAlternativeName());
        $this->assertEquals([], $firstCertificate->GetAiaUrl());
        $this->assertEquals([], $firstCertificate->GetCrlUrl());
        $this->assertEquals([], $firstCertificate->GetOcspServerUrl());
        $this->assertEquals(['UNKNOWN'], $firstCertificate->GetSource());
        $this->assertInstanceOf(Carbon::class, $firstCertificate->GetNotAfter());
        $this->assertInstanceOf(Carbon::class, $firstCertificate->GetNotBefore());
        $this->assertEquals(2048, $firstCertificate->GetPublicKeySize());
        $this->assertEquals('RSA', $firstCertificate->GetPublicKeyEncryptionAlgo());
        $this->assertEquals('PK-5EBF7200C170111ECA3C180F3BDC7545A447FD9EBED02C6FFA03809D2500B6A5', $firstCertificate->GetEntityKey());
        $this->assertEquals(['keyCertSign'], $firstCertificate->GetKeyUsage());
        $this->assertEquals([], $firstCertificate->GetExtendedKeyUsagesOid());
        $this->assertEquals([], $firstCertificate->GetExtendedKeyUsagesOid());
        $this->assertEquals(false, $firstCertificate->GetIdPkixOcspNoCheck());
        
        // DiagnosticData -> Certificate -> BasicSignature    
        $basicSignature = $firstCertificate->GetBasicSignature();
        
        $this->assertInstanceOf(BasicSignature::class, $basicSignature);
        $this->assertEquals('RSA', $basicSignature->getEncryptionAlgoUsedToSignThisToken());
        $this->assertEquals('2048', $basicSignature->getKeyLengthUsedToSignThisToken());
        $this->assertEquals('SHA256', $basicSignature->getDigestAlgoUsedToSignThisToken());
        $this->assertEquals(null, $basicSignature->getMaskGenerationFunctionUsedToSignThisToken());
        $this->assertEquals(true, $basicSignature->getSignatureIntact());
        $this->assertEquals(true, $basicSignature->getSignatureValid());
        
        // DiagnosticData -> Certificate
        $this->assertEquals(null, $firstCertificate->getSigningCertificate());
        $this->assertEquals([], $firstCertificate->getChainItem());
        $this->assertEquals(false, $firstCertificate->getTrusted());
        $this->assertEquals(true, $firstCertificate->getSelfSigned());
        $this->assertEquals([], $firstCertificate->getCertificatePolicy());
        $this->assertEquals(null, $firstCertificate->getQcStatements());
        $this->assertEquals([], $firstCertificate->getTrustedServiceProvider());
        $this->assertEquals([], $firstCertificate->getCertificateRevocation());
        $this->assertEquals(null, $firstCertificate->getBase64Encoded());
        
        // DiagnosticData -> Certificate -> DigestAlgoAndValue
        $digestAlgoAndValue = $firstCertificate->getDigestAlgoAndValue();
          
        $this->assertInstanceOf(DigestAlgoAndValue::class, $digestAlgoAndValue);     
        $this->assertEquals('SHA256', $digestAlgoAndValue->getDigestMethod());
        $this->assertEquals('Ew6KhEk0qFY2Y79qLieq3i5EGNF+C17a8X7AbbDlClo=', $digestAlgoAndValue->getDigestValue());
        $this->assertEquals(null, $digestAlgoAndValue->getMatch());
        
        // DiagnosticData
        $this->assertEquals([], $diagnosticData->getRevocation());
        $this->assertEquals(null, $diagnosticData->getTimestamp());
        $this->assertEquals(null, $diagnosticData->getOrphanTokens());
        $this->assertEquals(null, $diagnosticData->getSignerData());
        $this->assertEquals([], $diagnosticData->getTrustedList());
        
        // SimpleCertificateReport
        $simpleCertificateReport = $validatedCertificateResponse->getSimpleCertificateReport();
        
        $this->assertInstanceOf(SimpleCertificateReport::class, $simpleCertificateReport);
        
        // SimpleCertificateReport -> ChainItem
        list($firstChainItem) = $simpleCertificateReport->getChainItem();
        
        $this->assertInstanceOf(ChainItem::class, $firstChainItem);
        $this->assertEquals('C-130E8A844934A8563663BF6A2E27AADE2E4418D17E0B5EDAF17EC06DB0E50A5A', $firstChainItem->getId());
        
        // SimpleCertificateReport -> ChainItem -> subject
        $subject = $firstChainItem->getSubject();
        
        $this->assertInstanceOf(Subject::class, $subject);
        $this->assertEquals('ESET SSL Filter CA', $subject->getCommonName());
        $this->assertEquals(null, $subject->getSurname());
        $this->assertEquals(null, $subject->getGivenName());
        $this->assertEquals(null, $subject->getPseudonym());
        $this->assertEquals('ESET, spol. s r. o.', $subject->getOrganizationName());
        $this->assertEquals(null, $subject->getOrganizationUnit());
        $this->assertEquals(null, $subject->getEmail());
        $this->assertEquals(null, $subject->getLocality());
        $this->assertEquals(null, $subject->getState());
        $this->assertEquals('SK', $subject->getCountry());
        
        // SimpleCertificateReport -> ChainItem
        
        $this->assertEquals(null, $firstChainItem->getIssuerId());
        $this->assertInstanceOf(Carbon::class, $firstChainItem->getNotBefore());
        $this->assertInstanceOf(Carbon::class, $firstChainItem->getNotAfter());
        $this->assertEquals(['keyCertSign'], $firstChainItem->getKeyUsage());
        $this->assertEquals(null, $firstChainItem->getExtendedKeyUsage());
        $this->assertEquals(null, $firstChainItem->getOcspUrl());
        $this->assertEquals(null, $firstChainItem->getCrlUrl());
        $this->assertEquals(null, $firstChainItem->getAiaUrl());
        $this->assertEquals(null, $firstChainItem->getCpsUrl());
        $this->assertEquals(null, $firstChainItem->getPdsUrl());
        $this->assertEquals('N/A', $firstChainItem->getQualificationAtIssuance());
        $this->assertEquals('N/A', $firstChainItem->getQualificationAtValidation());
        
        // SimpleCertificateReport -> ChainItem -> revocation
        $revocation = $firstChainItem->getRevocation();
        
        $this->assertInstanceOf(Revocation::class, $revocation);
        $this->assertEquals(null, $revocation->getProductionDate());
        $this->assertEquals(null, $revocation->getRevocationDate());
        $this->assertEquals(null, $revocation->getRevocationReason());
        
        // SimpleCertificateReport -> ChainItem
        $this->assertEquals(null, $firstChainItem->getTrustAnchor());
        $this->assertEquals('INDETERMINATE', $firstChainItem->getIndication());
        $this->assertEquals('NO_CERTIFICATE_CHAIN_FOUND', $firstChainItem->getSubIndication());
        
        // SimpleCertificateReport
        $this->assertInstanceOf(Carbon::class, $simpleCertificateReport->getValidationTime());
        
        // detailedReport
        $detailedReport = $validatedCertificateResponse->getDetailedReport();
        
        // detailedReport -> signatureOrTimestampOrCertificate
        $signatureOrTimestampOrCertificate = $detailedReport->getSignatureOrTimestampOrCertificate();
        $this->assertInstanceOf(SignatureOrTimestampOrCertificate::class, $signatureOrTimestampOrCertificate);
        
        // detailedReport -> signatureOrTimestampOrCertificate -> Certificate
        list($firstCertificate) = $signatureOrTimestampOrCertificate->getCertificate();
        
        // detailedReport -> signatureOrTimestampOrCertificate -> Certificate
        $this->assertEquals([], $firstCertificate->getValidationCertificateQualification());
        
        // detailedReport -> signatureOrTimestampOrCertificate -> Certificate -> Constraint
        list($firstConstraint) = $firstCertificate->getConstraint();
        $this->assertInstanceOf(Constraint::class, $firstConstraint);
        
        // detailedReport -> signatureOrTimestampOrCertificate -> Certificate -> Constraint -> Name
        $name = $firstConstraint->getName();
        
        $this->assertInstanceOf(DetailedReportCertificateConstraintName::class, $name);
        $this->assertEquals('Is the result of the Basic Building Block conclusive?', $name->getValue());
        $this->assertEquals('BBB_ACCEPT', $name->getKey());
        
        // detailedReport -> signatureOrTimestampOrCertificate -> Certificate -> Constraint
        $this->assertEquals('WARNING', $firstConstraint->getStatus());
        $this->assertEquals(null, $firstConstraint->getError());
        
        // detailedReport -> signatureOrTimestampOrCertificate -> Certificate -> Constraint -> Warning
        $warning = $firstConstraint->getWarning();
        
        $this->assertInstanceOf(DetailedReportCertificateConstraintWarning::class, $warning);
        $this->assertEquals('The result of the Basic Building Block is not conclusive!', $warning->getValue());
        $this->assertEquals('BBB_ACCEPT_ANS', $warning->getKey());
        
        // detailedReport -> signatureOrTimestampOrCertificate -> Certificate -> Constraint
        $this->assertEquals(null, $firstConstraint->getInfo());
        $this->assertEquals(null, $firstConstraint->getAdditionalInfo());
        $this->assertEquals(null, $firstConstraint->getId());
        $this->assertEquals(null, $firstConstraint->getBlockType());
        
        // detailedReport -> signatureOrTimestampOrCertificate -> Certificate -> Conclusion
        $conclusion = $firstCertificate->getConclusion();
        
        $this->assertInstanceOf(Conclusion::class, $conclusion);
        $this->assertEquals('INDETERMINATE', $conclusion->getIndication());
        $this->assertEquals(null, $conclusion->getSubIndication());
        $this->assertEquals([], $conclusion->getErrors());
        
        // detailedReport -> signatureOrTimestampOrCertificate -> Certificate -> Conclusion -> Warnings
        list($firstWarning) = $conclusion->getWarnings();
        
        $this->assertInstanceOf(DetailedReportCertificateConclusionWarning::class, $firstWarning);
        $this->assertEquals('The result of the Basic Building Block is not conclusive!', $firstWarning->getValue());
        $this->assertEquals('BBB_ACCEPT_ANS', $firstWarning->getKey());
        
        // detailedReport -> signatureOrTimestampOrCertificate -> Certificate -> Conclusion
        $this->assertEquals(null, $conclusion->getInfos());
        
        // detailedReport -> signatureOrTimestampOrCertificate -> Certificate
        $this->assertEquals('Certificate Qualification', $firstCertificate->getTitle());
        $this->assertEquals('C-130E8A844934A8563663BF6A2E27AADE2E4418D17E0B5EDAF17EC06DB0E50A5A', $firstCertificate->getId());
        
        // detailedReport -> BasicBuildingBlocks
        list($firstBasicBuildingBlock) = $detailedReport->getBasicBuildingBlocks();
        
        $this->assertInstanceOf(BasicBuildingBlock::class, $firstBasicBuildingBlock);
        $this->assertEquals(null, $firstBasicBuildingBlock->getFc());
        $this->assertEquals(null, $firstBasicBuildingBlock->getFc());
        $this->assertEquals(null, $firstBasicBuildingBlock->getIsc());
        $this->assertEquals(null, $firstBasicBuildingBlock->getVci());
        
        // detailedReport -> BasicBuildingBlocks -> XCV
        
        $xcv = $firstBasicBuildingBlock->getXcv();
        
        $this->assertInstanceOf(Xcv::class, $xcv);
        $this->assertEquals([], $xcv->getSubXCV());
        
        // detailedReport -> BasicBuildingBlocks -> XCV -> Constraint
        list($firstConstraint) = $xcv->getConstraint();
        
        $this->assertInstanceOf(XcvConstraint::class, $firstConstraint);
        
        // detailedReport -> BasicBuildingBlocks -> XCV -> Constraint -> Name  
        $name = $firstConstraint->getName();
        
        $this->assertInstanceOf(XcvConstraintName::class, $name);
        $this->assertEquals('Can the certificate chain be built till a trust anchor?', $name->getValue());
        $this->assertEquals('BBB_XCV_CCCBB', $name->getKey());
        
        // detailedReport -> BasicBuildingBlocks -> XCV -> Constraint
        $this->assertEquals('NOT OK', $firstConstraint->getStatus());
        
        // detailedReport -> BasicBuildingBlocks -> XCV -> Constraint -> Error  
        $error = $firstConstraint->getError();
        
        $this->assertInstanceOf(XcvConstraintError::class, $error);
        $this->assertEquals('The certificate chain is not trusted, it does not contain a trust anchor.', $error->getValue());
        $this->assertEquals('BBB_XCV_CCCBB_ANS', $error->getKey());
        
        // detailedReport -> BasicBuildingBlocks -> XCV -> Constraint
        $this->assertEquals(null, $firstConstraint->getWarning());
        $this->assertEquals(null, $firstConstraint->getInfo());
        $this->assertEquals(null, $firstConstraint->getAdditionalInfo());
        $this->assertEquals(null, $firstConstraint->getId());
        $this->assertEquals(null, $firstConstraint->getBlockType());
        
        // detailedReport -> BasicBuildingBlocks -> XCV -> Conclusion
        $conclusion = $xcv->getConclusion();
        
        $this->assertInstanceOf(XcvConclusion::class, $conclusion);
        $this->assertEquals('INDETERMINATE', $conclusion->getIndication());
        $this->assertEquals('NO_CERTIFICATE_CHAIN_FOUND', $conclusion->getSubIndication());
        
        // detailedReport -> BasicBuildingBlocks -> XCV -> Conclusion -> Errors
        list($firstError) = $conclusion->getErrors();
        
        $this->assertInstanceOf(XcvConclusionError::class, $firstError);
        $this->assertEquals('The certificate chain is not trusted, it does not contain a trust anchor.', $firstError->getValue());
        $this->assertEquals('BBB_XCV_CCCBB_ANS', $firstError->getKey());
        
        // detailedReport -> BasicBuildingBlocks -> XCV -> Conclusion
        $this->assertEquals([], $conclusion->getWarnings());
        $this->assertEquals([], $conclusion->getInfos());
        
        // detailedReport -> BasicBuildingBlocks -> XCV
        $this->assertEquals('X509 Certificate Validation', $xcv->getTitle());
        
        // detailedReport -> BasicBuildingBlocks
        $this->assertEquals(null, $firstBasicBuildingBlock->getCv());
        $this->assertEquals(null, $firstBasicBuildingBlock->getSav());
        $this->assertEquals(null, $firstBasicBuildingBlock->getPsv());
        $this->assertEquals(null, $firstBasicBuildingBlock->getPcv());
        $this->assertEquals(null, $firstBasicBuildingBlock->getVts());
        $this->assertEquals(null, $firstBasicBuildingBlock->getCertificateChain());
        
        // detailedReport -> BasicBuildingBlocks -> Conclusion
        $conclusion = $firstBasicBuildingBlock->getConclusion();
        
        $this->assertInstanceOf(BasicBuildingBlockConclusion::class, $conclusion);
        $this->assertEquals('INDETERMINATE', $conclusion->getIndication());
        $this->assertEquals('NO_CERTIFICATE_CHAIN_FOUND', $conclusion->getSubIndication());
        
        // detailedReport -> BasicBuildingBlocks-> Conclusion -> Errors
        list($firstError) = $conclusion->getErrors();
        
        $this->assertInstanceOf(BasicBuildingBlockConclusionError::class, $firstError);
        $this->assertEquals('The certificate chain is not trusted, it does not contain a trust anchor.', $firstError->getValue());
        $this->assertEquals('BBB_XCV_CCCBB_ANS', $firstError->getKey());
        
        // detailedReport -> BasicBuildingBlocks -> Conclusion
        $this->assertEquals([], $conclusion->getWarnings());
        $this->assertEquals([], $conclusion->getInfos());
        
        // detailedReport -> BasicBuildingBlocks
        $this->assertEquals('C-130E8A844934A8563663BF6A2E27AADE2E4418D17E0B5EDAF17EC06DB0E50A5A', $firstBasicBuildingBlock->getId());
        $this->assertEquals('CERTIFICATE', $firstBasicBuildingBlock->getType());
        
        // detailedReport
        $this->assertEquals([], $detailedReport->getTLAnalysis());
        $this->assertEquals(null, $detailedReport->getSemantic());
        $this->assertEquals(null, $detailedReport->getValidationTime());
    }*/
    
    public function testRandomValidCertificateValidationResponse(): void
    {    
      /*  $string = Resource::get('CertificateValidationResponse/random_valid_certificate.json');
        
        $response = new Response(200, ['Content-Type' => 'application/json'], $string);
        
        $validatedCertificateResponse = (new ValidatedCertificateResponse($response))
            ->toDTO()
            ;
        
        // DiagnosticData
        $diagnosticData = $validatedCertificateResponse->getDiagnosticData();
    
        $this->assertEquals(null, $diagnosticData->getDocumentName());
        $this->assertInstanceOf(Carbon::class, $diagnosticData->getValidationDate());
        $this->assertEquals(null, $diagnosticData->getContainerInfo());
        $this->assertEquals(null, $diagnosticData->getSignature());
        
        // DiagnosticData -> Revocation
        list($firstRevocation) = $diagnosticData->getRevocations();
        
        $this->assertInstanceOf(DiagnosticDataRevocation::class, $firstRevocation);
        $this->assertEquals('R-AE3486EBDCECF27E02EC738E35611A2023AA225D58A0A467B99F559061A7018F', $firstRevocation->getId());
        $this->assertEquals('EXTERNAL', $firstRevocation->getOrigin());
        $this->assertEquals('OCSP', $firstRevocation->getType());
        $this->assertEquals('http://qca-g1.digitalsign.pt/ocsp', $firstRevocation->getSourceAddress());
        $this->assertInstanceOf(Carbon::class, $firstRevocation->getProductionDate());
        $this->assertInstanceOf(Carbon::class, $firstRevocation->getThisUpdate());
        $this->assertInstanceOf(Carbon::class, $firstRevocation->getNextUpdate());
        $this->assertEquals(null, $firstRevocation->getExpiredCertsOnCRL());
        $this->assertEquals(null, $firstRevocation->getArchiveCutOff());
        $this->assertEquals(false, $firstRevocation->getCertHashExtensionPresent());
        $this->assertEquals(false, $firstRevocation->getCertHashExtensionMatch());
        
        // DiagnosticData -> Revocation -> BasicSignature
        $basicSignature = $firstRevocation->getBasicSignature();
        
        $this->assertEquals('RSA', $basicSignature->getEncryptionAlgoUsedToSignThisToken());
        $this->assertEquals('2048', $basicSignature->getKeyLengthUsedToSignThisToken());
        $this->assertEquals('SHA256', $basicSignature->getDigestAlgoUsedToSignThisToken());
        $this->assertEquals(null, $basicSignature->getMaskGenerationFunctionUsedToSignThisToken());
        $this->assertEquals(true, $basicSignature->getSignatureIntact());
        $this->assertEquals(true, $basicSignature->getSignatureValid());
        
        // DiagnosticData -> Revocation -> SigningCertificate
        $signingCertificate = $firstRevocation->getSigningCertificate();
        
        $this->assertInstanceOf(DiagnosticDataRevocationSigningCertificate::class, $signingCertificate);
        $this->assertEquals(null, $signingCertificate->getPublicKey());
        $this->assertEquals('C-C4D1E892E325AB641FA6111EB7D8115302D7BDD91807525EC0E07BC66EF07951', $signingCertificate->getCertificate());
        
        // DiagnosticData -> Revocation -> ChainItem
        list($firstChainItem, $secondChainItem, $thirdChainItem) = $firstRevocation->getChainItems();
        
        $this->assertInstanceOf(DiagnosticDataRevocationChainItem::class, $firstChainItem);
        $this->assertInstanceOf(DiagnosticDataRevocationChainItem::class, $secondChainItem);
        $this->assertInstanceOf(DiagnosticDataRevocationChainItem::class, $thirdChainItem);
        
        $this->assertEquals('C-C4D1E892E325AB641FA6111EB7D8115302D7BDD91807525EC0E07BC66EF07951', $firstChainItem->getCertificate());
        $this->assertEquals('C-27BB49D206B6DEC161EBB8EA739530E90AC68498D2EEA05A7ED9603D1DCE0FD5', $secondChainItem->getCertificate());
        $this->assertEquals('C-82BD5D851ACF7F6E1BA7BFCBC53030D0E7BC3C21DF772D858CAB41D199BDF595', $thirdChainItem->getCertificate());
        
        // DiagnosticData -> Revocation -> FoundCertificates
        $foundCertificates = $firstRevocation->getFoundCertificates();
        
        $this->assertInstanceOf(DiagnosticDataRevocationFoundCertificates::class, $foundCertificates);
        
        // DiagnosticData -> Revocation -> FoundCertificates -> RelatedCertificate
        list($firstRelatedCertificate, $secondRelatedCertificate) = $foundCertificates->getRelatedCertificates();
        
        $this->assertInstanceOf(DiagnosticDataRevocationFoundCertificatesRelatedCertificate::class, $firstRelatedCertificate);
        $this->assertInstanceOf(DiagnosticDataRevocationFoundCertificatesRelatedCertificate::class, $secondRelatedCertificate);
        
        $this->assertEquals(['BASIC_OCSP_RESP'], $firstRelatedCertificate->getOrigin());
        $this->assertEquals(null, $firstRelatedCertificate->getCertificateRefs());
        $this->assertEquals('C-27BB49D206B6DEC161EBB8EA739530E90AC68498D2EEA05A7ED9603D1DCE0FD5', $firstRelatedCertificate->getCertificate());
        
        $this->assertEquals(['BASIC_OCSP_RESP'], $firstRelatedCertificate->getOrigin());
        
        // DiagnosticData -> Revocation -> FoundCertificates -> RelatedCertificate -> CertificateRef
        list($firstCertificateRef) = $secondRelatedCertificate->getCertificateRefs();
        
        $this->assertInstanceOf(DiagnosticDataRevocationFoundCertificatesRelatedCertificateCertificateRef::class, $firstCertificateRef);
        
        $this->assertEquals('SIGNING_CERTIFICATE', $firstCertificateRef->getOrigin());
        $this->assertEquals(null, $firstCertificateRef->getIssuerSerial());
        $this->assertEquals(null, $firstCertificateRef->getDigestAlgoAndValue());
        
        // DiagnosticData -> Revocation -> FoundCertificates -> RelatedCertificate -> CertificateRef -> SerialInfo   
        $serialInfo = $firstCertificateRef->getSerialInfo();
        
        $this->assertInstanceOf(DiagnosticDataRevocationFoundCertificatesRelatedCertificateCertificateRefSerialInfo::class, $serialInfo);
        $this->assertEquals(null, $serialInfo->getIssuerName());
        $this->assertEquals(null, $serialInfo->getSerialNumber());
        $this->assertEquals('bPtib5+esFYOcfOhhbqu/hfFQ8A=', $serialInfo->getSki());
        $this->assertEquals(null, $serialInfo->getCurrent());
   
        // DiagnosticData -> Revocation -> FoundCertificates -> RelatedCertificate    
        $this->assertEquals('C-C4D1E892E325AB641FA6111EB7D8115302D7BDD91807525EC0E07BC66EF07951', $secondRelatedCertificate->getCertificate());
        
        // DiagnosticData -> Revocation
        $this->assertEquals(null, $firstRevocation->getBase64Encoded());

        // DiagnosticData -> Revocation -> DigestAlgoAndValue
        $digestAlgoAndValue = $firstRevocation->getDigestAlgoAndValue();
        
        $this->assertInstanceOf(DiagnosticDataRevocationDigestAlgoAndValue::class, $digestAlgoAndValue);
        
        $this->assertEquals('SHA256', $digestAlgoAndValue->getDigestMethod());
        $this->assertEquals('rjSG69zs8n4C7HOONWEaICOqIl1YoKRnuZ9VkGGnAY8=', $digestAlgoAndValue->getDigestValue());
        $this->assertEquals(null, $digestAlgoAndValue->getMatch()); 
        
        // DiagnosticData
        $this->assertEquals(null, $diagnosticData->getTimestamp());
        $this->assertEquals(null, $diagnosticData->getOrphanTokens());
        $this->assertEquals(null, $diagnosticData->getSignerData());
        
        // DiagnosticData -> TrustedList
        list($firstTrustedList, $secondTrustedList) = $diagnosticData->getTrustedLists();
        
        $this->assertInstanceOf(TrustedList::class, $firstTrustedList);
        $this->assertInstanceOf(TrustedList::class, $secondTrustedList);
        
        $this->assertEquals('TL-53044736BF44D260472AE794EC1BEA9CDA6E2833864BD33D3C95E7EFA5F47A06', $firstTrustedList->getId());
        $this->assertEquals('PT', $firstTrustedList->getCountryCode());
        $this->assertEquals('https://www.gns.gov.pt/media/1894/TSLPT.xml', $firstTrustedList->getUrl());
        $this->assertEquals(70, $firstTrustedList->getSequenceNumber());
        $this->assertEquals(5, $firstTrustedList->getVersion());
        $this->assertInstanceOf(Carbon::class, $firstTrustedList->getLastLoading());
        $this->assertInstanceOf(Carbon::class, $firstTrustedList->getIssueDate());
        $this->assertInstanceOf(Carbon::class, $firstTrustedList->getNextUpdate());
        $this->assertEquals(true, $firstTrustedList->getWellSigned());
        $this->assertEquals(null, $firstTrustedList->getlOTL());
        
        $this->assertEquals('LOTL-EC2AE37FE9A43B48B1CFE2A57EBEE2BD6373EDFF36537EB1BC905747ACBF4C3B', $secondTrustedList->getId());
        $this->assertEquals('EU', $secondTrustedList->getCountryCode());
        $this->assertEquals('https://ec.europa.eu/tools/lotl/eu-lotl.xml', $secondTrustedList->getUrl());
        $this->assertEquals(303, $secondTrustedList->getSequenceNumber());
        $this->assertEquals(5, $secondTrustedList->getVersion());
        $this->assertInstanceOf(Carbon::class, $secondTrustedList->getLastLoading());
        $this->assertInstanceOf(Carbon::class, $secondTrustedList->getIssueDate());
        $this->assertInstanceOf(Carbon::class, $secondTrustedList->getNextUpdate());
        $this->assertEquals(true, $secondTrustedList->getWellSigned());
        $this->assertEquals(true, $secondTrustedList->getlOTL());
        
        // DiagnosticData -> Certificate[1]
        list($firstCertificate, $secondCertificate, $thirdCertificate, $fourthCertificate) = $diagnosticData->getCertificates();    
        
        $this->assertInstanceOf(Certificate::class, $firstCertificate);
        $this->assertEquals('C-27BB49D206B6DEC161EBB8EA739530E90AC68498D2EEA05A7ED9603D1DCE0FD5', $firstCertificate->getId());
        
        // DiagnosticData -> Certificate -> GetSubjectDistinguishedName
        list($firstSubjectDistinguishedName, $secondSubjectDistinguishedName) = $firstCertificate->GetSubjectDistinguishedName();
        
        $this->assertEquals('cn=digitalsign qualified ca g1,o=digitalsign certificadora digital,c=pt', $firstSubjectDistinguishedName->getValue());
        $this->assertEquals('CANONICAL', $firstSubjectDistinguishedName->getFormat());
        
        $this->assertEquals('CN=DIGITALSIGN QUALIFIED CA G1,O=DigitalSign Certificadora Digital,C=PT', $secondSubjectDistinguishedName->getValue());
        $this->assertEquals('RFC2253', $secondSubjectDistinguishedName->getFormat());
        
        // DiagnosticData -> Certificate -> GetIssuerDistinguishedName
        list($firstIssuerDistinguishedName, $secondIssuerDistinguishedName) = $firstCertificate->GetIssuerDistinguishedName();
        
        $this->assertEquals('cn=digitalsign global root rsa ca,o=digitalsign certificadora digital,c=pt', $firstIssuerDistinguishedName->getValue());
        $this->assertEquals('CANONICAL', $firstIssuerDistinguishedName->getFormat());
        
        $this->assertEquals('CN=DIGITALSIGN GLOBAL ROOT RSA CA,O=DigitalSign Certificadora Digital,C=PT', $secondIssuerDistinguishedName->getValue());
        $this->assertEquals('RFC2253', $secondIssuerDistinguishedName->getFormat());
        
        // DiagnosticData -> Certificate
        $this->assertEquals('330444127560240380976396101945240260095972967226', $firstCertificate->GetSerialNumber());
        $this->assertEquals(null, $firstCertificate->GetSubjectSerialNumber());
        $this->assertEquals('DIGITALSIGN QUALIFIED CA G1', $firstCertificate->GetCommonName());
        $this->assertEquals(null, $firstCertificate->GetState());
        $this->assertEquals(null, $firstCertificate->GetLocality());
        $this->assertEquals('PT', $firstCertificate->GetCountryName());
        $this->assertEquals(null, $firstCertificate->GetOrganizationIdentifier());
        $this->assertEquals('DigitalSign Certificadora Digital', $firstCertificate->GetOrganizationName());
        $this->assertEquals(null, $firstCertificate->GetOrganizationalUnit());
        $this->assertEquals(null, $firstCertificate->GetTitle());
        $this->assertEquals(null, $firstCertificate->GetGivenName());
        $this->assertEquals(null, $firstCertificate->GetSurname());
        $this->assertEquals(null, $firstCertificate->GetPseudonym());
        $this->assertEquals(null, $firstCertificate->GetEmail());
        $this->assertEquals(null, $firstCertificate->GetSubjectAlternativeName());
        $this->assertEquals(['http://root-rsa.digitalsign.pt/DIGITALSIGNGLOBALROOTRSACA.p7b'], $firstCertificate->GetAiaUrl());
        $this->assertEquals(['http://root-rsa.digitalsign.pt/DIGITALSIGNGLOBALROOTRSACA.crl'], $firstCertificate->GetCrlUrl());
        $this->assertEquals([], $firstCertificate->GetOcspServerUrl());
        $this->assertEquals(['TRUSTED_LIST', 'OCSP_RESPONSE'], $firstCertificate->GetSource());
        $this->assertInstanceOf(Carbon::class, $firstCertificate->GetNotAfter());
        $this->assertInstanceOf(Carbon::class, $firstCertificate->GetNotBefore());
        $this->assertEquals(4096, $firstCertificate->GetPublicKeySize());
        $this->assertEquals('RSA', $firstCertificate->GetPublicKeyEncryptionAlgo());
        $this->assertEquals('PK-18338705E7A9E94ABE47B13573F79731526C0444CF90A23FCD7F8E248E3D108B', $firstCertificate->GetEntityKey());
        $this->assertEquals(['keyCertSign', 'crlSign'], $firstCertificate->GetKeyUsage());
        
        // DiagnosticData -> Certificate -> ExtendedKeyUsagesOid
        list($firstExtendedKeyUsagesOid, $secondExtendedKeyUsagesOid) = $firstCertificate->GetExtendedKeyUsagesOids();
        
        $this->assertInstanceOf(ExtendedKeyUsagesOid::class, $firstExtendedKeyUsagesOid);
        $this->assertInstanceOf(ExtendedKeyUsagesOid::class, $secondExtendedKeyUsagesOid);
        
        $this->assertEquals('1.3.6.1.5.5.7.3.2', $firstExtendedKeyUsagesOid->getValue());
        $this->assertEquals('clientAuth', $firstExtendedKeyUsagesOid->getDescription());
        
        $this->assertEquals('1.3.6.1.5.5.7.3.4', $secondExtendedKeyUsagesOid->getValue());
        $this->assertEquals('emailProtection', $secondExtendedKeyUsagesOid->getDescription());
      
        $this->assertEquals(false, $firstCertificate->GetIdPkixOcspNoCheck());
        
        // DiagnosticData -> Certificate -> BasicSignature    
        $basicSignature = $firstCertificate->GetBasicSignature();
        
        $this->assertInstanceOf(BasicSignature::class, $basicSignature);
        $this->assertEquals('RSA', $basicSignature->getEncryptionAlgoUsedToSignThisToken());
        $this->assertEquals('4096', $basicSignature->getKeyLengthUsedToSignThisToken());
        $this->assertEquals('SHA512', $basicSignature->getDigestAlgoUsedToSignThisToken());
        $this->assertEquals(null, $basicSignature->getMaskGenerationFunctionUsedToSignThisToken());
        $this->assertEquals(true, $basicSignature->getSignatureIntact());
        $this->assertEquals(true, $basicSignature->getSignatureValid());
        
        // DiagnosticData -> Certificate -> SigningCertificate
        $signingCertificate = $firstCertificate->getSigningCertificate();
        
        $this->assertInstanceOf(SigningCertificate::class, $signingCertificate);
        $this->assertEquals(null, $signingCertificate->getPublicKey());
        $this->assertEquals('C-82BD5D851ACF7F6E1BA7BFCBC53030D0E7BC3C21DF772D858CAB41D199BDF595', $signingCertificate->getCertificate());
        
        // DiagnosticData -> Certificate -> ChainItem
        list($firstChainItem) = $firstCertificate->getChainItems();
        
        $this->assertInstanceOf(DiagnosticDataCertificateChainItem::class, $firstChainItem);
        $this->assertEquals('C-82BD5D851ACF7F6E1BA7BFCBC53030D0E7BC3C21DF772D858CAB41D199BDF595', $firstChainItem->getCertificate());
            
        // DiagnosticData -> Certificate
        $this->assertEquals(true, $firstCertificate->getTrusted());
        $this->assertEquals(false, $firstCertificate->getSelfSigned());
        
        // DiagnosticData -> Certificate -> CertificatePolicy
        $firstCertificatePolicy = $firstCertificate->getCertificatePolicy();
        
        $this->assertInstanceOf(DiagnosticDataCertificateCertificatePolicy::class, $firstCertificatePolicy);
        
        $this->assertEquals('1.3.6.1.4.1.25596.4.1.1', $firstCertificatePolicy->getValue());
        $this->assertEquals(null, $firstCertificatePolicy->getDescription());
        $this->assertEquals('http://pki.digitalsign.pt', $firstCertificatePolicy->getCpsUrl());
        
        // DiagnosticData -> Certificate
        $this->assertEquals(null, $firstCertificate->getQcStatements());
        $this->assertEquals([], $firstCertificate->getTrustedServiceProvider()); // pabaigta ties sita vieta
        $this->assertEquals([], $firstCertificate->getCertificateRevocation());
        $this->assertEquals(null, $firstCertificate->getBase64Encoded());
        
        // DiagnosticData -> Certificate -> DigestAlgoAndValue
        $digestAlgoAndValue = $firstCertificate->getDigestAlgoAndValue();
          
        $this->assertInstanceOf(DigestAlgoAndValue::class, $digestAlgoAndValue);     
        $this->assertEquals('SHA256', $digestAlgoAndValue->getDigestMethod());
        $this->assertEquals('Ew6KhEk0qFY2Y79qLieq3i5EGNF+C17a8X7AbbDlClo=', $digestAlgoAndValue->getDigestValue());
        $this->assertEquals(null, $digestAlgoAndValue->getMatch());
        
        // DiagnosticData
        $this->assertEquals([], $diagnosticData->getRevocation());
        $this->assertEquals(null, $diagnosticData->getTimestamp());
        $this->assertEquals(null, $diagnosticData->getOrphanTokens());
        $this->assertEquals(null, $diagnosticData->getSignerData());
        $this->assertEquals([], $diagnosticData->getTrustedList());
        
        // SimpleCertificateReport
        $simpleCertificateReport = $validatedCertificateResponse->getSimpleCertificateReport();
        
        $this->assertInstanceOf(SimpleCertificateReport::class, $simpleCertificateReport);
        
        // SimpleCertificateReport -> ChainItem
        list($firstChainItem) = $simpleCertificateReport->getChainItem();
        
        $this->assertInstanceOf(ChainItem::class, $firstChainItem);
        $this->assertEquals('C-130E8A844934A8563663BF6A2E27AADE2E4418D17E0B5EDAF17EC06DB0E50A5A', $firstChainItem->getId());
        
        // SimpleCertificateReport -> ChainItem -> subject
        $subject = $firstChainItem->getSubject();
        
        $this->assertInstanceOf(Subject::class, $subject);
        $this->assertEquals('ESET SSL Filter CA', $subject->getCommonName());
        $this->assertEquals(null, $subject->getSurname());
        $this->assertEquals(null, $subject->getGivenName());
        $this->assertEquals(null, $subject->getPseudonym());
        $this->assertEquals('ESET, spol. s r. o.', $subject->getOrganizationName());
        $this->assertEquals(null, $subject->getOrganizationUnit());
        $this->assertEquals(null, $subject->getEmail());
        $this->assertEquals(null, $subject->getLocality());
        $this->assertEquals(null, $subject->getState());
        $this->assertEquals('SK', $subject->getCountry());
        
        // SimpleCertificateReport -> ChainItem
        
        $this->assertEquals(null, $firstChainItem->getIssuerId());
        $this->assertInstanceOf(Carbon::class, $firstChainItem->getNotBefore());
        $this->assertInstanceOf(Carbon::class, $firstChainItem->getNotAfter());
        $this->assertEquals(['keyCertSign'], $firstChainItem->getKeyUsage());
        $this->assertEquals(null, $firstChainItem->getExtendedKeyUsage());
        $this->assertEquals(null, $firstChainItem->getOcspUrl());
        $this->assertEquals(null, $firstChainItem->getCrlUrl());
        $this->assertEquals(null, $firstChainItem->getAiaUrl());
        $this->assertEquals(null, $firstChainItem->getCpsUrl());
        $this->assertEquals(null, $firstChainItem->getPdsUrl());
        $this->assertEquals('N/A', $firstChainItem->getQualificationAtIssuance());
        $this->assertEquals('N/A', $firstChainItem->getQualificationAtValidation());
        
        // SimpleCertificateReport -> ChainItem -> revocation
        $revocation = $firstChainItem->getRevocation();
        
        $this->assertInstanceOf(Revocation::class, $revocation);
        $this->assertEquals(null, $revocation->getProductionDate());
        $this->assertEquals(null, $revocation->getRevocationDate());
        $this->assertEquals(null, $revocation->getRevocationReason());
        
        // SimpleCertificateReport -> ChainItem
        $this->assertEquals(null, $firstChainItem->getTrustAnchor());
        $this->assertEquals('INDETERMINATE', $firstChainItem->getIndication());
        $this->assertEquals('NO_CERTIFICATE_CHAIN_FOUND', $firstChainItem->getSubIndication());
        
        // SimpleCertificateReport
        $this->assertInstanceOf(Carbon::class, $simpleCertificateReport->getValidationTime());
        
        // detailedReport
        $detailedReport = $validatedCertificateResponse->getDetailedReport();
        
        // detailedReport -> signatureOrTimestampOrCertificate
        $signatureOrTimestampOrCertificate = $detailedReport->getSignatureOrTimestampOrCertificate();
        $this->assertInstanceOf(SignatureOrTimestampOrCertificate::class, $signatureOrTimestampOrCertificate);
        
        // detailedReport -> signatureOrTimestampOrCertificate -> Certificate
        list($firstCertificate) = $signatureOrTimestampOrCertificate->getCertificate();
        
        // detailedReport -> signatureOrTimestampOrCertificate -> Certificate
        $this->assertEquals([], $firstCertificate->getValidationCertificateQualification());
        
        // detailedReport -> signatureOrTimestampOrCertificate -> Certificate -> Constraint
        list($firstConstraint) = $firstCertificate->getConstraint();
        $this->assertInstanceOf(Constraint::class, $firstConstraint);
        
        // detailedReport -> signatureOrTimestampOrCertificate -> Certificate -> Constraint -> Name
        $name = $firstConstraint->getName();
        
        $this->assertInstanceOf(DetailedReportCertificateConstraintName::class, $name);
        $this->assertEquals('Is the result of the Basic Building Block conclusive?', $name->getValue());
        $this->assertEquals('BBB_ACCEPT', $name->getKey());
        
        // detailedReport -> signatureOrTimestampOrCertificate -> Certificate -> Constraint
        $this->assertEquals('WARNING', $firstConstraint->getStatus());
        $this->assertEquals(null, $firstConstraint->getError());
        
        // detailedReport -> signatureOrTimestampOrCertificate -> Certificate -> Constraint -> Warning
        $warning = $firstConstraint->getWarning();
        
        $this->assertInstanceOf(DetailedReportCertificateConstraintWarning::class, $warning);
        $this->assertEquals('The result of the Basic Building Block is not conclusive!', $warning->getValue());
        $this->assertEquals('BBB_ACCEPT_ANS', $warning->getKey());
        
        // detailedReport -> signatureOrTimestampOrCertificate -> Certificate -> Constraint
        $this->assertEquals(null, $firstConstraint->getInfo());
        $this->assertEquals(null, $firstConstraint->getAdditionalInfo());
        $this->assertEquals(null, $firstConstraint->getId());
        $this->assertEquals(null, $firstConstraint->getBlockType());
        
        // detailedReport -> signatureOrTimestampOrCertificate -> Certificate -> Conclusion
        $conclusion = $firstCertificate->getConclusion();
        
        $this->assertInstanceOf(Conclusion::class, $conclusion);
        $this->assertEquals('INDETERMINATE', $conclusion->getIndication());
        $this->assertEquals(null, $conclusion->getSubIndication());
        $this->assertEquals([], $conclusion->getErrors());
        
        // detailedReport -> signatureOrTimestampOrCertificate -> Certificate -> Conclusion -> Warnings
        list($firstWarning) = $conclusion->getWarnings();
        
        $this->assertInstanceOf(DetailedReportCertificateConclusionWarning::class, $firstWarning);
        $this->assertEquals('The result of the Basic Building Block is not conclusive!', $firstWarning->getValue());
        $this->assertEquals('BBB_ACCEPT_ANS', $firstWarning->getKey());
        
        // detailedReport -> signatureOrTimestampOrCertificate -> Certificate -> Conclusion
        $this->assertEquals(null, $conclusion->getInfos());
        
        // detailedReport -> signatureOrTimestampOrCertificate -> Certificate
        $this->assertEquals('Certificate Qualification', $firstCertificate->getTitle());
        $this->assertEquals('C-130E8A844934A8563663BF6A2E27AADE2E4418D17E0B5EDAF17EC06DB0E50A5A', $firstCertificate->getId());
        
        // detailedReport -> BasicBuildingBlocks
        list($firstBasicBuildingBlock) = $detailedReport->getBasicBuildingBlocks();
        
        $this->assertInstanceOf(BasicBuildingBlock::class, $firstBasicBuildingBlock);
        $this->assertEquals(null, $firstBasicBuildingBlock->getFc());
        $this->assertEquals(null, $firstBasicBuildingBlock->getFc());
        $this->assertEquals(null, $firstBasicBuildingBlock->getIsc());
        $this->assertEquals(null, $firstBasicBuildingBlock->getVci());
        
        // detailedReport -> BasicBuildingBlocks -> XCV
        
        $xcv = $firstBasicBuildingBlock->getXcv();
        
        $this->assertInstanceOf(Xcv::class, $xcv);
        $this->assertEquals([], $xcv->getSubXCV());
        
        // detailedReport -> BasicBuildingBlocks -> XCV -> Constraint
        list($firstConstraint) = $xcv->getConstraint();
        
        $this->assertInstanceOf(XcvConstraint::class, $firstConstraint);
        
        // detailedReport -> BasicBuildingBlocks -> XCV -> Constraint -> Name  
        $name = $firstConstraint->getName();
        
        $this->assertInstanceOf(XcvConstraintName::class, $name);
        $this->assertEquals('Can the certificate chain be built till a trust anchor?', $name->getValue());
        $this->assertEquals('BBB_XCV_CCCBB', $name->getKey());
        
        // detailedReport -> BasicBuildingBlocks -> XCV -> Constraint
        $this->assertEquals('NOT OK', $firstConstraint->getStatus());
        
        // detailedReport -> BasicBuildingBlocks -> XCV -> Constraint -> Error  
        $error = $firstConstraint->getError();
        
        $this->assertInstanceOf(XcvConstraintError::class, $error);
        $this->assertEquals('The certificate chain is not trusted, it does not contain a trust anchor.', $error->getValue());
        $this->assertEquals('BBB_XCV_CCCBB_ANS', $error->getKey());
        
        // detailedReport -> BasicBuildingBlocks -> XCV -> Constraint
        $this->assertEquals(null, $firstConstraint->getWarning());
        $this->assertEquals(null, $firstConstraint->getInfo());
        $this->assertEquals(null, $firstConstraint->getAdditionalInfo());
        $this->assertEquals(null, $firstConstraint->getId());
        $this->assertEquals(null, $firstConstraint->getBlockType());
        
        // detailedReport -> BasicBuildingBlocks -> XCV -> Conclusion
        $conclusion = $xcv->getConclusion();
        
        $this->assertInstanceOf(XcvConclusion::class, $conclusion);
        $this->assertEquals('INDETERMINATE', $conclusion->getIndication());
        $this->assertEquals('NO_CERTIFICATE_CHAIN_FOUND', $conclusion->getSubIndication());
        
        // detailedReport -> BasicBuildingBlocks -> XCV -> Conclusion -> Errors
        list($firstError) = $conclusion->getErrors();
        
        $this->assertInstanceOf(XcvConclusionError::class, $firstError);
        $this->assertEquals('The certificate chain is not trusted, it does not contain a trust anchor.', $firstError->getValue());
        $this->assertEquals('BBB_XCV_CCCBB_ANS', $firstError->getKey());
        
        // detailedReport -> BasicBuildingBlocks -> XCV -> Conclusion
        $this->assertEquals([], $conclusion->getWarnings());
        $this->assertEquals([], $conclusion->getInfos());
        
        // detailedReport -> BasicBuildingBlocks -> XCV
        $this->assertEquals('X509 Certificate Validation', $xcv->getTitle());
        
        // detailedReport -> BasicBuildingBlocks
        $this->assertEquals(null, $firstBasicBuildingBlock->getCv());
        $this->assertEquals(null, $firstBasicBuildingBlock->getSav());
        $this->assertEquals(null, $firstBasicBuildingBlock->getPsv());
        $this->assertEquals(null, $firstBasicBuildingBlock->getPcv());
        $this->assertEquals(null, $firstBasicBuildingBlock->getVts());
        $this->assertEquals(null, $firstBasicBuildingBlock->getCertificateChain());
        
        // detailedReport -> BasicBuildingBlocks -> Conclusion
        $conclusion = $firstBasicBuildingBlock->getConclusion();
        
        $this->assertInstanceOf(BasicBuildingBlockConclusion::class, $conclusion);
        $this->assertEquals('INDETERMINATE', $conclusion->getIndication());
        $this->assertEquals('NO_CERTIFICATE_CHAIN_FOUND', $conclusion->getSubIndication());
        
        // detailedReport -> BasicBuildingBlocks-> Conclusion -> Errors
        list($firstError) = $conclusion->getErrors();
        
        $this->assertInstanceOf(BasicBuildingBlockConclusionError::class, $firstError);
        $this->assertEquals('The certificate chain is not trusted, it does not contain a trust anchor.', $firstError->getValue());
        $this->assertEquals('BBB_XCV_CCCBB_ANS', $firstError->getKey());
        
        // detailedReport -> BasicBuildingBlocks -> Conclusion
        $this->assertEquals([], $conclusion->getWarnings());
        $this->assertEquals([], $conclusion->getInfos());
        
        // detailedReport -> BasicBuildingBlocks
        $this->assertEquals('C-130E8A844934A8563663BF6A2E27AADE2E4418D17E0B5EDAF17EC06DB0E50A5A', $firstBasicBuildingBlock->getId());
        $this->assertEquals('CERTIFICATE', $firstBasicBuildingBlock->getType());
        
        // detailedReport
        $this->assertEquals([], $detailedReport->getTLAnalysis());
        $this->assertEquals(null, $detailedReport->getSemantic());
        $this->assertEquals(null, $detailedReport->getValidationTime());*/
    }
}
