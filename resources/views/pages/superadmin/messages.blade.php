@extends('layouts.default')
@section('content')

    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="chat-window">
                        <div class="chat-cont-left">
                            

                            


                            
                        </div>
                        <div class="chat-cont-right">
                            <div class="chat-header">
                                <div class="media d-flex">
                                    <div class="media-body">
                                        <div class="user-name">Send Message To : {{ $comp_name }}</div>
										
                                    </div>
                                </div>
                            </div>
                            <div class="chat-body">
                                <div class="chat-scroll">
                                    <ul class="list-unstyled">
                                        <li class="media sent">
                                            
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="chat-footer">
								<form action="javascript:void(0);" method="post" name="adminMessageFrm" id="adminMessageFrm" enctype="multipart/form-data">
								<input type="hidden" name="uid" id="uid" value="{{ $uid }}" />
								@csrf
								<div class="message-container"></div>
								<div id="addMsgLoader" class="loader"></div>
					
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <!--<div class="btn-file btn">
                                            <i class="fas fa-paperclip"></i>
                                            <input type="file">
                                        </div>-->
                                    </div>
                                    <textarea rows="5" cols="5" class="form-control" name="messageText" id="messageText" placeholder="Enter message here" style="border-radius:0px"></textarea>
                                    <div class="input-group-append">
                                        <button type="submit" class="btn msg-send-btn" id=""><i class="fas fa-paper-plane"></i></button>
                                    </div>
                                </div>
								</form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
