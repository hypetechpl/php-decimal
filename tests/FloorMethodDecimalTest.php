<?php
namespace Piggly\Test\Decimal;

use PHPUnit\Framework\TestCase;
use Piggly\Decimal\Decimal;
use Piggly\Decimal\DecimalConfig;

class FloorMethodDecimalTest extends TestCase
{
	/**
	 * Configuration
	 *
	 * @var DecimalConfig
	 */
	protected $_config;

	protected function setUp () : void
	{
		$this->_config = DecimalConfig
			::instance()
			->set([
				'precision' => 20,
				'rounding' => 4,
				'toExpNeg' => -1e3,
				'toExpPos' => 1e3,
				'maxE' => 9e15,
				'minE' => -9e15,
			]);
	}

	/**
	 * Assert if is matching the expected data.
	 *
	 * @test Expecting positive assertion
    * @dataProvider dataSetOne
	 * @param array $coefficient
	 * @param integer $exponent
	 * @param integer $sign
	 * @param Decimal|integer|float|string $n
	 * @return void
	 */
	public function testSetOne (
		$expected,
		$number
	)
	{ $this->assertEquals($expected, (new Decimal($number))->floor()->valueOf()); }

	/**
	 * Assert if is matching the expected data.
	 *
	 * @test Expecting positive assertion
    * @dataProvider dataSetTwo
	 * @param array $coefficient
	 * @param integer $exponent
	 * @param integer $sign
	 * @param Decimal|integer|float|string $n
	 * @return void
	 */
	public function testSetTwo (
		$expected,
		$number
	)
	{ 
		DecimalConfig::instance()->set(['toExpNeg' => -100, 'toExpPos' => 100]);
		$this->assertEquals($expected, (new Decimal($number))->floor()->valueOf()); 
	}
		
	/**
	 * Provider for testSetOne().
	 * @return array
	 */
	public function dataSetOne() : array
	{
		return [
			['0', 0],
			['-0', '-0'],
			['0', '0.000'],
			['INF', INF],
			['-INF', -INF],
			['NAN', NAN],

			['0', 0.1],
			['0', '0.49999999999999994'],
			['0', 0.5],
			['0', 0.7],
			['-1', -0.1],
			['-1', '-0.49999999999999994'],
			['-1', -0.5],
			['-1', -0.7],
			['1', 1],
			['1', 1.1],
			['1', 1.5],
			['1', 1.7],
			['-1', -1],
			['-2', -1.1],
			['-2', -1.5],
			['-2', -1.7],

			['1', '1.0000000000000000000000001'],
			['0', 0.999999999999],
			['9', '9.999999999999'],
			['123456', 123456.789],
			['-2', '-1.0000000000000000000000001'],
			['-1', -0.999999999999],
			['-10', '-9.999999999999'],
			['-123457', -123456.789],

			['-2075365', '-2075364.364286541923'],
			['60593539780450631', '60593539780450631'],
			['65937898671515', '65937898671515'],
			['-39719494751819198566799', '-39719494751819198566798.578'],
			['92627382695288166556', '92627382695288166556.8683774524284866028260448205069'],
			['-881574', '-881574'],
			['-3633239210', '-3633239209.654526163275621746013315304191073405508491056'],
			['-23970335459820625362', '-23970335459820625362'],
			['131869457416154038', '131869457416154038'],
			['-2685', '-2685'],
			['-4542227861', '-4542227860.9511298545226'],
			['-834103872107533086', '-834103872107533086'],
			['-1501493189970436', '-1501493189970435.74866616700317'],
			['70591', '70591.2244675522123484658978887'],
			['4446128540401735117', '4446128540401735117.435836700611264749985822486641350492901'],
			['-597273', '-597273'],
			['729117', '729117.5'],
			['-729118', '-729117.001'],
			['4803729546823170064608098091', '4803729546823170064608098091'],
			['-6581532150677269472830', '-6581532150677269472829.38194951340848938896000325718062365494'],
			['2949426983040959', '2949426983040959.8911208825380208568451907'],
			['25166', '25166.125888418871654557352055849116604612621573251770362'],
			['4560569286495', '4560569286495.98300685103599898554605198'],
			['13', '13.763105480576616251068323541559825687'],
			['9050999219306', '9050999219306.7846946346757664893036971777'],
			['39900924', '39900924.00000005'],
			['115911043168452445', '115911043168452445'],
			['20962819101135667464733349383', '20962819101135667464733349383.8959025798517496777183'],
			['4125789711001606948191', '4125789711001606948191.4707575965791242737346836'],
			['-6935502', '-6935501.294727166142750626019282'],
			['-2', '-1.518418076611593764852321765899'],
			['-35416', '-35416'],
			['6912783515683955988122411164548', '6912783515683955988122411164548.393'],
			['657', '657.0353902852'],
			['0', '0.00000000000000000000000017921822306362413915'],
			['1483059355427939255846407887', '1483059355427939255846407887.011361095342689876'],
			['7.722e+999999999999999', '7.722e+999999999999999'],
			['7722', '7722'],
			['0', '0.00000005'],
			['8551283060956479352', '8551283060956479352.5707396'],
			['0', '0.000000000000000000000000019904267'],
			['321978830777554620127500539', '321978830777554620127500539.339278568133088682532238002577'],
			['2073', '2073.532654804291079327244387978249477171032485250998396'],
			['677676305591', '677676305591.2'],
			['39181479479778357', '39181479479778357'],
			['0', '0.00000000000000000087964700066672916651'],
			['115083055948552475', '115083055948552475'],
			['9105942082143427451223', '9105942082143427451223'],
			['0', '0.00000000000000000000004'],
			['0', '0.000250427721966583680168028884692015623739'],
			['0', '0.000000000001585613219016120158734661293405081934'],
			['0', '0.00009'],
			['0', '0.000000090358252973411013592234'],
			['276312604693909858427', '276312604693909858427.21965306055697011390137926559'],
			['0', '0.0000252'],
			['1', '1.9999999999'],
		];
	}

	
	/**
	 * Provider for testSetTwo().
	 * @return array
	 */
	public function dataSetTwo() : array
	{
		return [
			['-1', -1e-308],
			['-1e+308', -1e308],
			['2.1e+308', '2.1e308'],
			['-1', '-1e-999'],
			['0', '1e-999'],
			['0', '1e-9000000000000000'],
			['-1', '-1e-9000000000000000'],
			['-0', '-9.9e-9000000000000001'],
			['9.999999e+9000000000000000', '9.999999e+9000000000000000'],
			['-9.999999e+9000000000000000', '-9.999999e+9000000000000000'],
			['INF', '1E9000000000000001'],
			['-INF', '-1e+9000000000000001'],
			['5.5879983320336874473209567979e+287894365', '5.5879983320336874473209567979e+287894365'],
			['-5.5879983320336874473209567979e+287894365', '-5.5879983320336874473209567979e+287894365'],
		];
	}
}