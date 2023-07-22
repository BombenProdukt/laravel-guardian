<?php

declare(strict_types=1);

namespace BombenProdukt\Guardian\Data;

final readonly class Route
{
    public function __construct(
        private string $name,
        private string $path,
        private array $middleware,
    ) {}

    public function getName(): string
    {
        return $this->name;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getMiddleware(): array
    {
        return $this->middleware;
    }
}
