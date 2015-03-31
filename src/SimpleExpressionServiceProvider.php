<?php  namespace Dencker\SimpleExpressions; 

use Dencker\SimpleExpressions\Expressions\AndExpression;
use Dencker\SimpleExpressions\Expressions\ContainsExpression;
use Dencker\SimpleExpressions\Expressions\EqualsExpression;
use Dencker\SimpleExpressions\Expressions\LiteralExpression;
use Dencker\SimpleExpressions\Expressions\NumericExpression;
use Dencker\SimpleExpressions\Expressions\OrExpression;

class SimpleExpressionServiceProvider {

    public function register()
    {
        ExpressionFactory::extendSingleton([
           new NumericExpression,
           new LiteralExpression,
           new EqualsExpression,
           new ContainsExpression,
           new AndExpression,
           new OrExpression
        ]);
    }

    public function boot()
    {

    }
}