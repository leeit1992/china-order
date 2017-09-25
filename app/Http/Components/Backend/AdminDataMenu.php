<?php

namespace App\Http\Components\Backend;

/**
 * adminDataMenu
 * Config data menu nav admin.
 *
 * @version  1.0
 * @author  HaLe 
 * @package  ATL
 */
class AdminDataMenu
{   
    /**
     * $getInstance - Support singleton module.
     * @var null
     */
    private static $getInstance = null;

    protected static $route = null;

    private function __wakeup()
    {
    }

    private function __clone()
    {
    }

    private function __construct()
    {
    }

    public static function getInstance( $route = null )
    {
        if (!(self::$getInstance instanceof self)) {
            self::$getInstance = new self();
        }

        self::$route = $route;

        return self::$getInstance;
    }

    /**
     * dataMenu
     * Data menu action admin.
     */
    public function dataMenu()
    {   
        return [
            'Dashboard' => [
                'label' => 'Dashboard',
                'icon'  => '<i class="icon-home"></i>',
                'conditionOpen' => ['Frontend\MainController'],
                'display' => '',
                'link'  => url('/user-tool'),
                'display' => '',
            ],

            'cart' => [
                'label'   => 'Đơn Hàng',
                'icon'    => '<i class="fa fa-opencart"></i>',
                'conditionOpen' => ['Backend\OrderController'],
                'display' => '',
                'submenu' => [
                    [
                        'label' => 'Quản lý đơn hàng',
                        'link'  => url('/admcp/order-manage'),
                        'display' => '',
                        'conditionOpen' => ['orderManage'],
                    ]
                ]
            ],

            'recharge' => [
                'label'   => 'Tài chính',
                'icon'    => '<i class="fa fa-opencart"></i>',
                'conditionOpen' => ['Backend\MoneyController'],
                'display' => '',
                'submenu' => [
                    [
                        'label' => 'Quản lý tài chính',
                        'link'  => url('/admcp/recharge-manage'),
                        'display' => '',
                        'conditionOpen' => ['rechargeManage'],
                    ],
                     [
                        'label' => 'Quản lý thông tin thanh toán',
                        'link'  => url('/admcp/info-pay'),
                        'display' => '',
                        'conditionOpen' => ['managePay'],
                    ]
                ]
            ],


            'member' => [
                'label'   => 'Thành viên',
                'icon'    => '<i class="fa fa-opencart"></i>',
                'conditionOpen' => ['Frontend\CartController','Frontend\OrderController'],
                'display' => '',
                'submenu' => [
                    [
                        'label' => 'Quản lý thành viên',
                        'link'  => url('/admcp/user-manage'),
                        'display' => '',
                        'conditionOpen' => ['orderManage'],
                    ]
                ]
            ],

            'user' => [
                'label'   => 'Tài khoản',
                'icon'    => '<i class="fa fa-opencart"></i>',
                'conditionOpen' => [''],
                'display' => '',
                'submenu' => [
                    [
                        'label' => 'Đổi mật khẩu',
                        'link'  => url('/admcp/change-pass'),
                        'display' => '',
                        'conditionOpen' => ['orderManage'],
                    ]
                ]
            ]
        ];
    }

    /**
     * Render menu html.
     * 
     * @return string
     */
    public function menuNav(){   
        $control = self::$route['_controller'];
        $action  = self::$route['_action'];
    ?>

    <div>
        <ul class="list-unstyled">
            <?php 
            foreach ( $this->dataMenu() as $key => $value ): 
                $id = uniqid();
            ?>

            <?php if( !isset( $value['submenu'] ) && 'none' !== $value['display'] ): ?>
            <li <?php echo ( in_array( $control, $value['conditionOpen'] ) ) ? 'class="active"' : '' ?> title="Dashboard">
                <a href="<?php echo $value['link'] ?>">
                    <span class="menu_icon"><?php echo $value['icon'] ?></span>
                    <span class="menu_title"><?php echo $value['label'] ?></span>
                </a>
            </li>
            <?php endif; ?>

            <?php if( isset( $value['submenu'] ) && 'none' !== $value['display'] ): ?>
            <li>
                <?php 
                    if( in_array( $control, $value['conditionOpen'] ) ) {
                        echo '<a href="#dashvariants-'.$id.'" aria-expanded="true" data-toggle="collapse" class="">';
                    }else{
                        echo '<a href="#dashvariants-'.$id.'" aria-expanded="false" data-toggle="collapse" class="collapsed">';
                    } 
                ?>

                    <span class="menu_icon"><?php echo $value['icon'] ?></span>
                    <span class="menu_title"> <?php echo $value['label'] ?></span>
                </a>
                
                <ul id="dashvariants-<?php echo $id ?>" class="collapse list-unstyled <?php echo ( in_array( $control, $value['conditionOpen'] ) ) ? 'show' : '' ?>">

                    <?php foreach ($value['submenu'] as $submenu): ?>
                    <?php if( 'none' !== $submenu['display'] ): ?>
                    <li <?php echo ( in_array( $action, $submenu['conditionOpen'] ) ) ? 'class="act_item submenu_trigger act_section"' : '' ?>>
                        <a href="<?php echo $submenu['link'] ?>"> 
                            <?php echo $submenu['label'] ?>
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
            </li>
            <?php endif; ?>

            <?php endforeach; ?>  
        </ul>
    </div>
    <?php
    }
}
