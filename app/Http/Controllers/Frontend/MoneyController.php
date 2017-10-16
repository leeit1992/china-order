<?php

namespace app\Http\Controllers\Frontend;

use Atl\Foundation\Request;
use App\Http\Components\ApiHandlePrice;
use App\Http\Components\Frontend\Controller as baseController;
use App\Model\RechargeModel;
use Atl\Validation\Validation;
use App\Model\BankModel;
use App\Model\ExpenditureModel;
use App\Model\OrderModel;

class MoneyController extends baseController
{
    public function __construct()
    {
        parent::__construct();
        $this->userAccess();

        $this->mdRecharge = new RechargeModel();
        $this->mdBank = new BankModel();
        $this->mdExpenditure = new ExpenditureModel();
        $this->mdOrder = new OrderModel();
    }

    public function rechargeManage()
    {
        $listRecharge = $this->mdRecharge->getAll();
        $total_price = 0;
        foreach ($listRecharge as $items) {
            if ($items['status'] == 2 && is_numeric($items['price'])) {
                $total_price += $items['price'];
            }
        }
        $this->loadTemplate('recharge/recharge-manage.tpl', [
            'listRecharge' => $listRecharge,
            'total_price' => $total_price,
            'apiHandlePrice' => ApiHandlePrice::getInstance(),
        ], ['path' => 'frontend/userTool/']);
    }

    public function recharge()
    {
        $this->loadTemplate('recharge/recharge.tpl', [
            'noticeRecharge' => Session()->getFlashBag()->get('rechargeNotice'),
            'mkBank' => $this->mdBank,
        ], ['path' => 'frontend/userTool/']);
    }

    public function rechargeValidate(Request $request)
    {
        $validator = new Validation();
        $validator->add(
            [
                'avt_recharge_name:Name' => 'required',
                'avt_recharge_date:Date' => 'required',
                'avt_recharge_price:Password' => 'required',
            ]
        );

        if ($validator->validate($_POST)) {
            $this->mdRecharge->save([
                'name' => $request->get('avt_recharge_name'),
                'date' => $request->get('avt_recharge_date'),
                'price' => $request->get('avt_recharge_price'),
                'type' => $request->get('avt_recharge_type'),
                'bank_id' => $request->get('avt_recharge_bank'),
                'note' => $request->get('avt_recharge_note'),
                'user_id' => Session()->get('avt_user_id'),
                'status' => 1,
                'code' => date('Y-m-d').'-'.substr(uniqid(), 7, 5),
            ]);
            Session()->getFlashBag()->set('rechargeNotice', ['type' => true, 'notice' => 'Ghi nạp thành công. Hãy đợi chúng tôi kiểm tra !']);
        } else {
            Session()->getFlashBag()->set('rechargeNotice', ['type' => false, 'notice' => 'Bạn phải điền đầy đủ thông tin để có thể nạp tiền !']);
        }

        redirect(url('/user-tool/recharge'));
    }

    public function revenueExpenditure()
    {
        $listData = $this->mdExpenditure->getAll();
        $total_rest_payment = 0;
        foreach ($listData as $items) {
            if (is_numeric($items['rest_payment'])) {
                $total_rest_payment += $items['rest_payment'];
            }
        }
        $this->loadTemplate('recharge/revenue-expenditure.tpl', [
            'apiHandlePrice' => ApiHandlePrice::getInstance(),
            'listData' => $listData,
            'total_rest_payment' => $total_rest_payment,
            'mdOrder' => $this->mdOrder,
        ], ['path' => 'frontend/userTool/']);
    }

    /**
     * Handle filter revenue Expen
     * 
     * @param  Request $request POST | GET
     * @return json
     */
    public function ajaxRevenueExpenManage(Request $request)
    {
        $output = '';
        if( !empty( $request->get('formData') ) ) {
            parse_str($request->get('formData'), $formData);
            ob_start();
            $output .= View(
                'frontend/userTool/recharge/revenue-expenditureJs.tpl',
                [
                    'revenueExpenes'  => $this->mdExpenditure->searchByUserT( $formData ),
                    'apiHandlePrice' => ApiHandlePrice::getInstance(),
                    'mdOrder' =>  $this->mdOrder,
                ]
            );
            $output .= ob_get_clean();
        }
        echo json_encode( 
            [
                'output' => $output
            ]
        );
    }
}
