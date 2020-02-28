<?php


namespace Framework\Http;

use Psr\Http\Message\StreamInterface;

class Stream implements StreamInterface
{
    const DEFAULT_MEMORY = 2 * 1024 * 1024;
    const DEFAULT_MODE = 'r+';
    private $stream;
    private $size;
    private $writable;
    private $readable;
    private $seekable;

    public function __construct($handler,int $size = null)
    {
        $this->stream = $handler;
        $this->size = $size;
        $this->writable = $this->readable = $this->seekable = true;
    }

    public static function createFromString(string $content): self
    {
        $stream = fopen(sprintf("php://temp/maxmemory:%s", self::DEFAULT_MEMORY), self::DEFAULT_MODE);
        fwrite($stream,$content);

        return new self($stream,strlen($content));
    }

    /**
     * @inheritDoc
     */
    public function __toString()
    {
        if (!isset($this->stream)) {
            return null;
        }
        $this->rewind();

        return fread($this->stream, $this->size);
    }

    /**
     * @inheritDoc
     */
    public function close()
    {
        if (!isset($this->stream)) {
            return null;
        }
        fclose($this->stream);
    }

    /**
     * @inheritDoc
     */
    public function detach()
    {
        if (!isset($this->stream)) {
            return null;
        }
        unset($this->stream);
        $this->size = null;
        $this->readable = $this->writable = $this->seekable = false;
    }

    /**
     * @inheritDoc
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @inheritDoc
     */
    public function tell()
    {
        if (!isset($this->stream)) {
            return null;
        }

        return ftell($this->stream);
    }

    /**
     * @inheritDoc
     */
    public function eof()
    {
        if (!isset($this->stream)) {
            return null;
        }

        return feof($this->stream);
    }

    /**
     * @inheritDoc
     */
    public function isSeekable()
    {
        return $this->seekable;
    }

    /**
     * @inheritDoc
     */
    public function seek($offset, $whence = SEEK_SET)
    {
        if (!isset($this->stream)) {
            return null;
        }

        return fseek($this->stream, $offset, $whence);
    }

    /**
     * @inheritDoc
     */
    public function rewind()
    {
        if (!isset($this->stream)) {
            return null;
        }

        return rewind($this->stream);
    }

    /**
     * @inheritDoc
     */
    public function isWritable()
    {
        return $this->writable;
    }

    /**
     * @inheritDoc
     */
    public function write($string)
    {
        if (!isset($this->stream)) {
            return null;
        }

        return fwrite($this->stream, $string);
    }

    /**
     * @inheritDoc
     */
    public function isReadable()
    {
        return $this->readable;
    }

    /**
     * @inheritDoc
     */
    public function read($length)
    {
        if (!isset($this->stream)) {
            return null;
        }

        return fread($this->stream, $length);
    }

    /**
     * @inheritDoc
     */
    public function getContents()
    {
        if (!isset($this->stream)) {
            return null;
        }
        $this->rewind();
        stream_get_contents($this->stream);
    }

    /**
     * @inheritDoc
     */
    public function getMetadata($key = null)
    {
        $arr = stream_get_meta_data($this->stream);
        if (!$key) {
            return $arr;
        }
        if ($arr[$key]) {
            return $arr[$key];
        }

        return null;
    }
}