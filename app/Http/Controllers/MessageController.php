<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Category;
use App\Brand;
use App\Product;
use Auth;
use Validator;
use App\User;
use App\Chat_messages;


use DB;
use Helper; 
use Image;

class MessageController extends Controller
{
	
	public function __construct(){
		//$this->middleware('auth');
		if(!Auth::user())
		{
			return redirect('/'); 
		}
	}
	
    public function index(Request $request)
    {
		
		
		
    }
	protected function validator(array $data)
    {
        return Validator::make($data, [
           'attachment_file' => 'mimes:pdf,xls,xlsx,doc,docx,jpeg,png,jpg|max:2048', 
        ]
		);
    }
	
	public function upload_file(Request $request)
	{
		//die("asdfas");
		/* $this->validate($request, [
			'attachment_file' => 'mimes:pdf,xls,xlsx,doc,docx,jpeg,png,jpg|max:2048',
			
        ]); */
		
		 $validation = $this->validator($request->all());
        if ($validation->fails())  {  
            return response()->json($validation->errors()->toArray());
        }else{
			
			$str ='';
			if($file = $request->hasFile('attachment_file')) {
				
				$file = $request->file('attachment_file') ;
				
				$fileName1 = date("YmdHis") . '-' . $file->getClientOriginalName() ;
				$destinationPath1 = public_path().'/uploads/chat/' ;
				
				$file->move($destinationPath1,$fileName1);
				
			    $filepath = asset('public/uploads/chat/'.$fileName1);
			  
				$ext = pathinfo($fileName1, PATHINFO_EXTENSION);
				if($ext =='jpeg' || $ext =='jpg' || $ext =='png')
				{
					$str .='<div class="fileAttechmentInner relative"> <img src="'.$filepath.'" alt=""> <a href="javascript:;"><span onclick="remove_image(event)" class="remove_attachment_file">x</span></a> </div><div class="clear"></div>';
				}else{
					$str .='<div class="fileAttechmentInnerText relative"> <a class="relative" href="'.$filepath.'" target="_blank">'.$fileName1.' <i class="fa fa-download" aria-hidden="true"></i><span onclick="remove_image(event)" class="remove_attachment_file">x</span></a>  </div><div class="clear"></div>';
				}
			}
			//echo $str; exit;
			
				$msg = array(
					'status' => 'success',
					'class' => 'succ',
					'redirect' => '',
					'message' => $str,
					'filename' => $fileName1
				);
				return response()->json($msg);
		}
		
		
	}
	
	public function insert_chat(Request $request)
    {

        $user_id = isset(Auth::user()->id)?Auth::user()->id:0;
        $to_user_id = $request->input('to_user_id');
        $chat_message = $request->input('chat_message');
        $message_file = $request->input('message_file');
        $c_qid = $request->input('c_qid');
		if($message_file =='undefined')
		{
			$message_file = '';
		}
		
		$str ='';
		$insert = DB::table('chat_messages')->insertGetId(
					 array(
							'to_user_id' => $to_user_id,
							'from_user_id' => $user_id,
							'chat_message' => $chat_message,
							'attached' => $message_file,
							'c_qid' => $c_qid,
							'status' => 0
						)
				);
				
		if($insert)
		{
		 //echo $this->fetch_user_chat_history($user_id, $to_user_id);
			$result = DB::table('chat_messages')
					->where('chat_message_id','=',$insert)
					->where('from_user_id','=',$user_id)
					->where('to_user_id','=',$to_user_id)
					->get()->toArray(); 
			
			if($result[0]->attached !=""){
				$ext = pathinfo($result[0]->attached, PATHINFO_EXTENSION);
				//print_r($ext);exit;
				$filepath = asset('public/uploads/chat/'.$result[0]->attached);
				if($ext =='jpeg' || $ext =='jpg' || $ext =='png')
				{
					$image_file = '<a href="'.$filepath.'" target="_blank"><img src="'.$filepath.'" alt=""></a>';
					$str .= '<div class="message-box-holder"><div class="message-user"><p>'.date('d-m-Y h:i A', strtotime($result[0]->timestamp)).'</p></div><div class="message-box message-holder">'.$image_file.'</div></div>';
				}else{
					$image_file = '<a href="'.$filepath.'" target="_blank">'.$result[0]->attached.' <i class="fa fa-download" aria-hidden="true"></i></a>';
					$str .= '<div class="message-box-holder"><div class="message-user"><p>'.date('d-m-Y h:i A', strtotime($result[0]->timestamp)).'</p></div><div class="message-box message-holder">'.$image_file.'</div></div>';
				}
				
			}
			if($result[0]->chat_message !=""){
				$str .= '<div class="message-box-holder"><div class="message-user"><p>'.date('d-m-Y h:i A', strtotime($result[0]->timestamp)).'</p></div><div class="message-box message-holder"><p><i class="fa fa-check"></i>'.$result[0]->chat_message.'</p></div></div>';
			}
			
			
		}
		
		$msg = array(
			'status' => 'success',
			'class' => 'succ',
			'redirect' => '',
			'message' => $str,
		);
		return response()->json($msg);

        
    }
	
