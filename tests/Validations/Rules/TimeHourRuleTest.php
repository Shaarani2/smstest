<?php

declare(strict_types=1);

namespace Tests\Validations\Rules;

use Infobip\Validations\Rules\TimeHourRule;
use Tests\TestCase;

final class TimeHourRuleTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     */
    public function testRuleWithDataProvider(?int $value, bool $expectedPasses): void
    {
        $rule = new TimeHourRule('hour', $value);

        $this->assertSame($expectedPasses, $rule->passes());
    }

    public function dataProvider(): iterable
    {
        yield 'null value passes' => [null, true];

        yield 'value passes 1' => [0, true];
        yield 'value passes 2' => [5, true];
        yield 'value passes 3' => [15, true];
        yield 'value passes 4' => [23, true];

        yield 'value fails 1' => [-1, false];
        yield 'value fails 2' => [24, false];
    }
}
