<?php

namespace S25\ItinRu\Contracts;

interface PassportData {
    public function getFirstName(): string;
    public function getLastName(): string;
    public function getPatronymic(): string;
    public function getBirthday(): string;
    public function getSeriesAndNumber(): string;
}