	public function fetch_user_chat_history($from_user_id, $to_user_id)
	{
		$result = DB::table('chat_messages')
					->select(DB::raw('chat_messages.*'))
					->where([
						['from_user_id', '=', $from_user_id],
						['to_user_id', '=', $to_user_id],
					])
					->orwhere([
						['from_user_id', '=', $to_user_id],
						['to_user_id', '=', $from_user_id],
					])
					->orderBy('timestamp', 'asc')
					->get()->toArray(); 
					
		/* $result = DB::table('chat_message')
					->select(DB::raw("chat_message.chat_message_id,chat_message.to_user_id,chat_message.from_user_id,chat_message.chat_message,chat_message.timestamp  WHERE (from_user_id = '".$from_user_id."' AND to_user_id = '".$to_user_id."') OR (from_user_id = '".$to_user_id."' AND to_user_id = '".$from_user_id."') ORDER BY timestamp DESC"))
					->get()->toArray(); */

		//echo "<pre>";print_r($result);exit;
		 
		 $output = '<ul class="list-unstyled">';
		 foreach($result as $row)
		 {
			 
		  $user_name = '';
		  if($row->from_user_id == $from_user_id)
		  {
		   $user_name = '<b class="text-success">You</b>';
		  }
		  else
		  {
		   $user_name = '<b class="text-danger">'.$this->get_user_name($row->from_user_id).'</b>';
		  }
		  
		  //Start for attachement
		  if($row->attached !=""){
			  $filepath = asset('public/uploads/chat/'.$row->attached);
			  $showfile = '<div align="left">
							<a href="'.$filepath.'" target="_blank">'.$row->attached.'</a>
						</div>';
		  }else{
			  $showfile = '';
		  }
		  //End for attachement
		  
		  $output .= '
		  <li style="border-bottom:1px dotted #ccc">
		   <p>'.$user_name.' - '.$row->chat_message.'
		   
		   '.$showfile.'
			<div align="right">
			 - <small><em>'.$row->timestamp.'</em></small>
			</div>
		   </p>
		  </li>
		  ';
		 }
		 $output .= '</ul>';
		 return $output;
	}
	
	
	public function create()
    {
        //return view('products.create');
		
    }

  

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
		
       

    }

   

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */

    public function show(Product $product)
    {
		
    }

   

    /**

     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */

    public function edit(Product $product)
    {
		
    }
  

    /**

     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, Product $product)
    {
      
    }
  

    /**

     * Remove the specified resource from storage.

     *

     * @param  \App\Product  $product

     * @return \Illuminate\Http\Response

     */

    public function destroy(Product $product)
    {
      
    }
	
	
	


}
