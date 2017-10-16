<?php
namespace app\Http\Controllers\Backend;

use Atl\Foundation\Request;
use App\Http\Components\Backend\Controller as baseController;


class ChatController extends baseController{

	public function __construct()
    {
        parent::__construct();
        $this->userAccess();

    }

    public function addChat(Request $request){
    	if($request->get('orderId')) {
    		$dir = FOLDER_UPLOAD . '/chat-data/chat-order-' . $request->get('orderId'). '.txt';

    		if (!file_exists($dir)) {
    			$myfile = fopen($dir, "w+") or die("Unable to open file!");
	    		fwrite($myfile, json_encode(
	    			[ 
	    				[ 
	    					'orderId' => $request->get('orderId'),
	    					'mes' => $request->get('mes'),
	    					'dateTime' => date('Y-m-d H:s:j'),
	    					'userId' => Session()->get('avt_admin_user_id'),
	    					'userName' => Session()->get('avt_admin_user_name'),
	    				] 
	    			]
	    		));
				fclose($myfile);
    		}else{
    			$currentData = json_decode(file_get_contents($dir), true);
    			$currentData[] = [ 
					'orderId' => $request->get('orderId'),
					'mes' => $request->get('mes'),
					'dateTime' => date('Y-m-d H:s:j'),
					'userId' => Session()->get('avt_admin_user_id'),
					'userName' => Session()->get('avt_admin_user_name'),
				];

				$myfile = fopen($dir, "w+") or die("Unable to open file!");
	    		fwrite($myfile, json_encode($currentData));
				fclose($myfile);
    		}
    	}
    }

    public function getDataChat(Request $request){
    	if($request->get('orderId')) {
    		$dir = FOLDER_UPLOAD . '/chat-data/chat-order-' . $request->get('orderId'). '.txt';
    		$currentData = json_decode(file_get_contents($dir), true);
    		ob_start();
    		?>
    		 <?php 
                    foreach ($currentData as $value): 
                        $chatAction = 'left';

                        $img = 'http://placehold.it/50/55C1E7/fff&amp;text=U';
                        if( Session()->get('avt_admin_user_id') == $value['userId'] ) {
                            $chatAction = 'right';
                            $img = 'http://placehold.it/50/FA6F57/fff&amp;text=ME';
                        }
                    ?>
                    <li class="<?php echo $chatAction ?> clearfix">
                        <span class="chat-img pull-<?php echo $chatAction ?>">
                            <img src="<?php echo $img ?>" alt="User Avatar" class="img-circle" />
                        </span>
                        <div class="chat-body clearfix">
                            <div class="header">
                                <?php 
                                if( Session()->get('avt_admin_user_id') == $value['userId'] ) {
                                    ?>
                                    <strong class="pull-<?php echo $chatAction ?> primary-font"><?php echo $value['userName'] ?></strong> 
                                    <small class="text-muted">
                                        <span class="glyphicon glyphicon-time"></span><?php echo $value['dateTime'] ?>
                                    </small>
                                    <?php
                                }else{
                                    ?>
                                    <small class="pull-right text-muted">
                                        <span class="glyphicon glyphicon-time"></span><?php echo $value['dateTime'] ?>
                                    </small>
                                    <strong class="primary-font"><?php echo $value['userName'] ?></strong> 
                                    <?php
                                }
                                ?>
                            </div>
                            <p>
                                <?php echo $value['mes'] ?>
                            </p>
                        </div>
                    </li>
                    
                    <?php endforeach; ?>
    		<?php

    		$output = ob_get_clean();

    		echo json_encode(['html' => $output]);
    	}
    }

}