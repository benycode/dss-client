<?php

declare(strict_types=1);

namespace DSS\HttpClient\Response\ValidatedResponse\DTO\DiagnosticData;

use DSS\HttpClient\Response\ValidatedResponse\DTO\DiagnosticData\Certificate\SubjectDistinguishedName;
use DSS\HttpClient\Response\ValidatedResponse\DTO\DiagnosticData\Certificate\IssuerDistinguishedName;
use DSS\HttpClient\Response\ValidatedResponse\DTO\DiagnosticData\Certificate\BasicSignature;
use DSS\HttpClient\Response\ValidatedResponse\DTO\DiagnosticData\Certificate\DigestAlgoAndValue;
use DSS\HttpClient\Response\ValidatedResponse\DTO\DiagnosticData\Certificate\SigningCertificate;
use DSS\HttpClient\Response\ValidatedResponse\DTO\DiagnosticData\Certificate\QcStatements;
use DSS\HttpClient\Response\ValidatedResponse\DTO\DiagnosticData\Certificate\ExtendedKeyUsagesOid;
use DSS\HttpClient\Response\ValidatedResponse\DTO\DiagnosticData\Certificate\ChainItem;
use DSS\HttpClient\Response\ValidatedResponse\DTO\DiagnosticData\Certificate\CertificatePolicy;
use Carbon\Carbon;

final class Certificate
{	
	private string $id;
	
	private array $subjectDistinguishedName;

	private array $issuerDistinguishedName;
	
	private string $serialNumber;
	
	private ?string $subjectSerialNumber = null;
	
	private string $commonName;
	
	private ?string $locality = null;
	
	private ?string $state = null;
	
	private ?string $countryName = null;
	
	private ?string $organizationIdentifier = null;
	
	private string $organizationName;
	
	private ?string $organizationalUnit = null;
	
	private ?string $title = null;
	
	private ?string $givenName = null;
	
	private ?string $pseudonym = null;
	
	private ?string $email = null;
	
	private ?array $subjectAlternativeName = null;
	
	private ?array $aiaUrl = [];
	
	private ?array $crlUrl = [];
	
	private ?array $ocspServerUrl = [];
	
	private ?array $source = [];
	
	private Carbon $notAfter;
	
	private Carbon $NotBefore;
	
	private string $publicKeyEncryptionAlgo;
	
	private string $entityKey;
	
	private ?array $keyUsage = [];
	
	private ?array $extendedKeyUsagesOids = [];
	
	private bool $idPkixOcspNoCheck;
	
	private BasicSignature $basicSignature;
	
	private ?SigningCertificate $signingCertificate = null;
	
	private ?array $chainItems = [];
	
	private bool $trusted;
	
	private bool $selfSigned;
	
	private ?array $certificatePolicies = [];
	
	private ?QcStatements $qcStatements = null;
	
	private ?array $trustedServiceProvider = [];
	
	private ?array $certificateRevocation = [];
	
	private ?string $base64Encoded = null;
    
    private DigestAlgoAndValue $digestAlgoAndValue;
		
    public function setId(string $id): self
    {
        $this->id = $id;
		return $this;
    }
	
	public function getId(): string
    {
        return $this->id;
    }
	
	public function appendSubjectDistinguishedName(SubjectDistinguishedName $subjectDistinguishedName): self
    {
        $this->subjectDistinguishedName[] = $subjectDistinguishedName;
		return $this;
    }
	
	public function getSubjectDistinguishedName(): array
    {
        return $this->subjectDistinguishedName;
    }
	
	public function appendIssuerDistinguishedName(IssuerDistinguishedName $issuerDistinguishedName): self
    {
        $this->issuerDistinguishedName[] = $issuerDistinguishedName;
		return $this;
    }
	
	public function getIssuerDistinguishedName(): array
    {
        return $this->issuerDistinguishedName;
    }
	
	public function setSerialNumber(string $serialNumber): self
    {
        $this->serialNumber = $serialNumber;
		return $this;
    }
	
	public function getSerialNumber(): string
    {
        return $this->serialNumber;
    }
	
	public function setSubjectSerialNumber(?string $subjectSerialNumber): self
    {
        $this->subjectSerialNumber = $subjectSerialNumber;
		return $this;
    }
	
	public function getSubjectSerialNumber(): ?string
    {
        return $this->subjectSerialNumber;
    }
	
	public function setCommonName(string $commonName): self
    {
        $this->commonName = $commonName;
		return $this;
    }
	
