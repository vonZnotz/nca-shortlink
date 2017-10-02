<?php

declare(strict_types=1);

namespace NCAShortlink\Resolver;


class FileSystemResolver implements ResolverInterface
{
    /**
     * @var string
     */
    private $filePath;

    /**
     * @param string]null $filePath
     */
    public function __construct(string $filePath = null)
    {
        $this->filePath = $filePath ?? sys_get_temp_dir();

        if (!is_dir($this->filePath)) {
            throw new \RuntimeException('this directory does not exist :)');
        }
    }

    /**
     * @param string $uri
     * @return null|string
     */
    public function resolveUri(string $uri): ?string
    {
        $fileName = sprintf('%s/%s.txt', rtrim($this->filePath, DIRECTORY_SEPARATOR), $uri);
        if (!file_exists($fileName)) {
            return null;
        }

        $data = file_get_contents($fileName);

        if (!is_string($data)) {
            return null;
        }

        return $data;
    }
}
