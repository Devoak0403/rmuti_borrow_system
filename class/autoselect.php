<script>

$(function(){

    var departmentObject = $('#selecttype');

    var noidObject = $('#showtype');

    

    departmentObject.on('change', function(){

        var dId = $(this).val();



        noidObject.html('<option value="">---- เลือกสิ่งของ ----</option>');

       

       

        $.get('class/ajex.php?t_id='+dId, function(data){ //รับค่าจากการเลือก แล้วส่งไป ทำการดึงข้อมูลจากไฟล์ auto_select.php 

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