	public function getCommonName(): string
    {
        return $this->commonName;
    }
	
	public function setLocality(?string $locality): self
    {
        $this->locality = $locality;
		return $this;
    }
	
	public function getLocality(): ?string
    {
        return $this->locality;
    }
	
	public function setState(?string $state): self
    {
        $this->state = $state;
		return $this;
    }
	
	public function getState(): ?string
    {
        return $this->state;
    }
	
	public function setCountryName(?string $countryName): self
    {
        $this->countryName = $countryName;
		return $this;
    }
	
	public function getCountryName(): ?string
    {
        return $this->countryName;
    }
	
	public function setOrganizationIdentifier(?string $organizationIdentifier): self
    {
        $this->organizationIdentifier = $organizationIdentifier;
		return $this;
    }
	
	public function getOrganizationIdentifier(): ?string
    {
        return $this->organizationIdentifier;
    }
	
	public function setOrganizationName(string $organizationName): self
    {
        $this->organizationName = $organizationName;
		return $this;
    }
	
	public function getOrganizationName(): string
    {
        return $this->organizationName;
    }
	
	public function setOrganizationalUnit(?string $organizationalUnit): self
    {
        $this->organizationalUnit = $organizationalUnit;
		return $this;
    }
	
	public function getOrganizationalUnit(): ?string
    {
        return $this->organizationalUnit;
    }
	
	public function setTitle(?string $title): self
    {
        $this->title = $title;
		return $this;
    }
	
	public function getTitle(): ?string
    {
        return $this->title;
    }
	
	public function setGivenName(?string $givenName): self
    {
        $this->givenName = $givenName;
		return $this;
    }
	
	public function getGivenName(): ?string
    {
        return $this->givenName;
    }
	
	public function setSurname(?string $surname): self
    {
        $this->surname = $surname;
		return $this;
    }
	
	public function getSurname(): ?string
    {
        return $this->surname;
    }
	
	public function setPseudonym(?string $pseudonym): self
    {
        $this->pseudonym = $pseudonym;
		return $this;
    }
	
	public function getPseudonym(): ?string
    {
        return $this->pseudonym;
    }
	
	public function setEmail(?string $email): self
    {
        $this->email = $email;
		return $this;
    }
	
	public function getEmail(): ?string
    {
        return $this->email;
    }
	
	public function setSubjectAlternativeName(?array $subjectAlternativeName): self
    {
        $this->subjectAlternativeName = $subjectAlternativeName;
		return $this;
    }
	
	public function getSubjectAlternativeName(): ?array
    {
        return $this->subjectAlternativeName;
    }
	
	public function setAiaUrl(?array $aiaUrl): self
    {
        $this->aiaUrl = $aiaUrl;
		return $this;
    }
	
	public function getAiaUrl(): ?array
    {
        return $this->aiaUrl;
    }
	
	public function setCrlUrl(?array $crlUrl): self
    {
        $this->crlUrl = $crlUrl;
		return $this;
    }
	
	public function getCrlUrl(): ?array
    {
        return $this->crlUrl;
    }
	
	public function setOcspServerUrl(?array $ocspServerUrl): self
    {
        $this->ocspServerUrl = $ocspServerUrl;
		return $this;
    }
	
	public function getOcspServerUrl(): ?array
    {
        return $this->ocspServerUrl;
    }
	
	public function setSource(?array $source): self
    {
        $this->source = $source;
		return $this;
    }
	
	public function getSource(): ?array
    {
        return $this->source;
    }
	
	public function setNotAfter(Carbon $notAfter): self
    {
        $this->notAfter = $notAfter;
		return $this;
    }
	
	public function getNotAfter(): Carbon
    {
        return $this->notAfter;
    }
	
	public function setNotBefore(Carbon $notBefore): self
    {
        $this->notBefore = $notBefore;
		return $this;
    }
	
	public function getNotBefore(): Carbon
    {
        return $this->notBefore;
    }
	
	public function setPublicKeySize(int $publicKeySize): self
    {
        $this->publicKeySize = $publicKeySize;
		return $this;
    }
	
	public function getPublicKeySize(): int
    {
        return $this->publicKeySize;
    }
	
	public function setPublicKeyEncryptionAlgo(string $publicKeyEncryptionAlgo): self
    {
        $this->publicKeyEncryptionAlgo = $publicKeyEncryptionAlgo;
		return $this;
    }
	
	public function getPublicKeyEncryptionAlgo(): string
    {
        return $this->publicKeyEncryptionAlgo;
    }
	
