@extends('layouts.default')

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="row">
				
				<div class="col-lg-4 mb-3">
					<div class="row justify-content-between">
						<div class="col-auto">
							<a href="{{ url('/statutory') }}"  class="btn btn-primary">
								<span data-toggle="tooltip" data-placement="top" title="Back">BACK</span>
							</a>
						</div>
					</div>
				</div>
					
				<div class="col-lg-8 col-md-8 col-sm-6">
					<div class="message-chat-sec">
					  <div class="message-head">
						<h4><i class="fa fa-comments"></i>Message to {{ isset($quotes->caName)?$quotes->caName:$quotes->compName }}</h4>
					  </div>
					  <div class="message-text-box customScrollBar chat_box allMassage">
							<div class="chat-messages chatConversationSection">
							  <!--<div class="chat-messages-time">
								<p><i class="fa fa-exclamation-triangle"></i></p>
							  </div>-->
								
								@foreach($quotes->messages as $message)
								
								<?php 
								//for same user
								if($message->from_user_id == Auth::user()->id)
								{
								
									if($message->attached !="")
									{
										$ext = pathinfo($message->attached, PATHINFO_EXTENSION);
										$filepath = asset('public/uploads/chat/'.$message->attached);
										if($ext =='jpeg' || $ext =='jpg' || $ext =='png')
										{
											$image_file = '<a href="'.$filepath.'" target="_blank"><img src="'.$filepath.'" alt=""></a>';
											echo '<div class="message-box-holder"><div class="message-user"><p>'.date('d-m-Y h:i A', strtotime($message->timestamp)).'</p></div><div class="message-box message-holder">'.$image_file.'</div></div>';
										}else{
											$image_file = '<a href="'.$filepath.'" target="_blank">'.$message->attached.' <i class="fa fa-download" aria-hidden="true"></i></a>';
											echo '<div class="message-box-holder"><div class="message-user"><p>'.date('d-m-Y h:i A', strtotime($message->timestamp)).'</p></div><div class="message-box message-holder">'.$image_file.'</div></div>';
										}
									} 
									if($message->chat_message !=""){
									?>
									<div class="message-box-holder">
										<div class="message-user">
										  <p>{{ date('d-m-Y h:i A', strtotime($message->timestamp)) }}</p>
										</div>
										<div class="message-box message-owner">
										  <p><i class="fa fa-check"></i>{{ $message->chat_message }}</p>
										</div>
									</div>
									<?php } ?>
								
								<?php } else { 
								
								//for different user
								if($message->attached !="")
									{
										$ext = pathinfo($message->attached, PATHINFO_EXTENSION);
										$filepath = asset('public/uploads/chat/'.$message->attached);
										if($ext =='jpeg' || $ext =='jpg' || $ext =='png')
										{
											$image_file = '<a href="'.$filepath.'" target="_blank"><img src="'.$filepath.'" alt=""></a>';
											echo '<div class="message-box-holder2"><div class="message-user"><p>'.date('d-m-Y h:i A', strtotime($message->timestamp)).'</p></div><div class="message-box message-holder">'.$image_file.'</div></div>';
										}else{
											$image_file = '<a href="'.$filepath.'" target="_blank">'.$message->attached.' <i class="fa fa-download" aria-hidden="true"></i></a>';
											echo '<div class="message-box-holder2"><div class="message-user"><p>'.date('d-m-Y h:i A', strtotime($message->timestamp)).'</p></div><div class="message-box message-holder">'.$image_file.'</div></div>';
										}
									} 
									if($message->chat_message !=""){
									?>
									<div class="message-box-holder2">
										<div class="message-user">
										  <p>{{ date('d-m-Y h:i A', strtotime($message->timestamp)) }}</p>
										</div>
										<div class="message-box message-owner">
										  <p><i class="fa fa-check"></i>{{ $message->chat_message }}</p>
										</div>
									</div>
									<?php } ?>
								
								<?php } ?>
								@endforeach
								
							</div>
					  </div>
								<div class="fileAttechment" id="file_prev_attachment_section" style="display: none;"></div>
								<form method="POST" action="javascript:void(0);" accept-charset="UTF-8" class="chat-form" id="chat-form" autocomplete="off" novalidate="novalidate">
									@csrf
									  @if(isset($quotes->caid))
									  <input type="hidden" name="to_user_id" id="to_user_id" value="{{ $quotes->caid }}">
									  @else
									  <input type="hidden" name="to_user_id" id="to_user_id" value="{{ $quotes->uid }}">
									  @endif
									  <input type="hidden" name="from_user_id" id="from_user_id" value="{{ Auth::user()->id }}">
									  <input type="hidden" name="c_qid" id="c_qid" value="{{ $quotes->id }}">
									  
										<?php if(Auth::user()->u_type ==1) { ?>
										  <div class="chat-input-holder" id="chat-widget-message-section">
											<input type="text" name="chat_message" id="chat-widget-message-text" class="form-control input-holder-style" placeholder="Message">
											<input type="hidden" name="message_file" id="chat-widget-message-file" value="">
											<a class="add-file" id="add_attachment_file" href="javascript:;" onclick="fetch_file()"><i class="fa fa-paperclip"></i></a>
											<button type="submit" id="chat-btn"><i class="fa fa-paper-plane"></i></button>
										  </div>
										<?php } ?>
										<?php if(!empty($quotes->messages) && Auth::user()->u_type ==2) { ?>
										  <div class="chat-input-holder" id="chat-widget-message-section">
											<input type="text" name="chat_message" id="chat-widget-message-text" class="form-control input-holder-style" placeholder="Message">
											<input type="hidden" name="message_file" id="chat-widget-message-file" value="">
											<a class="add-file" id="add_attachment_file" href="javascript:;" onclick="fetch_file()"><i class="fa fa-paperclip"></i></a>
											<button type="submit" id="chat-btn"><i class="fa fa-paper-plane"></i></button>
										  </div>
										<?php } ?>
									  
									  <div class="message-container"></div>
								</form>
								<!--<div class="support-time-tkt">
									<p>Actual waiting support time by tickets <span>1-3 hours</span></p>
								</div>-->
					</div>
					<!--<div class="ticket-close-btn">
					  <button type="button" class="ticket_close_btn" data-order_id="1">close ticket</button>
					</div>-->
				</div>
				
				<hr>
					
				<div style="display:none;"> 
					<form method="POST" action="javascript:void(0);" accept-charset="UTF-8" class="form-file-upload" id="form-file-upload" enctype="multipart/form-data">
						@csrf
					  <input name="attachment_file" id="attachment_file" style="display:none" onchange="preview_file(this.files)" type="file">
					</form>
				</div>
				
				
			</div>
        </div>
    </div>

    
@endsection
