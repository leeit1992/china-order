<?php
namespace App\Http\Components;

class ApiHandlePrice 
{
	/**
     * $getInstance - Support singleton module.
     * @var null
     */
    private static $getInstance = null;

	private function __wakeup(){}

    private function __clone(){}

    private function __construct(){}

    public static function getInstance()
    {
        if (!(self::$getInstance instanceof self)) {
            self::$getInstance = new self();
        }

        return self::$getInstance;
    }

	/**
	 * formatPrice
	 * Handle display price for setting.
	 * 
	 * @param  int $price Prices need to be format.
	 * @return string
	 */
	public function formatPrice( $price = 0, $currency = '¥' ){
		global $apbSettings;

		$currencyPos = 'right_space';
		switch ( $currencyPos ) {
			case 'left':
				$priceFormat = '%2$s%1$s';
			break;

			case 'right':
				$priceFormat = '%1$s%2$s';
			break;

			case 'left_space':
				$priceFormat = '%2$s&nbsp;%1$s';
			break;

			case 'right_space':
				$priceFormat = '%1$s&nbsp;%2$s';
			break;
		}

		$args = array(
			'currency'          => $currency,
			'thousandSeparator' => ',',
			'decimalSeparator'  => '.',
			'decimals'          => 2,
			'priceFormat'       => $priceFormat,
		);

		extract( $args );
		$price = number_format( $price, $decimals, $decimalSeparator, $thousandSeparator );

		return sprintf( $priceFormat, $price, $currency );
	}

	public function convertPriceToInt( $price ){
		$newInt = $price;
        $newInt = str_replace("$", "", $newInt);
        $newInt = str_replace(",", "", $newInt);
        $newInt = str_replace(".00", "", $newInt);
        $newInt = trim($newInt);

        return $newInt;
	}
	public function convertStringPriceToInt( $string ){
		$arr = json_decode($string, true);
		$newArr = array();
		if (is_array($arr) || is_object($arr))
		{
			foreach ($arr as $k => $items) {
				foreach ($items as $key => $value) {
					if ($key == 'price') {
						$newArr[$k][$key] = $this->convertPriceToInt($value);
					}else{
						$newArr[$k][$key] = $value;
					}
				}
			}
		}
		return json_encode($newArr);
	}
	public function convertPriceStringRoomCruiseToInt( $string ){
		$arr = json_decode($string, true);
		$newArr = array();
		foreach ($arr as $k => $items) {
			foreach ($items as $key => $value) {
				if ($key == ( 'single' || 'double' || 'other')) {
					$newArr[$k][$key] = $this->convertPriceToInt($value);
				}else{
					$newArr[$k][$key] = $value;
				}
			}
		}
		return json_encode($newArr);
	}
}
