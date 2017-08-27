<!-- jQuery -->
		<script src="https://code.jquery.com/jquery.js"></script>
		<!-- Bootstrap JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
		<script src="js/sendMessage.js"></script>

		<script src="js/trip.js"></script>
				<script src="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css"></script>

		<!-- Search All Users Modal -->
		<div class="modal fade" id="userSearchModal">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">Search User</h4>
					</div>
					<div class="modal-body" id="searchAllUsers">
						<input type="text" class="form-control" id="searchAllUser" placeholder="Type Name or Email">
						<hr>
						<?php $q = mysqli_query($dbc,"SELECT * FROM users WHERE id<>'$fetchUser[id]'"); ?>
						<div class="list-group">
						<?php while($r=mysqli_fetch_assoc($q)): ?>
							<a href="#" class="list-group-item"><?=ucwords($r['name'])?><p class="text-muted"><?=$r['email']?></p>
							<a href="index.php?nav=message&from_id=<?=$fetchUser['id']?>&to_id=<?=$r['id']?>" class="btn btn-primary">Message</a>
							<a href="index.php?nav=user_profile&user_id=<?=$r['id']?>" class="btn btn-primary">View Profile</a>
							
							</a> 
						<?php endwhile; ?>
						</div>						
					</div><!-- modal Body -->
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div><!-- modal ends -->
		

		<script>
				$(function () {
				  $('[data-toggle="tooltip"]').tooltip()
				})
		$(document).ready(function(){
			// $(window).focus(function(e){
			// 	$.get('ajax/logComments.php',{},function(data){
			// $("#getFeeds").html(data);
			// 	 e.preventDefault();
			// });
			// });


			$.ajaxSetup({cache:false});
		setInterval(function(){
			$('#chat_msg_response').load('ajax/logs.php');

		},2000);
		$.ajaxSetup({cache:false});
		setInterval(function(){
			var sts = $('#chat_notification').html();
		var get = document.getElementById('chat_box_container');

			if (sts==0) {
				$('#chat_notification').css('display','none');
			}else{
			$('#chat_notification').css('display','block');

			}
		if(get.style.height=='250px'){}
		else{$('#chat_notification').load('ajax/chat_sts.php');}
		
		},100);

			$("#mychatBody").scrollTop($("#mychatBody").prop('scrollHeight'));
			$("#chat_box_body").scrollTop($("#chat_box_body").prop('scrollHeight'));

			setInterval(function(){
				var from_id =$("#from_id").val();
				var to_id = $("#to_id").val();
			
				$.get('ajax/getMessagesLog.php',{from_id:from_id,to_id:to_id},function(res){
				$("#mychatBody").html(res);
				$("#mychatBody").scrollTop($("#mychatBody").prop('scrollHeight'));
			});
			$.get('ajax/requestNotification.php',{},function(res){
				$("#req_notify").html(res);
			});
			$.get('ajax/msgNotification.php',{},function(res){
				$("#msgNotification").html(res);
				$("#msgNotificationSide").html(res);
			});

			
			
			},1000);
			

			var inc=0;
		$("#mychatBody").scroll(function () {
			/* body... */
			if ($(this).scrollTop()==0) {
				inc++;
				$(this).css('opacity',.2);
				for(var i=1;i<=5;i++){
				$(this).prepend('<div class="well well-sm">'+inc+' <b>Name : </b> Heloo How area ? <i class="pull-right">12:24 pm</i></div>');
			}
				setTimeout(function(){
							$("#mychatBody").css('opacity',1);
							$("#mychatBody").scrollTop(100);
				},500);
			}
		});
		// key up
			$("#search").keyup(function(){
				$.get('ajax/searchConversationUsers.php',{data:$(this).val()},function(res){
					$("#getUserConversation").html(res);
				});
			});//key up

			 $('.myTable').DataTable();
	});//document body ready
			// chat loading msgs

			
		</script>


	<!-- See Pic On Run Time -->
		<script type="text/javascript">
	

  var imageTypes = ['jpeg', 'jpg', 'png','svg','gif']; //Validate the images to show
        function showImage(src, target)
        {
            var fr = new FileReader();
            fr.onload = function(e)
            {
                target.src = this.result;
            };
            fr.readAsDataURL(src.files[0]);
        }
        var uploadImage = function(obj)
        {
            var val = obj.value;
            var lastInd = val.lastIndexOf('.');
            var ext = val.slice(lastInd + 1, val.length);
            if (imageTypes.indexOf(ext) !== -1)
            {
                var id = $(obj).data('target');                    
                var src = obj;
                var target = $(id)[0];                    
                showImage(src, target);
            }
            else
            {
            }
        }

