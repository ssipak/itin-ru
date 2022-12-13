<?php

namespace S25\ItinRu;

class PassportData implements Contracts\PassportData
{
    public function __construct(
        protected string $firstName,
        protected string $lastName,
        protected string $patronymic,
        protected string $birthday,
        protected string $seriesAndNumber,
    ) {
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getPatronymic(): string
    {
        return $this->patronymic;
    }

    public function getBirthday(): string
    {
        return $this->birthday;
    }

    public function getSeriesAndNumber(): string
    {
        return $this->seriesAndNumber;
    }
}
