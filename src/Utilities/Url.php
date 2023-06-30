<?php
declare(strict_types = 1);

namespace Toolkit\Utilities;

use Cake\Http\ServerRequestFactory;
use Cake\Routing\Router;

class Url
{

    /**
     * @param string $url
     * @return array
     */
    public static function parseUrlInRoute(string $url): array
    {
        $parsedUrl = parse_url($url);
        $server = $_SERVER;
        $server['REQUEST_URI'] = $url;
        if (!empty($parsedUrl['query'])) {
            $server['QUERY_STRING'] = $parsedUrl['query'];
        }
        $request = ServerRequestFactory::fromGlobals($server);
        return Router::parseRequest($request);
    }
}