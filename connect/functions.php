	<?php 
		function getNav($nav,$get){

				foreach ($nav as $index => $value) {
					# code...
					?>
				<li class="<?php if($get==$index){echo "active";} ?>"><a href="?nav=<?php echo $index;?>"><?php echo ucfirst($value); ?></a></li>
			<?php 
			}//foreach close
		}//funciton body close

		function showAllDataQuery($dbc,$table_name){

			return mysqli_query($dbc,"SELECT * FROM $table_name");
		}
		function showAllDataQueryDesc($dbc,$table_name){

			return mysqli_query($dbc,"SELECT * FROM $table_name ORDER BY id DESC");
		}

			//select all data in table format from database
			function custom_show_allDataTable($table_name,$case=''){

				$cols = mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM $table_name"));
				echo "<tr>";
				foreach ($cols as $index => $value) {
					# code...
					?>
					<td><?php echo strtoupper($index); ?></td>
					<?php
				}//foreach for fields
				echo "</tr>";

			}

	 ?>
	
	<?php 
		function custom_FetchDataQuery($dbc,$table){
			return mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM $table"));
		}
	 ?>


<?php 
		function custom_FetchSpecificDataQuery($dbc,$table,$id=''){
			return mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM $table WHERE id='$id'"));
		}
	 ?>



	 <?php 
 	function custom_AllTableFields($dbc,$table,$case=''){

 		$cols = mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM $table"));
 		foreach ($cols as $key => $value) {
 			# code...
 			if ($key=='pic') {
					continue;
							}
 			if ($case=='upper') {
 				# code...
 				$output=strtoupper($key);
 			}
 			
 			?>
				<th><?php echo $output; ?></th>
 			<?php
 			
 		}
 	}// fields show 

 	 ?>
	 <?php 
 	function custom_ManageTableFields($dbc,$table,$case=''){

 		$cols = mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM $table"));
 		foreach ($cols as $key => $value) {
 			# code...
 			if ($key=='pic') {
					continue;
							}
 			if ($case=='upper') {
 				# code...
 				$output=strtoupper($key);
 			}
 			
 			?>
				<th><?php echo $output; ?></th>
				
 			<?php
 			
 		}
 		?>
 		<th>Delete</th>
				<th>Edit</th>
 		<?php
 	}// fields show 

 	 ?>

	<?php 
		function custom_AllTableRows($dbc,$table){
			$q  =mysqli_query($dbc,"SELECT * FROM $table");
			while ($r = mysqli_fetch_assoc($q)) {
				# code...
				?>
				<tr>
					<?php 
						foreach ($r as $index => $value) {
							# code...
							if ($index=='pic') {
								continue;
							}
							?>
							<td><?php echo $r[$index]; ?></td>
							<?php
						}
					 ?>
				</tr>
				<?php
			}
		}

	 ?>

	 <?php 
		function custom_SeacrhTableRows($dbc,$table,$data){
			$q  =mysqli_query($dbc,"SELECT * FROM $table WHERE email LIKE '%$data%' OR j_date LIKE '%$data%'");
			while ($r = mysqli_fetch_assoc($q)) {
				# code...
				?>
				<tr>
					<?php 
						foreach ($r as $index => $value) {
							# code...
							if ($index=='pic') {
								continue;
							}
							?>
							<td><?php echo $r[$index]; ?></td>
							<?php
						}
					 ?>
					 
				</tr>
				<?php
			}
		}

	 ?>

	<?php 
		function custom_ManageTableRows($dbc,$table,$url=""){
			$q  =mysqli_query($dbc,"SELECT * FROM $table");
			while ($r = mysqli_fetch_assoc($q)) {
				# code...
				?>
				<tr>
					<?php 
						foreach ($r as $index => $value) {
							# code...
							if ($index=='pic') {
					continue;
							}
							?>
							<td><?php echo $r[$index]; ?></td>
							<?php
						}
					 ?>
					 <td class="text-center"><a href='<?php echo $url."&{$table}_del_id={$r['id']}"?>'><i class="glyphicon glyphicon-trash"></i></a></td>
					 <td class="text-center"><a href='<?php echo $url."&{$table}_update_id={$r['id']}"?>'><i class="glyphicon glyphicon-pencil"></i></a></td>

				</tr>
				<?php
			}
		}

	 ?>
		<?php 
			function custom_UpdateTableRecordView($dbc,$table,$id=0){
			$q = mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM $table WHERE id='$id'"));
				foreach ($q as $index => $value) {
					# code...
					if ($index=='id' or $index=='pic' OR $index=='category' OR $index=='j_date' OR $index=='online' OR $index=='email' OR $index=='gender') {
						# code...
						continue;
					}
				
				?>

				<div class="form-group"><label for=""><?php echo ucfirst($index);?></label><input type="text" class="form-control" name="<?php echo $index;?>" placeholder="<?php echo ucfirst($index)."....";?>" value="<?php echo $q[$index]; ?>"></div>
			
				<?php

			}//foreach loop ends
		}//funciton ends
		 ?>

		  <?php 
		  	function custom_PrepareDataUpdate($dbc,$table){
		  $data=array();
			foreach ($r = custom_FetchDataQuery($dbc,$table) as $key => $value) {
				if ($key=='id' or $key=='pic' OR $key=='category' OR $key=='j_date' OR $key=='online' OR $key=='email' OR $key=='gender') {
						# code...
						continue;
					}
				$data[] = $key."='".mysqli_real_escape_string($dbc,strip_tags($_REQUEST[$key]))."'";
				}
				return $data;
		  	}//function ends

		   ?>
		 <?php function custom_UpdateTableRecordQuery($dbc,$table,$data,$id=''){

				$comm =",";
				$query ="";
	 		for ($i=0; $i <count($data) ; $i++) { 
					# code...
	 			if ($i==(count($data)-1)) {
	 				# code...
	 				$comm="";
	 			}
					$query .= $data[$i].$comm;
				}//for loop ends
				//echo $query;

				$q = "UPDATE $table SET $query WHERE id='$id'";
				$r  = mysqli_query($dbc,$q);
				if ($r) {
					# code...
					?>
					<script>
						alert('Record Updated Successfully...');
						setTimeout(function(){
							window.location.href;
						},100);

					</script>
					<?php

				}
				else{
					echo "<h1>erorrr......</h1>";
					?>
					<script>
						alert('Erorr....');
						
					</script>
					<?php
				}
		 }


		  ?>
	<?php 
		function custom_deleteTableRow($dbc,$table,$id){
			$r = mysqli_query($dbc,"DELETE FROM $table WHERE id='$id'");
			if ($r) {
					# code...
					?>
					<script>
						alert('Record Has Been Deleted...');
						setTimeout(function(){
							window.location.href;
						},100);

					</script>
					<?php

				}
				else{
					echo "<h1>erorrr......</h1>";
					?>
					<script>
						alert('Erorr....');
						
					</script>
					<?php
				}
		}

	 ?>

	 	<?php 
	 		function custom_resetPassword($dbc,$table,$email,$old,$new,$confirm){
	 				# code...
				$chk = mysqli_query($dbc,"SELECT * FROM $table WHERE email='$email' AND password='$old'");
				if (mysqli_num_rows($chk)>=1) {
					# code...
					if ($new==$confirm) {
						# code...
						$update = "UPDATE $table SET password='$new' WHERE email='$email'";
						$r = mysqli_query($dbc,$update);
						if ($r) {
							# code...
					$msg =  "Password Has Been Changed...";
					$sts='info';
					session_destroy();
					?>
					<script>
					setTimeout(function(){window.location="../?nav=loginUser";},2000);
					</script>
					<?php
						}
					}//password match if close
					else{
					$msg =  "New Password And Confirm Not Matched";
					$sts='warning';
					}
					
				}// query chk if close
				else{
					$msg = "Old Password Not Matched";
					$sts="danger";
				}
				return $msg;
	 		}
	 	 ?>

