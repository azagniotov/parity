<?php
namespace Icecave\Parity\Comparator;

abstract class AbstractComparator implements ComparatorInterface
{
    /**
     * @param mixed $lhs The first value to compare.
     * @param mixed $rhs The second value to compare.
     *
     * @return boolean True if $lhs == $rhs.
     */
    public function isEqualTo($lhs, $rhs)
    {
        return $this->compare($lhs, $rhs) === 0;
    }

    /**
     * @param mixed $lhs The first value to compare.
     * @param mixed $rhs The second value to compare.
     *
     * @return boolean True if $lhs != $rhs.
     */
    public function isNotEqualTo($lhs, $rhs)
    {
        return $this->compare($lhs, $rhs) !== 0;
    }

    /**
     * @param mixed $lhs The first value to compare.
     * @param mixed $rhs The second value to compare.
     *
     * @return boolean True if $lhs < $rhs.
     */
    public function isLessThan($lhs, $rhs)
    {
        return $this->compare($lhs, $rhs) < 0;
    }

    /**
     * @param mixed $lhs The first value to compare.
     * @param mixed $rhs The second value to compare.
     *
     * @return boolean True if $lhs > $rhs.
     */
    public function isGreaterThan($lhs, $rhs)
    {
        return $this->compare($lhs, $rhs) > 0;
    }

    /**
     * @param mixed $lhs The first value to compare.
     * @param mixed $rhs The second value to compare.
     *
     * @return boolean True if $lhs <= $rhs.
     */
    public function isLessThanOrEqualTo($lhs, $rhs)
    {
        return $this->compare($lhs, $rhs) <= 0;
    }

    /**
     * @param mixed $lhs The first value to compare.
     * @param mixed $rhs The second value to compare.
     *
     * @return boolean True if $lhs >= $rhs.
     */
    public function isGreaterThanOrEqualTo($lhs, $rhs)
    {
        return $this->compare($lhs, $rhs) >= 0;
    }
}