	public function setEntityKey(string $entityKey): self
    {
        $this->entityKey = $entityKey;
		return $this;
    }
	
	public function getEntityKey(): string
    {
        return $this->entityKey;
    }
	
	public function setKeyUsage(?array $keyUsage): self
    {
        $this->keyUsage = $keyUsage;
		return $this;
    }
	
	public function getKeyUsage(): ?array
    {
        return $this->keyUsage;
    }
	
	public function setExtendedKeyUsagesOids(?array $extendedKeyUsagesOids): self
    {
        $this->extendedKeyUsagesOids = $extendedKeyUsagesOids;
		return $this;
    }
    
    public function appendExtendedKeyUsagesOid(ExtendedKeyUsagesOid $extendedKeyUsagesOid): self
    {
        $this->extendedKeyUsagesOids[] = $extendedKeyUsagesOid;
        return $this;
    }
	
	public function getExtendedKeyUsagesOids(): ?array
    {
        return $this->extendedKeyUsagesOids;
    }
	
	public function setIdPkixOcspNoCheck(bool $idPkixOcspNoCheck): self
    {
        $this->idPkixOcspNoCheck = $idPkixOcspNoCheck;
		return $this;
    }
	
	public function getIdPkixOcspNoCheck(): bool
    {
        return $this->idPkixOcspNoCheck;
    }
	
	public function setBasicSignature(BasicSignature $basicSignature): self
    {
        $this->basicSignature = $basicSignature;
		return $this;
    }
	
	public function getBasicSignature(): BasicSignature
    {
        return $this->basicSignature;
    }
	
	public function setSigningCertificate(?SigningCertificate $signingCertificate): self
    {
        $this->signingCertificate = $signingCertificate;
		return $this;
    }
	
	public function getSigningCertificate(): ?SigningCertificate
    {
        return $this->signingCertificate;
    }
	
	public function setChainItems(?array $chainItems): self
    {
        $this->chainItems = $chainItems;
		return $this;
    }
    
    public function appendChainItem(ChainItem $chainItem): self
    {
        $this->chainItems[] = $chainItem;
        return $this;
    }
	
	public function getChainItems(): ?array
    {
        return $this->chainItems;
    }
	
	public function setTrusted(bool $trusted): self
    {
        $this->trusted = $trusted;
		return $this;
    }
	
	public function getTrusted(): bool
    {
        return $this->trusted;
    }
	
	public function setSelfSigned(bool $selfSigned): self
    {
        $this->selfSigned = $selfSigned;
		return $this;
    }
	
	public function getSelfSigned(): bool
    {
        return $this->selfSigned;
    }
	
	public function setCertificatePolicies(?array $certificatePolicies): self
    {
        $this->certificatePolicies = $certificatePolicies;
		return $this;
    }
    
    public function appendCertificatePolicy(CertificatePolicy $certificatePolicy): self
    {
        $this->certificatePolicies[] = $certificatePolicy;
        return $this;
    }
	
	public function getCertificatePolicies(): ?array
    {
        return $this->certificatePolicies;
    }
	
	public function setQcStatements(?QcStatements $qcStatements): self
    {
        $this->qcStatements = $qcStatements;
		return $this;
    }
	
	public function getQcStatements(): ?QcStatements
    {
        return $this->qcStatements;
    }
	
	public function setTrustedServiceProvider(?array $trustedServiceProvider): self
    {
        $this->trustedServiceProvider = $trustedServiceProvider;
		return $this;
    }
	
	public function getTrustedServiceProvider(): ?array
    {
        return $this->trustedServiceProvider;
    }
	
	public function setCertificateRevocation(?array $certificateRevocation): self
    {
        $this->certificateRevocation = $certificateRevocation;
		return $this;
    }
	
	public function getCertificateRevocation(): ?array
    {
        return $this->certificateRevocation;
    }
	
	public function setBase64Encoded(?string $base64Encoded): self
    {
        $this->base64Encoded = $base64Encoded;
		return $this;
    }
	
	public function getBase64Encoded(): ?string
    {
        return $this->base64Encoded;
    }
    
    public function setDigestAlgoAndValue(DigestAlgoAndValue $digestAlgoAndValue): self
    {
        $this->digestAlgoAndValue = $digestAlgoAndValue;
        return $this;
    }
    
    public function getDigestAlgoAndValue(): DigestAlgoAndValue
    {
        return $this->digestAlgoAndValue;
    }
}
