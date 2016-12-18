$(document).ready(function(){
        $(document).on('click','#button',function(e){
        e.preventDefault(); //to stop reloading page on button click
        var id= $("#id").val();
        var info={id: id}; //forming json string 
         info =JSON.stringify(info); //in php7.0 its necessary earlier it wasn't needed
         sendToPHP(info);
        });
    
});

var sendToPHP=function(info){
    var id="";
    var name="";
       $.ajax({
        url: "FetchStudent.php",
        type:"post",
        data:info,
        async: true,  //make it false if you send data to php and reload page else keep i true
        success: function (response) {
		alert(response);   //result from server or php file if success
                
                jsondata=$.parseJSON(response); //to json object
                if(jsondata.error){
                   alert(json.error)
                }else if(jsondata.id){
                alert(jsondata.name) //showing using . operator 
               
                $('#studentid').html(jsondata.id);
                $('#name').html(jsondata.name);
                //we can also use it as associative array jsondata['name']
                }
        },
        error: function (response, status, errorThrown) {
            console.log(response.status);
            alert(response) ; //result from server if error occured
            alert(errorThrown);  //error code
        },
        cache: false,
        contentType: false,
        processData: false
        
    });
};