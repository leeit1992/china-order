<style type="text/css">
.chat
{
    list-style: none;
    margin: 0;
    padding: 0;
}

.chat li
{
    margin-bottom: 10px;
    padding-bottom: 5px;
    border-bottom: 1px dotted #B3A9A9;
}

.chat li.left .chat-body
{
    margin-left: 60px;
    padding-bottom: 15px;
}

.chat li.right .chat-body
{
    margin-right: 60px;
    padding-bottom: 15px;
}


.chat li .chat-body p
{
    margin: 0;
    color: #777777;
    font-size: 13px;
}

.chat-img > img{
    border-radius: 50%;
    max-width: 100%;
}
.avt-form-chat {
    position: fixed;
    bottom: -6%;
    right: 2.4%;
    width: 50%;
    z-index: 999;
    
}
.avt-form-chat .card-header{
    background: #292b2c;
    color: white;
    cursor: pointer;
}
.avt-form-chat .card-body{
    overflow-y: scroll;
    height: 350px;
}

.chat-img.pull-left, .chat-img.pull-right {
    width: 40px;
    height: 10px;
}

.chat .primary-font{
    font-size: 12px;
}
.avt-chat-input{
    font-size: 13px;
}

::-webkit-scrollbar-track
{
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
    background-color: #F5F5F5;
}

::-webkit-scrollbar
{
    width: 12px;
    background-color: #F5F5F5;
}

::-webkit-scrollbar-thumb
{
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
    background-color: #555;
}
</style>

<div id="avt-form-chat" class="avt-form-chat">
    <div class="card">
        <div class="card-header d-flex align-items-center avt-chat-hide-head" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
            <h3 class="h4">Admin</h3>
        </div>
        <div class="panel-collapse collapse" id="collapseOne">
            <div class="card-body">
                <ul class="chat">
                    <?php 
                    foreach ($mesData as $value): 
                        $chatAction = 'left';

                        $img = 'http://placehold.it/50/55C1E7/fff&amp;text=U';
                        if( $dataUser['userID'] == $value['userId'] ) {
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
                                if( $dataUser['userID'] == $value['userId'] ) {
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
                </ul>
            </div>
            <div class="card-footer">
                <div class="input-group">
                    <input id="btn-input-chat" type="text" user-name="<?php echo Session()->get('avt_user_name') ?>" order-id="<?php echo $orderID ?>" class="form-control input-sm avt-chat-input" placeholder="Type your message here..." />
                    <span class="input-group-btn">
                        <button class="btn btn-warning btn-sm" id="btn-send-chat">
                            Send</button>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
