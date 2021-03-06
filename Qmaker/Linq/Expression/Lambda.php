<?php

namespace Qmaker\Linq\Expression;


/**
 * Class LambdaInstance
 *
 * @method static \Qmaker\Linq\Expression\LambdaInstance add($a, $b) '+' operator
 * @method static \Qmaker\Linq\Expression\LambdaInstance sub($a, $b) '-' operator
 * @method static \Qmaker\Linq\Expression\LambdaInstance mult($a, $b) '*' operator
 * @method static \Qmaker\Linq\Expression\LambdaInstance div($a, $b) '/' operator
 * @method static \Qmaker\Linq\Expression\LambdaInstance eq($a, $b) '==' operator
 * @method static \Qmaker\Linq\Expression\LambdaInstance ne($a, $b) '!=' operator
 * @method static \Qmaker\Linq\Expression\LambdaInstance gt($a, $b) '>' operator
 * @method static \Qmaker\Linq\Expression\LambdaInstance ge($a, $b) '>=' operator
 * @method static \Qmaker\Linq\Expression\LambdaInstance lt($a, $b) '<' operator
 * @method static \Qmaker\Linq\Expression\LambdaInstance le($a, $b) '>=' operator
 * @method static \Qmaker\Linq\Expression\LambdaInstance and_($a, $b) logical AND
 * @method static \Qmaker\Linq\Expression\LambdaInstance or_($a, $b) logical OR
 * @method static \Qmaker\Linq\Expression\LambdaInstance xor_($a, $b) logical XOR
 */
class Lambda {
    protected function __construct()
    {
    }

    /**
     * @see LambdaInstance::v
     */
    static public function v($path = null)
    {
        $lambda = (new LambdaInstance())->v();
        if (!empty($path)) {
            $lambda->item($path);
        }
        return $lambda;
    }

    /**
     * @see LambdaInstance::i
     */
    static public function i()
    {
        return (new LambdaInstance())->i();
    }

    /**
     * @see LambdaInstance::c
     */
    static public function c($value)
    {
        return (new LambdaInstance())->c($value);
    }

    /**
     * @see LambdaInstance::complex
     */
    static public function complex(array $value)
    {
        return (new LambdaInstance())->complex($value);
    }

    /**
     * @see LambdaInstance::math
     */
    static public function math($expression)
    {
        throw new \BadMethodCallException('Not implemented');
    }

    static public function __callStatic($name, $arguments)
    {
        $result = new LambdaInstance();

        $implemented = array_merge(
            ['and_', 'or_', 'xor_', 'eq', 'ne', 'gt', 'ge', 'lt', 'le', 'add', 'sub', 'mult', 'div'],
            get_class_methods($result)
        );

        if (array_search($name, $implemented) !== false || function_exists($name)) {
            return call_user_func_array([$result, $name], $arguments);
        }

        return $result->item($name);
    }
}