<?php
function insert_data($dbc,$table){
	$col =mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM $table"));

		$c = count($col);
		// echo "Total : ".$c."<br>";
		$i=1;
		$comma = ",";
		$val = $fld = "";
		$q = "'";

		
		foreach ($col as $index => $value) {
					if ($i==$c) {
						$comma =" ";
					}else{
						$i++;
					}
			
				$fld.=$index.$comma;
				$val.=$q.$_REQUEST[$index].$q.$comma;
			
		}//foreach
		// echo "Total : ".$c."<br>";
		// echo $fld;
		// echo "<br>".$val;
		$q = mysqli_query($dbc,"INSERT INTO $table($fld) VALUES($val)");
		if ($q) {
			# code...
			return "new admin created...";

		}else{
			return mysqli_error($dbc);
		}

	}
	 ?>
 <?php 
 		function make_form($dbc,$table){
 		$col =mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM $table"));

 			?>
 			<form action="" method="POST" role="form">
			
			<?php 
				foreach ($col as $index => $value) {
					# code...
					if ($index=='id') {
						continue;
					}
				
			 ?>
			<div class="form-group">
				<label for=""><?php echo $index; ?></label>
				<?php
				if ($index=='message' OR $index=='address') {
					echo '<textarea name='.$index.' cols="30" rows="6" placeholder='.$index.' class="form-control"></textarea>';
				}elseif( $index=='password'){
                 echo '<input type="password" class="form-control" name='.$index.' placeholder='.$index. '>';
                  
				}elseif( $index=='j_date'){
                 echo '<input type="text" value='. date('d-M-Y').' class="form-control" name='.$index.' placeholder='.$index. '>';
                  
				}
				else{
				 ?>
				
				<input type="text" class="form-control" name="<?php echo $index; ?>" placeholder="<?php echo $index; ?>" id="<?php echo $index; ?>">
				<?php } ?>
			</div>
		
			<?php } ?>
		
			<button type="submit" class="btn btn-primary" name="<?php echo $table;?>_smb">Submit</button>
		</form>
 			<?php
 		}//function

 	 ?>

	<?php 
 	 		function fetch_specific_data($dbc,$table,$id){
 	 			return mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM $table WHERE id='$id'"));
 	 		}

 	 	 ?>
 	 	 	<?php 
 	 		function fetch_specific_data_limit_one($dbc,$table,$id){
 	 			return mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM $table WHERE id='$id' LIMIT 1"));
 	 		}

 	 	 ?>
 	 	 <?php 
 	 		function fetch_all_data($dbc,$table){
 	 			return mysqli_query($dbc,"SELECT * FROM $table");
 	 		}

 	 	 ?>
 	 	 <?php 
 	 	 function validate_data($dbc,$data){
 	 	 	return mysqli_real_escape_string($dbc,strip_tags($data));
 	 	 }
 	 	  ?>


 	 	   <?php 	
	 	function fetchByLabel($dbc,$table,$label){
	 		return mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM $table WHERE label='$label'"));
	 	}
	  ?>
	   <?php 	
	 	function fetchById($dbc,$table,$id){
	 		return mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM $table WHERE id='$id'"));
	 	}
	  ?>
	   <?php 	
	 	function fetchByEmail($dbc,$table,$email){
	 		return mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM $table WHERE email='$email'"));
	 	}
	  ?>
	   <?php 	
	 	function fetchByName($dbc,$table,$name){
	 		return mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM $table WHERE name='$name'"));
	 	}
	  ?>
	  <?php 
	  	function getContentList($dbc,$table){
				$q = mysqli_query($dbc,"SELECT * FROM $table");
				while ($r = mysqli_fetch_assoc($q)) {
						# code...
						?>
					<a href="?nav=<?= $table?>&<?=$table?>_id=<?=$r['id']?>" class="list-group-item <?php if(!empty($_REQUEST[$table.'_id'])){if($_REQUEST[$table.'_id']==$r['id']){echo "active";}}?>">
						<h4 class="list-group-item-heading"><?php echo ucwords($r['short_desc']);?></h4>
						<p class="list-group-item-text"><?php echo ucwords(substr(strip_tags($r['content']),0,100))	;?></p>
					</a>
					
						<?php
					}

		}//getNav ends
	   ?>
	   	<?php 
	  	function getContentListSpecific($dbc,$table,$query){
				$q = mysqli_query($dbc,"SELECT * FROM $table WHERE short_desc LIKE '%$query%'");
				$c = mysqli_num_rows($q);
				if ($c==0) {
					echo "<h2>No Data Found :(</h2>";
				}
				else{
					echo "<h4 class='text-right'>Found <span class='badge'>".$c."</span></h4><br>";
				while ($r = mysqli_fetch_assoc($q)) {
						# code...
						?>
					<a href="?nav=<?= $table?>&<?=$table?>_id=<?=$r['id']?>" class="list-group-item <?php if(!empty($_REQUEST[$table.'_id'])){if($_REQUEST[$table.'_id']==$r['id']){echo "active";}}?>">
						<h4 class="list-group-item-heading"><?php echo ucwords($r['short_desc']);?></h4>
						<p class="list-group-item-text"><?php echo ucwords(substr(strip_tags($r['content']),0,100))	;?></p>
					</a>
					
						<?php
					}
				}//elseif

		}//getNav ends
	   ?>
	 <?php 
	 	 function getSubjects($dbc,$table,$id){
	 	 	$q = mysqli_query($dbc,"SELECT * FROM $table WHERE course_id='$id'");
	 	 	while ($r = mysqli_fetch_assoc($q)) {
	 	 		# code...
	 	 		?>
	 	 		<option value="<?php echo $r['id'];?>"><?php echo $r['subject_name'];?></option>
	 	 		<?php
	 	 	}
	 	 }

	 	  ?> 
	 	   <?php 
	 	 function getOptions($dbc,$table){
	 	 	$q = mysqli_query($dbc,"SELECT * FROM $table");
	 	 	while ($r = mysqli_fetch_assoc($q)) {
	 	 		# code...
	 	 		?>
	 	 		<option value="<?php echo $r['id'];?>"><?php echo $r['name'];?></option>
	 	 		<?php
	 	 	}
	 	 }
	 	  function getOptionsByChoice($dbc,$table,$choice){
	 	 	$q = mysqli_query($dbc,"SELECT * FROM $table WHERE $$choice='$choice'");
	 	 	while ($r = mysqli_fetch_assoc($q)) {
	 	 		# code...
	 	 		?>
	 	 		<option value="<?php echo $r['id'];?>"><?php echo $r[$choice];?></option>
	 	 		<?php
	 	 	}
	 	 }

	 	  ?> 
	 	  <?php 
	 	  function countRecords($dbc,$table){
	 	  	return mysqli_num_rows(mysqli_query($dbc,"SELECT * FROM $table"));
	 	  }
	 	   ?>
	 	     <?php 
	 	  function countRecordsById($dbc,$table,$id){
	 	  	return mysqli_num_rows(mysqli_query($dbc,"SELECT * FROM $table WHERE id='$id'"));
	 	  }
	 	   ?>
	 	      <?php 
	 	  function countRecordsByBatchId($dbc,$table,$id){
	 	  	return mysqli_num_rows(mysqli_query($dbc,"SELECT * FROM $table WHERE batch_id='$id'"));
	 	  }
	 	   ?>
	 	   <?php 
	 	   function checkRelation($dbc,$tables,$id){
	 	   	$find =array();
	 	   	if (is_array($tables)) {
	 	   		foreach ($tables as $table) {
	 	   			$q = mysqli_query($dbc,"SELECT * FROM $table WHERE id='$id'");
	 	   			if (mysqli_num_rows($q)>=1) {
	 	   				$find[] = "found : ".$table;
	 	   				
	 	   			}else{
	 	   				$find[] ="No Found";
	 	   			}

	 	   		}//foreach
	 	   	}
	 	   	return $find;
	 	   }

	 	    ?>

	 	    <?php 
		function view_data_table($dbc,$table_name,$url){
			echo "<div class='table-responsive'>";
			echo '<table class="table table-bordered table-hover table-striped">';

		$col = mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM $table_name"));
		$rec = mysqli_query($dbc,"SELECT * FROM $table_name");
	?>
	<tr>
		<?php 
		if (!empty($col)) {
			
		
		foreach ($col as $index => $v) {
			echo "<th>{$index}</th>";
			}
		}
		 ?>
	</tr>
	<?php 	
		if (!empty($rec)) {
			while ($r = mysqli_fetch_assoc($rec)) {
				# code...
				echo "<tr>";
					foreach ($r as $index=>$value) {
						//echo "<td>{$value}</td>";
						echo "<td>{$r[$index]}</td>";
					}
					?>
					<th><a href="?nav=<?php echo $url;?>&amp;table=<?php echo $table_name;?>&amp;del_id=<?php echo $r['id'];?>"><spna class="glyphicon glyphicon-trash"></spna></a></th>
					<?php
				echo "</tr>";
			}
		}
	echo "</table> </div>";
	}//funciton ends

	?>
	<?php 
		function del_data_from_table($dbc,$get_nav_data,$del_id){
			?>
			<center>
            <form method="post">
                <div class="radio">
                <h4 class="text-muted">Do You Really Want to Delete ?</h4>
            <div class="form-group">
                <label><input type="password" name="password" class="form-control" placeholder="Enter Password to Delete..."></label>
            </div>
                    <label>
                        <input type="radio" value="yes" name="choice">
                        Yes
                    </label> |
                    <label>
                        <input type="radio" value="no" name="choice">
                        No
                    </label>
                    <button type="submit" name="del_choice" class="btn btn-danger btn-sm">Delete</button>
                </div>
            </form>
            <hr>
            </center>
        <?php
        if (isset($_REQUEST['del_choice'])) {
            $choice = $_REQUEST['choice'];
            $password = $_REQUEST['password'];
            if ($choice=='yes' AND $password=='3593ab59') {
                $q  = mysqli_query($dbc,"DELETE FROM $get_nav_data WHERE id='$del_id'");
                if ($q) {
                    $msg="Data Deleted..";
                    $sts="danger";
                    ?>
                <script>
                setTimeout(function(){
                    window.location="?nav=<?= $get_nav_data;?>";
                },1000);
            </script>
            <?php
                }else{
                    $msg ="Prolem in Query...";
                    $sts ="danger";
                }
            }//choise yes if close
            elseif($choice=='no'){
            ?>
                <script>
                setTimeout(function(){
                    window.location="?nav=<?= $get_nav_data;?>";
                },1000);
            </script>
            <?php
            }//choice no close
            else{
               $msg="Incorrect Password...";
                    $sts="danger"; 
            }
        }//form del_choice button if close

		}
	 ?>




 <!-- ************************** Function Area ********************** -->
