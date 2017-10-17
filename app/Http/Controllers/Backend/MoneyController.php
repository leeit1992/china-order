<?php

namespace app\Http\Controllers\Backend;

use Atl\Foundation\Request;
use App\Http\Components\ApiHandlePrice;
use App\Http\Components\Backend\Controller as baseController;
use App\Model\RechargeModel;
use App\Model\UserModel;
use App\Model\BankModel;

class MoneyController extends baseController
{
    public function __construct()
    {
        parent::__construct();
        $this->userAccess();

        $this->mdRecharge = new RechargeModel();
        $this->mdUser = new UserModel();
        $this->mdBank = new BankModel();
    }

    public function rechargeManage()
    {
        if (isset($_GET['status'])) {
            $listRecharge = $this->mdRecharge->getBy('status', $_GET['status']);
        } else {
            $listRecharge = $this->mdRecharge->getAll();
        }

        $this->loadTemplate('recharge/recharge-manage.tpl', [
            'listRecharge' => $listRecharge,

            'listRechargeOke' => $this->mdRecharge->getBy('status', 2),
            'listRechargeNotOke' => $this->mdRecharge->getBy('status', 1),

            'apiHandlePrice' => ApiHandlePrice::getInstance(),
        ], ['path' => 'backend/']);
    }

    public function recharge($id = null)
    {
        $info = [];
        if ($id) {
            $info = $this->mdRecharge->getBy('id', $id);
        }

        $this->loadTemplate('recharge/recharge.tpl', [
            'rechargeId' => $id,
            'infoData' => $info,
            'mdUser' => $this->mdUser,
            'mkBank' => $this->mdBank,
            'noticeRecharge' => Session()->getFlashBag()->get('rechargeNotice'),
            'apiHandlePrice' => ApiHandlePrice::getInstance(),
        ], ['path' => 'backend/']);
    }

    public function rechargeValidate(Request $request)
    {
        if ($request->get('avt_recharge_id')) {
            $currentData = $this->mdRecharge->getBy('id', $request->get('avt_recharge_id'));
            $userRecharge = $this->mdUser->getUserBy('id', $currentData[0]['user_id']);
            $currentPrice = $userRecharge[0]['user_money'];

            $this->mdRecharge->save(
                [
                    'status' => 2,
                ],
                $request->get('avt_recharge_id')
            );

            $this->mdUser->save([
                'user_money' => $currentPrice + $currentData[0]['price'],
            ], $currentData[0]['user_id']);

            Session()->getFlashBag()->set('rechargeNotice', ['type' => true, 'notice' => 'Duyệt khoản nạp thành công.']);
        }

        redirect(url('/admcp/recharge/'.$request->get('avt_recharge_id')));
    }

    public function managePay()
    {
        $listBank = $this->mdBank->getAll();

        $this->loadTemplate('recharge/info-pay.tpl', [
            'listBank' => $listBank,
            'noticeAddBank' => Session()->getFlashBag()->get('noticeAddBank'),
        ], ['path' => 'backend/']);
    }

    public function addPayValidate(Request $request)
    {
        $this->mdBank->save([
            'bank_name' => $request->get('avt_bank_name'),
            'bank_user_name' => $request->get('avt_bank_user_name'),
            'bank_number' => $request->get('avt_bank_number'),
            'bank_address' => $request->get('avt_bank_address'),
        ]);

        Session()->getFlashBag()->set('noticeAddBank', ['type' => true, 'notice' => 'Thêm thông tin thanh toán thành công.']);

        redirect(url('/admcp/info-pay'));
    }

    public function removeRecharge(Request $request){
        
    }
}
