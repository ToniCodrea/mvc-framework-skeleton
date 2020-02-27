<?php

namespace Framework\Http;

use Psr\Http\Message\UriInterface;

class URI implements UriInterface
{

    private $scheme;
    private $user;
    private $password;
    private $host;
    private $port;
    private $path;
    private $query;
    private $fragment;

    public function __construct(
        string $host,
        string $scheme = "HTTP",
        string $user = "",
        string $password = "",
        ?int $port = 80,
        string $path = "",
        string $query = "",
        string $fragment = "")
    {
        $this->scheme = $scheme;
        $this->user = $user;
        $this->password = $password;
        $this->host = $host;
        $this->port = $port;
        $this->path = $path;
        $this->query = $query;
        $this->fragment = $fragment;
    }

    public static function createFromGlobals(): self {
        return new URI($_SERVER['HTTP_HOST'], $_SERVER['REQUEST_SCHEME'], "", "", $_SERVER['SERVER_PORT'], $_SERVER['REQUEST_URI'], $_SERVER['QUERY_STRING'], "");
    }

    /**
     * @inheritDoc
     */
    public function getScheme()
    {
        return $this->scheme;
    }

    /**
     * @inheritDoc
     */
    public function getAuthority()
    {
        $authority = "";
        if ($this->getUserInfo()) $authority.= $this->getUserInfo()."@";
        $authority .= $this->getHost();
        if ($this->getPort()) $authority.=":".$this->getPort();
        return $authority;
    }

    /**
     * @inheritDoc
     */
    public function getUserInfo()
    {
        $info = "";
        if ($this->user) {
            $info .= $this->user;
            if ($this->password) {
                $info.= ":".$this->password;
            }
        }
        return $info;
    }

    /**
     * @inheritDoc
     */
    public function getHost()
    {
        return strtolower($this->host);
    }

    /**
     * @inheritDoc
     */
    public function getPort()
    {
        if ($this->port) return $this->port;
        if ($this->scheme) return 80;
        return null;
    }

    /**
     * @inheritDoc
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @inheritDoc
     */
    public function getQuery()
    {
        return $this->query;
    }

    /**
     * @inheritDoc
     */
    public function getFragment()
    {
        return $this->fragment;
    }

    /**
     * @inheritDoc
     */
    public function withScheme($scheme)
    {
        $uri = clone $this;
        $uri->scheme = $scheme;
        return $uri;
    }

    /**
     * @inheritDoc
     */
    public function withUserInfo($user, $password = null)
    {
        $uri = clone $this;
        $uri->user = $user;
        $uri->password = $password;
        if (!$password) $uri->password = "";
        return $uri;
    }

    /**
     * @inheritDoc
     */
    public function withHost($host)
    {
        $uri = clone $this;
        $uri->host = $host;
        return $uri;
    }

    /**
     * @inheritDoc
     */
    public function withPort($port)
    {
        $uri = clone $this;
        $uri->port = $port;
        return $uri;
    }

    /**
     * @inheritDoc
     */
    public function withPath($path)
    {
        $uri = clone $this;
        $uri->path = $path;
        return $uri;
    }

    /**
     * @inheritDoc
     */
    public function withQuery($query)
    {
        $uri = clone $this;
        $uri->query = $query;
        return $uri;
    }

    /**
     * @inheritDoc
     */
    public function withFragment($fragment)
    {
        $uri = clone $this;
        $uri->fragment = $fragment;
        return $uri;
    }

    /**
     * @inheritDoc
     */
    public function __toString()
    {
        $string = "";
        if ($this->getScheme()) $string.= $this->getScheme().":";
        if ($this->getAuthority()) $string.="//".$this->getAuthority();
        $string.=$this->getPath();
        if($this->getQuery()) $string.="?".$this->getQuery();
        if($this->getFragment()) $string.="#".$this->getFragment();
        return $string;
    }
}