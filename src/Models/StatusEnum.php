<?php


namespace App\Models;


class StatusEnum
{
    const AUTO = 0;
    const TEN_MIN_HIGH = 1;
    const TWENTY_MIN_HIGH = 2;
    const THIRTY_MIN_HIGH = 3;
    const MANUAL_LOW = 4;
    const MANUAL_MEDIUM = 5;
    const MANUAL_HIGH = 6;
    const NOT_HOME = 7;
    const ERROR = 99;
}