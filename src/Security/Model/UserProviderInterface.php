<?php

declare(strict_types=1);

namespace KejawenLab\ApiSkeleton\Security\Model;

/**
 * @author Muhamad Surya Iksanudin<surya.kejawen@gmail.com>
 */
interface UserProviderInterface
{
    public function findUsername(string $username): ?AuthInterface;

    public function support(string $class): bool;
}
