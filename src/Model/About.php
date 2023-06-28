<?php

namespace App\Model;

class About
{
    private ?string $general_terms;

    private ?string $timetable;

    /**
     * @return ?string
     */
    public function getGeneralTerms(): ?string
    {
        return $this->general_terms ?? null;
    }

    /**
     * @param string $general_terms
     */
    public function setGeneralTerms(string $general_terms): void
    {
        $this->general_terms = $general_terms;
    }

    /**
     * @return ?string
     */
    public function getTimetable(): ?string
    {
        return $this->timetable ?? null;
    }

    /**
     * @param string $timetable
     */
    public function setTimetable(string $timetable): void
    {
        $this->timetable = $timetable;
    }

}