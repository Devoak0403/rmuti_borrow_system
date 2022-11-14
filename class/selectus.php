<script>
$(function(){
    var departmentObject = $('#selectus');
    var noidObject = $('#showus');

    departmentObject.on('change', function(){
        var dId = $(this).val();

        noidObject.html('<option value="">--- รหัส นศ ---</option>');


        $.get('class/ajaxus.php?u_code='+dId, function(data){ //รับค่าจากการเลือก แล้วส่งไป ทำการดึงข้อมูลจากไฟล์ auto_select.php 
            var result = JSON.parse(data);
            var html = '';
            for(var i=0; i<result.length; i++){
                // html += '<input value="'+result.u_code+'">'+result.firstname+'';
                html += '<option value="'+result[i].firstname+' '+result[i].lastname+'">'+result[i].firstname+' '+result[i].lastname+'</option>';
            }
            // html += '<input value="'+result.u_code+'">'+result.firstname+'';
            noidObject.html(html);

        });
    });
});
</script>