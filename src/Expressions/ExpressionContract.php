<?php
    namespace Dencker\SimpleExpressions\Expressions;

    use Dencker\SimpleExpressions\Context;

    interface ExpressionContract
    {
        public function interpret(Context $context);

        public function evaluate(Context $context);

    }