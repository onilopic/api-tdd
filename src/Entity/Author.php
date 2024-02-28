<?php

namespace App\Entity;

class Author implements \JsonSerializable
{
    public function __construct(
        private ?int $id,
        public readonly string $name,
        public readonly string $bio,
    )
    {
    }

    public static function create(?int $id, string $name, string $bio): self
    {
        return new self($id, $name, $bio);
    }

    public function jsonSerialize(): mixed
    {
        $vars = get_object_vars($this);

        return $vars;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }
}
