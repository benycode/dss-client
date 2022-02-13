<?php

declare(strict_types=1);

namespace DSS\HttpClient\Response\ValidatedResponse\DTO\SimpleCertificateReport\ChainItem;

final class Subject
{	
	private string $commonName;
	
	private ?string $surname = null;
	
	private ?string $givenName = null;
	
	private ?string $pseudonym = null;
	
	private string $organizationName;
	
	private ?string $organizationUnit = null;
	
	private ?string $email = null;
	
	private ?string $locality = null;
	
	private ?string $state = null;
	
	private ?string $country = null;
		
    public function setCommonName(string $commonName): self
    {
        $this->commonName = $commonName;
		return $this;
    }
	
	public function getCommonName(): string
    {
        return $this->commonName;
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
	
	public function setGivenName(?string $givenName): self
    {
        $this->givenName = $givenName;
		return $this;
    }
	
	public function getGivenName(): ?string
    {
        return $this->givenName;
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
	
	public function setOrganizationName(string $organizationName): self
    {
        $this->organizationName = $organizationName;
		return $this;
    }
	
	public function getOrganizationName(): string
    {
        return $this->organizationName;
    }
	
	public function setOrganizationUnit(?string $organizationUnit): self
    {
        $this->organizationUnit = $organizationUnit;
		return $this;
    }
	
	public function getOrganizationUnit(): ?string
    {
        return $this->organizationUnit;
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
	
	public function setCountry(?string $country): self
    {
        $this->country = $country;
		return $this;
    }
	
	public function getCountry(): ?string
    {
        return $this->country;
    }
}
