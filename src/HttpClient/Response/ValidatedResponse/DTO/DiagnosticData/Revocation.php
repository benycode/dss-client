<?php

declare(strict_types=1);

namespace DSS\HttpClient\Response\ValidatedResponse\DTO\DiagnosticData;

use DSS\HttpClient\Response\ValidatedResponse\DTO\DiagnosticData\Revocation\BasicSignature;
use DSS\HttpClient\Response\ValidatedResponse\DTO\DiagnosticData\Revocation\SigningCertificate;
use DSS\HttpClient\Response\ValidatedResponse\DTO\DiagnosticData\Revocation\ChainItem;
use DSS\HttpClient\Response\ValidatedResponse\DTO\DiagnosticData\Revocation\FoundCertificates;
use DSS\HttpClient\Response\ValidatedResponse\DTO\DiagnosticData\Revocation\DigestAlgoAndValue;
use Carbon\Carbon;

final class Revocation
{   
    private string $id;
    
    private string $origin;
    
    private string $type;
    
    private string $sourceAddress;
    
    private Carbon $productionDate;
    
    private Carbon $thisUpdate;
    
    private Carbon $nextUpdate;
    
    private ?string $expiredCertsOnCRL = null;
    
    private ?string $archiveCutOff = null;
    
    private bool $certHashExtensionPresent;
    
    private bool $certHashExtensionMatch;
    
    private BasicSignature $basicSignature;
    
    private SigningCertificate $signingCertificate;
    
    private array $chainItem = [];
    
    private FoundCertificates $foundCertificates;
    
    private ?string $base64Encoded = null;
    
    private ?DigestAlgoAndValue $digestAlgoAndValue = null;
        
    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }
    
    public function getId(): string
    {
        return $this->id;
    }
    
    public function setOrigin(string $origin): self
    {
        $this->origin = $origin;
        return $this;
    }
    
    public function getOrigin(): string
    {
        return $this->origin;
    }
    
    public function setType(string $type): self
    {
        $this->type = $type;
        return $this;
    }
    
    public function getType(): string
    {
        return $this->type;
    }
    
    public function setSourceAddress(string $sourceAddress): self
    {
        $this->sourceAddress = $sourceAddress;
        return $this;
    }
    
    public function getSourceAddress(): string
    {
        return $this->sourceAddress;
    }
    
    public function setProductionDate(Carbon $productionDate): self
    {
        $this->productionDate = $productionDate;
        return $this;
    }
    
    public function getProductionDate(): Carbon
    {
        return $this->productionDate;
    }
    
    public function setThisUpdate(Carbon $thisUpdate): self
    {
        $this->thisUpdate = $thisUpdate;
        return $this;
    }
    
    public function getThisUpdate(): Carbon
    {
        return $this->thisUpdate;
    }
    
    public function setNextUpdate(Carbon $nextUpdate): self
    {
        $this->nextUpdate = $nextUpdate;
        return $this;
    }
    
    public function getNextUpdate(): Carbon
    {
        return $this->nextUpdate;
    }
    
    public function setExpiredCertsOnCRL(?string $expiredCertsOnCRL): self
    {
        $this->expiredCertsOnCRL = $expiredCertsOnCRL;
        return $this;
    }
    
    public function getExpiredCertsOnCRL(): ?string
    {
        return $this->expiredCertsOnCRL;
    }
    
    public function setArchiveCutOff(?string $archiveCutOff): self
    {
        $this->archiveCutOff = $archiveCutOff;
        return $this;
    }
    
    public function getArchiveCutOff(): ?string
    {
        return $this->archiveCutOff;
    }
    
    public function setCertHashExtensionPresent(bool $certHashExtensionPresent): self
    {
        $this->certHashExtensionPresent = $certHashExtensionPresent;
        return $this;
    }
    
    public function getCertHashExtensionPresent(): bool
    {
        return $this->certHashExtensionPresent;
    }
    
    public function setCertHashExtensionMatch(bool $certHashExtensionMatch): self
    {
        $this->certHashExtensionMatch = $certHashExtensionMatch;
        return $this;
    }
    
    public function getCertHashExtensionMatch(): bool
    {
        return $this->certHashExtensionMatch;
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
    
    public function setSigningCertificate(SigningCertificate $signingCertificate): self
    {
        $this->signingCertificate = $signingCertificate;
        return $this;
    }
    
    public function getSigningCertificate(): SigningCertificate
    {
        return $this->signingCertificate;
    }
    
    public function setChainItems(array $chainItems): self
    {
        $this->chainItems = $chainItems;
        return $this;
    }
    
    public function appendChainItem(ChainItem $chainItem): self
    {
        $this->chainItems[] = $chainItem;
        return $this;
    }
    
    public function getChainItems(): array
    {
        return $this->chainItems;
    }
    
    public function setFoundCertificates(FoundCertificates $foundCertificates): self
    {
        $this->foundCertificates = $foundCertificates;
        return $this;
    }
    
    public function getFoundCertificates(): FoundCertificates
    {
        return $this->foundCertificates;
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
    
    public function setDigestAlgoAndValue(?DigestAlgoAndValue $digestAlgoAndValue): self
    {
        $this->digestAlgoAndValue = $digestAlgoAndValue;
        return $this;
    }
    
    public function getDigestAlgoAndValue(): ?DigestAlgoAndValue
    {
        return $this->digestAlgoAndValue;
    }
}
