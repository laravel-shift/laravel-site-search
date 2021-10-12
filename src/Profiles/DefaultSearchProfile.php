<?php

namespace Spatie\SiteSearch\Profiles;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UriInterface;
use Spatie\SiteSearch\Indexers\Indexer;

class DefaultSearchProfile implements SearchProfile
{
    public function shouldCrawl(UriInterface $url): bool
    {
        return true;
    }

    public function shouldIndex(UriInterface $url): bool
    {
        return true;
    }

    public function useIndexer(UriInterface $url, ResponseInterface $response): ?Indexer
    {
        if ($response->getStatusCode() !== 200) {
            return null;
        }

        $defaultIndexer = config('site-search.default_indexer');

        return new $defaultIndexer($url, $response);
    }
}
