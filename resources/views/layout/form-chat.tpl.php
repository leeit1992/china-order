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
        <div class="card-header d-flex align-items-center" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
            <h3 class="h4">Admin</h3>
        </div>
        <div class="panel-collapse collapse" id="collapseOne">
            <div class="card-body">
                <ul class="chat">
                    <li class="left clearfix">
                        <span class="chat-img pull-left">
                            <img src="http://placehold.it/50/55C1E7/fff&text=U" alt="User Avatar" class="img-circle" />
                        </span>
                        <div class="chat-body clearfix">
                            <div class="header">
                                <strong class="primary-font">Jack Sparrow</strong> 
                                    <small class="pull-right text-muted">
                                        <span class="glyphicon glyphicon-time"></span>12 mins ago
                                    </small>
                            </div>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                            </p>
                        </div>
                    </li>
                    <li class="right clearfix">
                        <span class="chat-img pull-right">
                            <img src="http://placehold.it/50/FA6F57/fff&text=ME" alt="User Avatar" class="img-circle" />
                        </span>
                        <div class="chat-body clearfix">
                            <div class="header">
                                <small class=" text-muted"><span class="glyphicon glyphicon-time"></span>13 mins ago</small>
                                <strong class="pull-right primary-font">Bhaumik Patel</strong>
                            </div>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                            </p>
                        </div>
                    </li>
                    <li class="left clearfix">
                        <span class="chat-img pull-left">
                            <img src="http://placehold.it/50/55C1E7/fff&text=U" alt="User Avatar" class="img-circle" />
                        </span>
                        <div class="chat-body clearfix">
                            <div class="header">
                                <strong class="primary-font">Jack Sparrow</strong> <small class="pull-right text-muted">
                                    <span class="glyphicon glyphicon-time"></span>14 mins ago</small>
                            </div>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                            </p>
                        </div>
                    </li>
                    <li class="right clearfix">
                        <span class="chat-img pull-right">
                            <img src="http://placehold.it/50/FA6F57/fff&text=ME" alt="User Avatar" class="img-circle" />
                        </span>
                        <div class="chat-body clearfix">
                            <div class="header">
                                <small class=" text-muted"><span class="glyphicon glyphicon-time"></span>15 mins ago</small>
                                <strong class="pull-right primary-font">Bhaumik Patel</strong>
                            </div>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                            </p>
                        </div>
                    </li>
                    <li class="left clearfix">
                        <span class="chat-img pull-left">
                            <img src="http://placehold.it/50/55C1E7/fff&text=U" alt="User Avatar" class="img-circle" />
                        </span>
                        <div class="chat-body clearfix">
                            <div class="header">
                                <strong class="primary-font">Jack Sparrow</strong> 
                                    <small class="pull-right text-muted">
                                        <span class="glyphicon glyphicon-time"></span>12 mins ago
                                    </small>
                            </div>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                            </p>
                        </div>
                    </li>
                    <li class="right clearfix">
                        <span class="chat-img pull-right">
                            <img src="http://placehold.it/50/FA6F57/fff&text=ME" alt="User Avatar" class="img-circle" />
                        </span>
                        <div class="chat-body clearfix">
                            <div class="header">
                                <small class=" text-muted"><span class="glyphicon glyphicon-time"></span>13 mins ago</small>
                                <strong class="pull-right primary-font">Bhaumik Patel</strong>
                            </div>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                            </p>
                        </div>
                    </li>
                    <li class="left clearfix">
                        <span class="chat-img pull-left">
                            <img src="http://placehold.it/50/55C1E7/fff&text=U" alt="User Avatar" class="img-circle" />
                        </span>
                        <div class="chat-body clearfix">
                            <div class="header">
                                <strong class="primary-font">Jack Sparrow</strong> <small class="pull-right text-muted">
                                    <span class="glyphicon glyphicon-time"></span>14 mins ago</small>
                            </div>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                            </p>
                        </div>
                    </li>
                    <li class="right clearfix">
                        <span class="chat-img pull-right">
                            <img src="http://placehold.it/50/FA6F57/fff&text=ME" alt="User Avatar" class="img-circle" />
                        </span>
                        <div class="chat-body clearfix">
                            <div class="header">
                                <small class=" text-muted"><span class="glyphicon glyphicon-time"></span>15 mins ago</small>
                                <strong class="pull-right primary-font">Bhaumik Patel</strong>
                            </div>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                            </p>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="card-footer">
                <div class="input-group">
                    <input id="btn-input-chat" type="text" class="form-control input-sm avt-chat-input" placeholder="Type your message here..." />
                    <span class="input-group-btn">
                        <button class="btn btn-warning btn-sm" id="btn-send-chat">
                            Send</button>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
