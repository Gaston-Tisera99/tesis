$(document).ready((function(){$(document).on("click",".confirmar",(function(){!function(e){Swal.fire({title:"¿Seguro que desea confirmar este pedido como una venta?",text:"Esta acción no se podrá deshacer",icon:"warning",showCancelButton:!0,confirmButtonText:"Si, confirmar",cancelButtonText:"Cancelar"}).then(n=>{n.isConfirmed&&function(e){$.post("/api/confirmar-venta",{action:"confirmarVenta",id:e},(function(e){"success"===e.trim()?Swal.fire({icon:"success",title:"Éxito",text:"VENTA Confirmada Correctamente"}).then(e=>{e.isConfirmed&&location.reload()}):Swal.fire({icon:"error",title:"Error",text:"No se pudo confirmar la VENTA debido a un problema en el stock"})}))}(e)})}($(this).data("idpedido"))}))})),$(document).ready((function(){$(".eliminar-btn").click((function(){!function(e){Swal.fire({title:"¿Seguro que deseas eliminar este Pedido?",text:"Esta accion no se podra deshacer",icon:"warning",showCancelButton:!0,confirmButtonText:"Si, eliminar",cancelButtonText:"Cancelar"}).then(n=>{n.isConfirmed&&function(e){$.post("/api/eliminar-venta",{action:"eliminarVenta",id:e},(function(e){"success"===e.trim()?Swal.fire({icon:"success",title:"Éxito",text:"Pedido eliminado correctamente"}).then(e=>{e.isConfirmed&&location.reload()}):Swal.fire({icon:"error",title:"Error",text:"Hubo un problema al eliminar el pedido"})}))}(e)})}($(this).data("id"))}))}));