//la modal
$("#cart").click((e)=>{
    
    if($("#user").html()==""){
        e.preventDefault();
        //Hay que loguearse
        $("#modal-login").modal("show");
    }
});
//pa que clique y borré
$(".quantity").keyup((e)=>{
    alert(e.currrentTarget.value);
})