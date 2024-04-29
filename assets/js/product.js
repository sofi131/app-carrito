$("#cart").click(()=>{

    if($("#user").html()==""){
        //Hay que loguearse
        $("#modal-login").modal("show");
    }
});