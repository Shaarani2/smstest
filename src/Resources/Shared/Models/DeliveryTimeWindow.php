<?php

declare(strict_types=1);

namespace Infobip\Resources\Shared\Models;

use Infobip\Resources\ModelInterface;
use Infobip\Resources\ResourceValidationInterface;
use Infobip\Resources\Shared\Collections\DayCollection;
use Infobip\Resources\Shared\Enums\Day;
use Infobip\Validations\RuleCollection;

final class DeliveryTimeWindow implements ModelInterface, ResourceValidationInterface
{
    /** @var DayCollection */
    private $days;

    /** @var TimeWindowFrom|null */
    private $from = null;

    /** @var TimeWindowTo|null */
    private $to = null;

    public function __construct()
    {
        $this->days = new DayCollection();
    }

    public function addDay(Day $day): self
    {
        $this->days->add($day);

        return $this;
    }

    public function setTimeWindow(?TimeWindowFrom $from, ?TimeWindowTo $to): self
    {
        $this->from = $from;
        $this->to = $to;

        return $this;
    }

    public function toArray(): array
    {
        return array_filter_recursive([
            'days' => $this->days->toArray(),
            'from' => $this->from ? $this->from->toArray() : null,
            'to' => $this->to ? $this->to->toArray() : null,
        ]);
    }

    public function validationRules(): RuleCollection
    {
        return (new RuleCollection())
            ->addCollection($this->from ? $this->from->validationRules() : null)
            ->addCollection($this->to ? $this->to->validationRules() : null);
    }
}
