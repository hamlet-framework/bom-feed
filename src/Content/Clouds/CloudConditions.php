<?php

namespace Hamlet\BureauOfMeteorology\Content\Clouds;

use PhpUnitConversion\Unit\Length;

class CloudConditions
{
    /**
     * @var CloudConditionSummary|null
     */
    private $summary;

    /**
     * @var Length|null
     */
    private $base;

    /**
     * @see https://en.wikipedia.org/wiki/Okta
     * @var 0|1|2|3|4|5|6|7|8|9|null
     */
    private $oktas;

    /**
     * @var CloudType|null
     */
    private $type;

    /**
     * @var int|null
     */
    private $typeId;

    /**
     * @param CloudConditionSummary|null $summary
     * @param Length|null $base
     * @param int|null $oktas
     * @param CloudType|null $type
     * @param int|null $typeId
     */
    public function __construct($summary, $base, $oktas, $type, $typeId)
    {
        $this->summary = $summary;
        $this->base = $base;
        $this->oktas = $oktas;
        $this->type = $type;
        $this->typeId = $typeId;
    }

    /**
     * @return CloudConditionSummary|null
     */
    public function summary()
    {
        return $this->summary;
    }

    /**
     * @return Length|null
     */
    public function base()
    {
        return $this->base;
    }

    /**
     * @return int|null
     */
    public function oktas()
    {
        return $this->oktas;
    }

    /**
     * @return CloudType|null
     */
    public function type()
    {
        return $this->type;
    }

    /**
     * @return int|null
     */
    public function typeId()
    {
        return $this->typeId;
    }
}
