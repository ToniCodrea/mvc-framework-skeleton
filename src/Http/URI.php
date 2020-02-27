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
        string $scheme,
        string $user,
        string $password,
        string $host,
        ?int $port,
        string $path,
        string $query,
        string $fragment)
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

    /**
     * @inheritDoc
     */
    public function getScheme() : string
    {
        return $this->scheme;
    }

    /**
     * @inheritDoc
     */
    public function getAuthority() : string
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
    public function getUserInfo() : string
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
    public function getHost() : string
    {
        return strtolower($this->host);
    }

    /**
     * @inheritDoc
     */
    public function getPort() : int
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
    public function getQuery() : string
    {
        return $this->query;
    }

    /**
     * @inheritDoc
     */
    public function getFragment() : string
    {
        return $this->fragment;
    }

    /**
     * @inheritDoc
     */
    public function withScheme($scheme) : self
    {
        $uri = clone $this;
        $uri->scheme = $scheme;
        return $uri;
    }

    /**
     * @inheritDoc
     */
    public function withUserInfo($user, $password = null) : self
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
    public function withHost($host) : self
    {
        $uri = clone $this;
        $uri->host = $host;
        return $uri;
    }

    /**
     * @inheritDoc
     */
    public function withPort($port) : self
    {
        $uri = clone $this;
        $uri->port = $port;
        return $uri;
    }

    /**
     * @inheritDoc
     */
    public function withPath($path) : self
    {
        $uri = clone $this;
        $uri->path = $path;
        return $uri;
    }

    /**
     * @inheritDoc
     */
    public function withQuery($query) :  self
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
        // TODO: Implement __toString() method.
    }
}