<?php
/**
 * Created by PhpStorm.
 * User: t.neumann
 * Date: 23.09.17
 * Time: 10:24
 */

namespace NCAShortlink\Resolver;

interface ResolverInterface
{
    /**
     * @param string $uri
     * @return null|string
     */
    public function resolveUri(string $uri): ?string;

}