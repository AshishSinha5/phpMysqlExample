$(document).ready(function(e){
        $(document).on('click','#button',function(e){
                e.preventDefault();
                var name=$('#name').val();
                var info={name:name};
                info=JSON.stringify(info);
                insertStudent(info);
        });
});
var insertStudent=function(info){
    $.ajax({
        url:"insertStudent.php",
        type:"post",
        data:info,
        async:true,
        success:function(response){
            alert(response);
            jsondata=$.parseJSON(response);
            if(jsondata.msg){
                alert(jsondata.msg);
            }else{
                alert(jsondata.error);
            }
        },
        error: function(response, status, errorThrown) {
            console.log(response.status);
            alert(response) ; //result from server if error occured
            alert(errorThrown);  //error code
        },
        cache: false,
        contentType: false,
        processData: false
    });
};

