<?php
namespace Faker\Provider;

class BonusCard extends \Faker\Provider\Base
{
    private $issueDateVal;
    private $expDateVal;

    public function series()
    {
        return $this->generator->numberBetween(100, 999);
    }

    public function number()
    {
        return $this->generator->numberBetween(100000, 999999);
    }

    public function issueDate()
    {
        $issueDateVal = $this->generator->dateTimeBetween('-2 year', 'now');
        return $issueDateVal;
    }

    public function expDate()
    {
        $date = new DateTime($this->issueDateVal);
        $date->add($date, date_interval_create_from_date_string('6 months'));
        $this->expDateVal = $date->format('Y-m-d H:i:s');
        return $this->expDateVal;
    }

    public function status()
    {
        $status = $this->generator->randomElement(['active', 'inactive']);
        if( $this->expDateVal > date() ) $status = 'expired';
        return $status;
    }
}