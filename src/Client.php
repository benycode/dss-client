<?php

declare(strict_types=1);

namespace DSS;

use DSS\Api\Addon;
use DSS\Api\CurrentUser;
use DSS\Api\HookEvents;
use DSS\Api\PullRequests;
use DSS\Api\Repositories;
use DSS\Api\Sign\OneDocumentSigner;
use DSS\Api\CertificateCheker;
use DSS\Api\Snippets;
use DSS\Api\Users;
use DSS\Api\Workspaces;
use DSS\HttpClient\Builder;
use DSS\HttpClient\Message\ResponseMediator;
use DSS\HttpClient\Plugin\Authentication;
use DSS\HttpClient\Plugin\ExceptionThrower;
use DSS\HttpClient\Plugin\History;
use Http\Client\Common\HttpMethodsClientInterface;
use Http\Client\Common\Plugin\AddHostPlugin;
use Http\Client\Common\Plugin\HeaderDefaultsPlugin;
use Http\Client\Common\Plugin\HistoryPlugin;
use Http\Client\Common\Plugin\RedirectPlugin;
use Http\Discovery\Psr17FactoryDiscovery;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\ResponseInterface;
use DSS\Entity\Document;
use DSS\Entity\Certificate;
use DSS\Entity\ValidatedEntity;

class Client
{
    public const AUTH_OAUTH_TOKEN = 'oauth_token';

    public const AUTH_HTTP_PASSWORD = 'http_password';

    public const AUTH_JWT = 'jwt';

    private const BASE_URL = '';

    private const USER_AGENT = 'dss-php-api-client';

    private Builder $httpClientBuilder;

    private History $responseHistory;

    public function __construct(Builder $httpClientBuilder = null)
    {
        $this->httpClientBuilder = $builder = $httpClientBuilder ?? new Builder();
        $this->responseHistory = new History();

        $builder->addPlugin(new HistoryPlugin($this->responseHistory));
        $builder->addPlugin(new RedirectPlugin());

        $builder->addPlugin(new HeaderDefaultsPlugin([
			'Content-type' => ResponseMediator::JSON_CONTENT_TYPE,
			'User-agent' => SELF::USER_AGENT,  
        ]));

        //$this->setUrl(self::BASE_URL);
    }

    public static function createWithHttpClient(ClientInterface $httpClient): self
    {
        $builder = new Builder($httpClient);

        return new self($builder);
    }
	
	public function oneDocument(Document $document): SignApi
    {
        return new OneDocumentSigner($this, $document);
    }
	
	public function certificate(Certificate $certificate): ValidateApi
    {
		return new CertificateCheker($this, $certificate);
    }

    public function authenticate(string $method, string $token, string $password = null): void
    {
        $this->getHttpClientBuilder()->removePlugin(Authentication::class);
        $this->getHttpClientBuilder()->addPlugin(new Authentication($method, $token, $password));
    }

    public function setUrl(string $url): void
    {
        $this->httpClientBuilder->removePlugin(AddHostPlugin::class);
        $this->httpClientBuilder->addPlugin(new AddHostPlugin(Psr17FactoryDiscovery::findUriFactory()->createUri($url)));
    }

    public function getLastResponse(): ?ResponseInterface
    {
        return $this->responseHistory->getLastResponse();
    }

    public function getHttpClient(): HttpMethodsClientInterface
    {
        return $this->getHttpClientBuilder()->getHttpClient();
    }

    protected function getHttpClientBuilder(): Builder
    {
        return $this->httpClientBuilder;
    }
}
