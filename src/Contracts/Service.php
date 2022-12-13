<?php

namespace S25\ItinRu\Contracts;

interface Service
{
    /** @return string|null - should return string on success, null if not found */
    public function provideTin(PassportData $passportData): ?string;
}