<!-- Redirect -->
<?php 
	function redirectUrl($url,$time=2000){
		?>
	<script>
		setTimeout(function(){
			window.location='<?php echo $url;?>';
		},<?=$time?>);
	</script>
		<?php
	}
 ?>
<!-- Get Messaage and Sts -->
	<?php function getMessage($msg,$sts){
		 if (!empty($msg)) {
			# code...
		echo "<div class='alert alert-{$sts}'>{$msg}</div>";
					} 
		} ?>
		<!-- Insert Table Data -->
		<?php 
		function insertTableData($dbc,$table,$data){
			$fields='(';
 			$val='(';
		 	$comma=',';
		 	$count= count($data);
		 	$i=0;
		 	foreach ($data as $index => $value) {
		 		# code...
		 		if ($i==$count-1) {
		 			# code...
		 			$comma="";
		 		}
		 		$i++;
		 		$fields.=$index.$comma;
		 		$val.="'".$value."'".$comma;
		 	}
		 	 $fields.=")";
		 	 $val.=")";
		 	return mysqli_query($dbc,"INSERT INTO $table $fields VALUES $val");
		}


		 ?>
		<!-- Delete table Data -->
		<?php 
		function deleteTableData($dbc,$table,$id){
			if ($id!="") {
				# code...
 	return mysqli_query($dbc,"DELETE FROM $table WHERE id='$id'");
	
			}
		}

		 ?>
		<!-- Update Table Data -->
 <?php 
 function updateTableData($dbc,$table,$data,$id){
 	$fields='';
 	$comma=',';
 	$count= count($data);
 	$i=0;
 	foreach ($data as $index => $value) {
 		# code...
 		if ($i==$count-1) {
 			# code...
 			$comma="";
 		}
 		$i++;
 		$fields.=$index."='".$value."'".$comma;
 	}
 	return mysqli_query($dbc,"UPDATE $table SET $fields WHERE id='$id'");
 }
  ?>
   <!-- get Fields in cells -->
  <?php function getTableFields($dbc,$table,$data=""){
  	if (is_array($data)) {
  		# code...
  		$fld="";
		$count=count($data);
		$i=0;
		$comma=",";
		foreach ($data as $key => $value) {
			# code...
			if ($i==$count-1) {
				# code...
				$comma="";
			}
			$i++;
			$fld.=$key.$comma;
		}
  	$flds=mysqli_fetch_assoc(mysqli_query($dbc,"SELECT $fld FROM $table"));
  	}//$data is array
  	else{
  		  	$flds=mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM $table"));

  	}
			foreach($flds as $index =>$value): ?>
					<th><?=strtoupper($index)?></th>
				<?php endforeach; 
				echo "<th></th><th></th>";
  	} ?>

   <!-- get Rows in cells -->
  <?php function getTableRows($dbc,$table,$data=""){
  	if (is_array($data)) {
  		# code...
  		$fld="";
		$count=count($data);
		$i=0;
		$comma=",";
		foreach ($data as $key => $value) {
			# code...
			if ($i==$count-1) {
				# code...
				$comma="";
			}
			$i++;
			$fld.=$key.$comma;
		}
  	$flds=mysqli_query($dbc,"SELECT $fld FROM $table");
  	}//$data is array
  	else{
  		  	$flds=mysqli_query($dbc,"SELECT * FROM $table");

  	}
			  	while ($r=mysqli_fetch_assoc($flds)) {
			  		# code...
			  		echo "<tr>";
			  		foreach($r as $index =>$value): ?>
					<td><?=$value?></td>
					<?php endforeach; 
					echo "</tr>";
			  	}
			
  	} ?>

  	 <!-- get Editable Rows in cells -->
  <?php function getTableMngRows($dbc,$table,$data="",$url="index.php?"){
  	if ($url!="index.php?") {
  		# code...
  		$url.="&";
  	}
  	if (is_array($data)) {
  		# code...
  		$fld="";
		$count=count($data);
		$i=0;
		$comma=",";
		foreach ($data as $key => $value) {
			# code...
			if ($i==$count-1) {
				# code...
				$comma=",id";
			}
			$i++;
			$fld.=$key.$comma;
		}
  	$flds=mysqli_query($dbc,"SELECT $fld FROM $table");
  	}//$data is array
  	else{
  		  	$flds=mysqli_query($dbc,"SELECT * FROM $table");

  	}
			  	while ($r=mysqli_fetch_assoc($flds)):?>
					<tr>
			  		<?php foreach($r as $index =>$value): if($index=='id')continue; ?>
					<td><?=$value?></td>
					<?php endforeach; ?>
					<td><a href="<?=$url?><?=$table?>_edit_id=<?php echo $r['id']; ?>"><span class="glyphicon glyphicon-edit"></span></a></td>
					<td><a href="<?=$url?><?=$table?>_del_id=<?php echo $r['id']; ?>"><span class="glyphicon glyphicon-trash"></span></a></td>
					</tr>
			  	<?php endwhile;
			
  	} ?>

		<!-- Fetch Specific Record By ID  -->
  	<?php function  fetchSpRecordById($dbc,$table,$id){
  		return mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM $table WHERE id='$id'"));
  		}?>