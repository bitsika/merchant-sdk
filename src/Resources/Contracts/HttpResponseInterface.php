<?php

namespace Bitsika\Resources\Contracts;

interface HttpResponseInterface
{

    public function body(): string;

    public function json(): array;

    // public function object(): object;

    public function status(): int;

    public function successful(): bool;

    public function failed(): bool;

    public function headers(): array;

}