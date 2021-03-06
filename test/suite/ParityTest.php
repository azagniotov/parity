<?php
namespace Icecave\Parity;

use PHPUnit\Framework\TestCase;
use stdClass;

class ParityTest extends TestCase
{
    public function setUp()
    {
        $this->value  = 0;
        $this->less   = -1;
        $this->same   = 0;
        $this->more   = 1;
        $this->object = new stdClass();
    }

    public function testCompare()
    {
        $this->assertGreaterThan(0, Parity::compare($this->value, $this->less));
        $this->assertSame(0, Parity::compare($this->value, $this->same));
        $this->assertLessThan(0, Parity::compare($this->value, $this->more));
    }

    public function testIsEqualTo()
    {
        $this->assertFalse(Parity::isEqualTo($this->value, $this->less));
        $this->assertTrue(Parity::isEqualTo($this->value, $this->same));
        $this->assertFalse(Parity::isEqualTo($this->value, $this->more));
    }

    public function testIsNotEqualTo()
    {
        $this->assertTrue(Parity::isNotEqualTo($this->value, $this->less));
        $this->assertFalse(Parity::isNotEqualTo($this->value, $this->same));
        $this->assertTrue(Parity::isNotEqualTo($this->value, $this->more));
    }

    public function testIsLessThan()
    {
        $this->assertFalse(Parity::isLessThan($this->value, $this->less));
        $this->assertFalse(Parity::isLessThan($this->value, $this->same));
        $this->assertTrue(Parity::isLessThan($this->value, $this->more));
    }

    public function testIsGreaterThan()
    {
        $this->assertTrue(Parity::isGreaterThan($this->value, $this->less));
        $this->assertFalse(Parity::isGreaterThan($this->value, $this->same));
        $this->assertFalse(Parity::isGreaterThan($this->value, $this->more));
    }

    public function testIsLessThanOrEqualTo()
    {
        $this->assertFalse(Parity::isLessThanOrEqualTo($this->value, $this->less));
        $this->assertTrue(Parity::isLessThanOrEqualTo($this->value, $this->same));
        $this->assertTrue(Parity::isLessThanOrEqualTo($this->value, $this->more));
    }

    public function testIsGreaterThanOrEqualTo()
    {
        $this->assertTrue(Parity::isGreaterThanOrEqualTo($this->value, $this->less));
        $this->assertTrue(Parity::isGreaterThanOrEqualTo($this->value, $this->same));
        $this->assertFalse(Parity::isGreaterThanOrEqualTo($this->value, $this->more));
    }

    public function testMin()
    {
        $this->assertSame($this->less, Parity::min($this->value, $this->less));
        $this->assertSame($this->less, Parity::min($this->less, $this->value));
        $this->assertSame($this->less, Parity::min($this->value, $this->same, $this->less, $this->more));
    }

    public function testMax()
    {
        $this->assertSame($this->more, Parity::max($this->value, $this->more));
        $this->assertSame($this->more, Parity::max($this->more, $this->value));
        $this->assertSame($this->more, Parity::max($this->value, $this->same, $this->less, $this->more));
    }

    /**
     * @dataProvider minSequenceData
     */
    public function testMinSequence($sequence, $default, $expected)
    {
        $this->assertSame(
            $expected,
            Parity::minSequence($sequence, $default)
        );
    }

    public function minSequenceData()
    {
        $value  = 0;
        $less   = -1;
        $same   = 0;
        $more   = 1;
        $object = new stdClass();

        $sequenceEmpty = array();

        $sequenceObjectAndNull = array(
            $object,
            null,
        );

        $sequenceNumber = array(
            $value,
            $less,
            $same,
            $more,
        );

        $sequenceMixed = array(
            $value,
            $less,
            $same,
            $more,
            $object,
            true,
            null,
        );

        return array(
            'Empty sequence, default null'             => array($sequenceEmpty,         null,    null),
            'Empty sequence, default object'           => array($sequenceEmpty,         $object, $object),
            'Empty sequence, default value'            => array($sequenceEmpty,         $value,  $value),

            'Object and null sequence, default null'   => array($sequenceObjectAndNull, null,    null),
            'Object and null sequence, default object' => array($sequenceObjectAndNull, $object, null),
            'Object and null sequence, default value'  => array($sequenceObjectAndNull, $value,  null),

            'Number sequence, default null'            => array($sequenceNumber,        null,    $less),
            'Number sequence, default object'          => array($sequenceNumber,        $object, $less),
            'Number sequence, default value'           => array($sequenceNumber,        $value,  $less),

            'Mixed sequence, default null'             => array($sequenceMixed,         null,    null),
            'Mixed sequence, default object'           => array($sequenceMixed,         $object, null),
            'Mixed sequence, default value'            => array($sequenceMixed,         $value,  null),
        );
    }

    /**
     * @dataProvider maxSequenceData
     */
    public function testMaxSequence($sequence, $default, $expected)
    {
        $this->assertSame(
            $expected,
            Parity::maxSequence($sequence, $default)
        );
    }

    public function maxSequenceData()
    {
        $value  = 0;
        $less   = -1;
        $same   = 0;
        $more   = 1;
        $object = new stdClass();

        $sequenceEmpty = array();

        $sequenceObjectAndNull = array(
            $object,
            null,
        );

        $sequenceNumber = array(
            $value,
            $less,
            $same,
            $more,
        );

        $sequenceMixed = array(
            $value,
            $less,
            $same,
            $more,
            $object,
            true,
            null,
        );

        return array(
            'Empty sequence, default null'             => array($sequenceEmpty,         null,    null),
            'Empty sequence, default object'           => array($sequenceEmpty,         $object, $object),
            'Empty sequence, default value'            => array($sequenceEmpty,         $value,  $value),

            'Object and null sequence, default null'   => array($sequenceObjectAndNull, null,    $object),
            'Object and null sequence, default object' => array($sequenceObjectAndNull, $object, $object),
            'Object and null sequence, default value'  => array($sequenceObjectAndNull, $value,  $object),

            'Number sequence, default null'            => array($sequenceNumber,        null,    $more),
            'Number sequence, default object'          => array($sequenceNumber,        $object, $more),
            'Number sequence, default value'           => array($sequenceNumber,        $value,  $more),

            'Mixed sequence, default null'             => array($sequenceMixed,         null,    $object),
            'Mixed sequence, default object'           => array($sequenceMixed,         $object, $object),
            'Mixed sequence, default value'            => array($sequenceMixed,         $value,  $object),
        );
    }

    public function testComparitor()
    {
        $comparator = Parity::comparator();
        $this->assertInstanceOf(__NAMESPACE__ . '\Comparator\ParityComparator', $comparator);

        $comparator = $comparator->fallbackComparator();
        $this->assertInstanceOf(__NAMESPACE__ . '\Comparator\DeepComparator', $comparator);

        $comparator = $comparator->fallbackComparator();
        $this->assertInstanceOf(__NAMESPACE__ . '\Comparator\StrictPhpComparator', $comparator);
    }
}
