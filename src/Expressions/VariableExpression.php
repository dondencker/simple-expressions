<?php namespace Dencker\SimpleExpressions\Expressions;

use Dencker\SimpleExpressions\Context;

class VariableExpression extends AbstractExpression
{
    protected $variables;

    function __construct(array $variables)
    {
        $this->variables = $variables;
    }

    protected function regex()
    {
        $regex = [];

        foreach ($this->variables as $replace => $with)
        {
            $regex[] = preg_quote( $replace );
        }

        return '/(' . join( "|", $regex ) . ')/';

    }

    public function evaluate(Context $context)
    {
        $matched = $this->matches[0];

        return $this->variables[$matched];
    }
}