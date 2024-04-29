$("#cart").click((e)=>{
    
    if($("#user").html()==""){
        e.preventDefault();
        //Hay que loguearse
        $("#modal-login").modal("show");
    }
});