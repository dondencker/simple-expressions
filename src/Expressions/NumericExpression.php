<?php namespace Dencker\SimpleExpressions\Expressions;

use Dencker\SimpleExpressions\Context;

class NumericExpression extends AbstractExpression
{

    protected function regex()
    {
        return '/( |^|\()([0-9]+)( |$|\))/';
    }

    public function evaluate(Context $context)
    {
        return floatval( $this->matches[1] );
    }

    protected function replace($expression)
    {
        return $this->matches[0] . $expression . $this->matches[2];
    }
}