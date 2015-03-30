<?php  namespace Dencker\SimpleExpressions;

class ExpressionFactory {

    public function solve($context)
    {
        $context = new Context( $context );

        $expression_stack = [
            new NumericExpression,
            new BooleanExpression,
            new LiteralExpression,
            new EqualsExpression,
            new AndExpression,
            new OrExpression,
        ];

        /** @var AbstractExpression $exp */
        foreach ($expression_stack as $exp)
        {
            $exp->interpret( $context );
        }

        return $context->solve();

    }
}