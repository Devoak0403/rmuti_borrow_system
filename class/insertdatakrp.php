<?php 
		require_once 'config/conin.php';
		// require_once '../config/conin.php';
        // include ('config/conin.php');
        
		
		function fill_unit_select_box($connect)
		{
			$output = '';
		
			$query = "SELECT * FROM unit ORDER BY id ASC";
		
			$result = $connect->query($query);
		
			foreach($result as $row)
			{
				$output .= '<option value="'.$row["id"].'">'.$row["name"] . '</option>';
			}
		
			return $output;
		}
		function fill_item_select_box($connect)
		{
			$output = '';
		
			$query = "SELECT * FROM item_a WHERE a_type = 2 ORDER BY a_id ASC";
		
			$result = $connect->query($query);
		
			foreach($result as $row)
			{
				$output .= '<option value="'.$row["a_key"].'">'.$row["a_name"] .' (คงเหลือ'.$row["a_value"].')</option>';
			}
		
			return $output;
		}
		function fill_type_select_box($connect)
		{
			$output = '';
		
			$query = "SELECT * FROM typelist ORDER BY t_id ASC";
		
			$result = $connect->query($query);
		
			foreach($result as $row)
			{
				$output .= '<option value="'.$row["t_id"].'">'.$row["t_name"] . '</option>';
			}
		
			return $output;
		}
				
		?>
				<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
				<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
				<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
		
				<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/css/bootstrap-select.min.css">
		
				<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/js/bootstrap-select.min.js"></script>
		
				<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
							 <!-- <form method="post" id="insert_form">
								<div class="table-repsonsive">
									<span id="error"></span>
									<table class="table table-bordered" id="item_table">
										<tr>
											<th>Enter Item Name</th>
											<th>Enter Quantity</th>
											<th>Select Unit</th>
											<th><button type="button" name="add" class="btn btn-success btn-sm add"><i class="fas fa-plus"></i></button></th>
										</tr>
									</table>
									<div align="center">
										<input type="submit" name="submit" id="submit_button" class="btn btn-primary" value="Insert" />
									</div>
								</div>
							 </form> -->
		<script>
			var $j = jQuery.noConflict();//set for $ is $j of JQUERY
		
		$j(document).ready(function(){
		
			var count = 0;
			
			function add_input_field(count)
			{
		
				var html = '';
		
				html += '<tr>';
		
				// html += '<td><input type="text" name="item_name[]" class="form-control item_name" /></td>';
		
				html += '<td><select name="item_name[]" class="form-control selectpicker" data-live-search="true"><option value="">Select Unit</option><?php echo fill_item_select_box($connect); ?></select></td>';
				
				// html +='<td><select class="custom-select rounded-0" name="item_name1[]" id="selecttype"><?php echo fill_type_select_box($connect); ?></select></td>';
				
				// html +='<td><select class="custom-select rounded-0" name="item_name[]" id="showtype"></select></td>';

				html += '<td><input type="number" name="item_quantity[]" class="form-control item_quantity" /></td>';
		
				// html += '<td><select name="item_unit[]" class="form-control selectpicker" data-live-search="true"><option value="">Select Unit</option><?php echo fill_unit_select_box($connect); ?></select></td>';
		
				var remove_button = '';
		
				if(count > 0)
				{
					remove_button = '<button type="button" name="remove" class="btn btn-outline-danger btn-sm remove"><i class="fas fa-minus"></i></button>';
				}
		
				html += '<td>'+remove_button+'</td></tr>';
		
				return html;
		
			}
		
			$j('#item_table').append(add_input_field(0));
		
			$j('.selectpicker').selectpicker('refresh');
		
			$j(document).on('click', '.add', function(){
		
				count++;
		
				$j('#item_table').append(add_input_field(count));
		
				$j('.selectpicker').selectpicker('refresh');
		
			});
		
			$j(document).on('click', '.remove', function(){
		
				$j(this).closest('tr').remove();
		
			});
		
			$j('#insert_form').on('submit', function(event){
		
				event.preventDefault();
		
				var error = '';
		
				count = 1;
		
				$j('.item_name').each(function(){
		
					if($j(this).val() == '')
					{
		
						error += "<li>Enter Item Name at "+count+" Row</li>";
		
					}
		
					count = count + 1;
		
				});
		
				count = 1;
		
				$j('.item_quantity').each(function(){
		
					if($j(this).val() == '')
					{
		
						error += "<li>Enter Item Quantity at "+count+" Row</li>";
		
					}
		
					count = count + 1;
		
				});
		
				count = 1;
		
				// $j("select[name='item_unit[]']").each(function(){
		
				// 	if($j(this).val() == '')
				// 	{
		
				// 		error += "<li>Select Unit at "+count+" Row</li>";
		
				// 	}
		
				// 	count = count + 1;
		
				// });
		
				var form_data = $j(this).serialize();
		
				if(error == '')
				{
		
					$j.ajax({
		
						// url:"../sql/insert_moredata.php",

						url:"../sql/insert_lent_item2.php",
		
						method:"POST",
		
						data:form_data,
		
						beforeSend:function()
						{
		
							$j('#submit_button').attr('disabled', 'disabled');
		
						},
		
						success:function(data)
						{
		
							if(data == 'ok')
							{
		
								$j('#item_table').find('tr:gt(0)').remove();
		
								$j('#error').html('<div class="alert alert-success">Item Details Saved</div>');
		
								$j('#item_table').append(add_input_field(0));
		
								$j('.selectpicker').selectpicker('refresh');
		
								$j('#submit_button').attr('disabled', false);
							}
		
						}
					})
		
				}
				else
				{
					$j('#error').html('<div class="alert alert-danger"><ul>'+error+'</ul></div>');
				}
		
			});
			 
		});
		</script>
		
		
		<script>

			var $a = jQuery.noConflict();//set for $ is $j of JQUERY

				$a(function(){

					var departmentObject = $a('#selecttype');

					var noidObject = $a('#showtype');

					

					departmentObject.on('change', function(){

						var dId = $a('#selecttype').val();



						noidObject.html('<option value="">---- เลือกสิ่งของ ----</option>');

					

					

						$a.get('class/ajex.php?t_id='+dId, function(data){ //รับค่าจากการเลือก แล้วส่งไป ทำการดึงข้อมูลจากไฟล์ auto_select.php 

							var result = JSON.parse(data);

							var html = '';

							for(var i=0; i<result.length; i++){

								html += '<option value="'+result[i].a_key+'">'+result[i].a_name+' (เหลือ'+result[i].a_value+')</option>';

							}

							noidObject.html(html);

						

							// $.each(result, function(index, item){

							//     noidObject.append(

								

							//         $('<option></option>').val(item.a_key).html(item.a_name).html(item.a_value)//ส่งค่ากลับมาจากไฟล์ auto_select.php เพื่อแสดงค่าที่เราต้องการ select ใน Dropdownlist เช่นต้องการแสดง เลข รบอ. ก็ใช้ no_id  

									

									

							//     );

							// });

						});

					});

				});

		</script>