<?php
namespace App\Http\Components\Backend;

use Atl\Routing\Controller as baseController;
use App\Http\Components\Backend\AdminDataMenu;
use App\Model\OptionModel;
use App\Model\NoticeModel;
use App\Model\UserModel;

class Controller extends baseController{
	
	protected $infoUser = [];

	public function __construct(){
		parent::__construct();

		$this->mdOption = new OptionModel;
		$this->mdNotice = new NoticeModel;
		$this->mdUser = new UserModel;
		$this->currentcyRate = $this->mdOption->getOption('currency_rate');
	}

	/**
	 * Load template default.
	 * 
	 * @param  string $path Template file name.
	 * @param  array $parameters Parameters for template.
	 * @return string
	 */
	public function loadTemplate( $path, $parameters = array(), $options = array() ){

		$pathFolder = '';

		if( isset( $options['path'] ) ) {
			$pathFolder = $options['path'];
		}

		$output = View(
			$pathFolder. 'layout/header.tpl'
		);

		// condition array and get list notice
		$condiNotice =  [ 'notice_status' => 1,
						  'notice_receiver' => Session()->get('avt_admin_user_id')
					    ];
		$listNotice = $this->mdNotice->getByArray( $condiNotice );
		$output .= View(
			$pathFolder. 'layout/menuNav.tpl',
			[
				'menuAdmin'  => AdminDataMenu::getInstance( $this->getRoute() ),
				'listNotice' => $listNotice,
				'totalNotice'=> count($listNotice),
				'mdUser'     => $this->mdUser
			]

		);
		$output .= View( $pathFolder . $path, $parameters );
		$output .= View(
					$pathFolder. 'layout/footer.tpl',
					[
					]
					);

		return $output;
	}

	/**
	 * Check curent access. login or not login.
	 * 
	 * @return void
	 */
	public function userAccess(){
		if (true !== Session()->has('avt_admin_user_id')) {
            redirect( url( '/admcp/login' ) );
        }
	}

	/**
	 * Handle render input form.
	 * 
	 * @param  array  $args Attr input
	 * @return string
	 */
	public function renderInput( $args = array() ){
        $atts = parametersExtra(
            array(
                'type'  => '',
                'name'  => '',
                'class' => '',
                'value' => '',
                'attr'  => array(),
            ),
            $args
        );

        $attrInput = '';
        foreach ($atts['attr'] as $key => $value) {
        	if( empty( $value ) ) {
        		$attrInput .= ' ' .$key. ' ';
        	}else{
        		$attrInput .= ' ' .$key . '="' . $value . '" ';
        	}
           
        }

        return '<input class="'.$atts['class'].'" type="'.$atts['type'].'" name="'.$atts['name'].'"  value="'.$atts['value'].'" '.$attrInput.'>';
    }

    /**
     * Handle chek is md5.
     * 
     * @param  string  $md5 String md5
     * @return boolean      
     */
    public function isValidMd5($md5 =''){
	    return preg_match('/^[a-f0-9]{32}$/', $md5);
	}

	/**
	 * Handle redirect to page 404
	 * 
	 * @param  string $route Link or router project
	 * @return void
	 */
	public function redirect404( $route ){
		redirect( url( '/error-404?url=' . $route ) );
	}


	/**
	 * convertDateToYmd 
	 * Handle format date.
	 * 
	 * @param  string $dateString Date string.
	 * @return string
	 */
	public function convertDateToYmd( $dateString ) {	
		return date( 'Y-m-d', strtotime( $dateString ) );		
	}

	public function slug($str, $is_url = false, $lower = true) {
        $str = strip_tags(trim($str));
        $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
        $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
        $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
        $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
        $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
        $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
        $str = preg_replace("/(Đ)/", 'D', $str);

        $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/i", 'a', $str);
        $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/i", 'e', $str);
        $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/i", 'i', $str);
        $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/i", 'o', $str);
        $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/i", 'u', $str);
        $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/i", 'y', $str);
        $str = preg_replace("/(đ)/i", 'd', $str);
        $str = preg_replace(array('#(amp;|quot;|;|-)#i', '#[^\w]+#i', '#[\s]+#iU'), '-', $str);
        $str = trim($str, '- ');
        $str = $lower ? strtolower($str) : $str;
        return $str;
    }

    public function autoCreatDataSheetEmpty(){
    	$data = [];
		for ($i = 0; $i <= 100; $i++) { 
			$data[] = [
					    null,
					    null,
					    null,
					    null,
					    null,
					    null,
					    null,
					    null,
					    null,
					    null,
					    null,
					    null,
					    null,
					    null,
					    null,
					    null
					 ];
		}

		return $data;
    }

    public function getCurrencyOnline(){
    	$currency = file_get_contents('http://www.xe.com/currencyconverter/convert/?Amount=1&From=CNY&To=VND');
		$currency = explode('<main class="wrapper">', $currency);
		$currency = explode('<footer id="footer">', $currency[1]);

		preg_match_all('/&lt;span class=\'uccResultAmount\'&gt;(.*)&lt;\/span&gt;&lt;span class=\'uccToCurrencyCode\'&gt;VND/i', htmlentities($currency[0]), $matches);

		$ex = explode('.', $matches[1][0]);
		$this->mdOption->setOption('currency_rate', str_replace(',', '',$ex[0] ));
		return str_replace(',', '',$ex[0] );
    }

    public function convertPriceToInt($price)
    {
        $newInt = $price;
        $newInt = str_replace('$', '', $newInt);
        $newInt = str_replace(',', '', $newInt);
        $newInt = str_replace('.00', '', $newInt);
        $newInt = trim($newInt);

        return $newInt;
    }
}