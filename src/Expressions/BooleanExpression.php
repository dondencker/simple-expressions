<?php namespace Dencker\SimpleExpressions\Expressions;

class BooleanExpression extends AbstractExpression{

    protected function regex()
    {
        return '/( |^|\()(true|false)( |$|\))/';
    }

    public function evaluate(Context $context)
    {
        return $this->matches[1]=="false" ? false : true;
    }

    protected function replace($expression)
    {
        return $this->matches[0].$expression.$this->matches[2];
    }
}