</script>
<script src="js/dropzone.js"></script>

<!-- Chat Box -->
		<!-- chat box code here -->
				<div id="chat_box_container">
					<div id="chat_box_header" onclick="toggle_chat_box()"><i style="float:right;margin:3px 10px 0 0;color:#fff;font-family:Calibri">X</i><h3 id="chat_box_heading"><div id="chat_notification"></div> Group Chat</h3></div>	<!-- chat_box_header -->			
					<div id="chat_box_body">
						<div id="chat_msg_response">
							
						</div>
					</div><!-- chat_box_body -->
					<div id="chat_box_message">
						<textarea name="msg" id="chat_box_text"></textarea>
					</div><!-- chat_box_message -->
				</div><!-- chat_box_container -->

					


	 <script>
		function toggle_chat_box(){
		var get = document.getElementById('chat_box_container');
		if(get.style.height=='250px'){$('#chat_box_container').css('height','26px');}
		else{$('#chat_box_container').css('height','250px');
		$.get("ajax/update_chat_sts.php",{},function(data){
			$('#chat_notification').html(data);

		});
	}
		}
  $('#chat_box_text').keyup(function (e) {
    if (e.keyCode === 13) {
     	// var name = form1.name.value;
	  	var msg = $('#chat_box_text').val();
	  	// alert(msg);

	 $.get('ajax/chat_insert.php',{msg:msg},function(data){

     		$('#chat_msg_response').html(data);
     	});

         //form1.name.value = '';
        $('#chat_box_text').val('');
     
    }


  });

  
	</script>
	
	<style>
			/*chat box code here*/
				#chat_box_container{
					height: 26px;
					width: 250px;
					/*padding: 10px;*/
					background: #fff;
					position: fixed;
					bottom: 1px;
					right: 200px;
					border: 3px solid #eeeeee;
					/*box-shadow: -25px 20px 20px #e2e2e2;*/
					z-index: 1000;
				}
				#chat_box_header{
					height: 30px;
					background: #414A5C;
					width: 100%;
					cursor: pointer;

				}
				#chat_box_heading{
					float: left;
					color: #fff;
					margin: 5px 0 0 10px;
					font-weight: 100;
					font-size: 15px;
				}
				#chat_box_body{
					height: 170px;
					width: 100%;
					overflow: scroll;
					background: #f1f1f1;
				}
				#chat_box_message{
					height: 53px;
					width: 100%;
/*					background: red;
*/				}

				#chat_box_message textarea{
					resize:none;
					width: 98%;
					height: 98%;
					padding: 2px;
				}
			/*chat list code here*/
			#chat_list_container{
				height: 100%;
				width:200px;
				padding: 15px;
				position: fixed;
				right: 0px;
				top: 80px;
				background: rgba(0,0,0,0.8);
			}
			#chat_list_container ul{list-style: none;float: left;width: 90%;}
			#chat_list_container ul li{display: block; padding: 10px;border-bottom: 1px solid gray; overflow: hidden width: 100%;}
			#chat_list_container ul li a{text-decoration: none;font-family: 'Calibri';color: #fff;font-size: 13px;}
			#chat_list_container ul li:hover{background: #414A5C;}

	input{
			height:30px;
			width: 200px;
			border-radius: 1px;
			border:none;
			text-indent: 5px;
			font-size: 16px;
		}
		label{
			font-weight: 100;
			font-family: 'Calibri';
			font-size: 19px;
		}
		th,td{
			padding: 10px;
			font-family: 'Calibri';
			font-size: 16px;
			text-align: center;
		}
		tr:nth-child(even){
			background: #eee;
		}
		th a{
			text-decoration: none;
			color: #444;
		}
	.chat_msg_response{
		height: auto;
		background:#e2e2e2;
		width: 95%;
		margin: 2px 0 0 0;
		font-family: 'Calibri';
		padding: 2px;
		border-radius: 10px;
		overflow: hidden;

	}



#chat_box_text{
			width: 300px;
			resize:none;
			font-weight: 100px;
			font-family: 'Calibri';
			padding: 10px;
			font-size: 14px;
			border-radius: 1px;
			border:none;

		}
	
	</style>


	