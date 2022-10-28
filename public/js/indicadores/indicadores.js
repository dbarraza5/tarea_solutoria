function eliminarRegistro(id){
    let token = $('meta[name="csrf-token"]').attr('content')
    console.log("eliminando registro: "+id)
    console.log(token)
    let headers = {
        'X-CSRF-TOKEN': token
    }

    $.ajax({
        headers : headers,
        type: "POST",
        url: URL_+"indicadores/eliminar",
        data: {
            "id": id
        }
    }).done(function (){
        location.reload();
    }).fail(function (){
        console.log("fallo al eliminar registro")
    });
}


function actualizarRgistro(id=null){
    let token = $('meta[name="csrf-token"]').attr('content')
    let headers = {
        'X-CSRF-TOKEN': token
    }
    const form = $("#form-indicador");
    const datos = form.serializeArray();
    datos.push({name:"id", value: id})

    if(form[0].checkValidity()){
        $.ajax({
            headers : headers,
            type: "PUT",
            url: URL_+"indicadores/actualizar",
            data: datos
        }).done(function (data){
            //location.reload();
            console.log(data);
            window.location.href = URL_+"indicadores?id="+id
        }).fail(function (data){
            console.log(data.responseJSON);
            //console.log("fallo al eliminar registro")
            swal({
                title: "Error",
                text: "Tipo de dato.",
                icon: "warning",
                dangerMode: true,
            })
        });
    }else{
        $("#agente-submit").click();
    }
}

function crearRgistro(){
    let token = $('meta[name="csrf-token"]').attr('content')
    let headers = {
        'X-CSRF-TOKEN': token
    }
    const form = $("#form-indicador");
    const datos = form.serializeArray();

    if(form[0].checkValidity()){
        $.ajax({
            headers : headers,
            type: "POST",
            url: URL_+"indicadores/crear",
            data: datos
        }).done(function (data){
            //location.reload();
            console.log(data);
            window.location.href = URL_+"indicadores?id="+data["id"]
        }).fail(function (data){
            console.log(data.responseJSON);
            //console.log("fallo al eliminar registro")
            swal({
                title: "Error",
                text: "Tipo de dato.",
                icon: "warning",
                dangerMode: true,
            })
        });
    }else{
        $("#agente-submit").click();
    }
}

let grafico_indicador = null;
function graficarIndicador(){
    let token = $('meta[name="csrf-token"]').attr('content')
    let headers = {
        'X-CSRF-TOKEN': token
    }
    const form = $("#form-filtro-grafico");
    const datos = form.serializeArray();
    if(form[0].checkValidity()){
        $.ajax({
            headers : headers,
            type: "POST",
            url: URL_+"indicadores/grafico",
            data: datos
        }).done(function (data){
            //location.reload();
            console.log(data);
            const labels = data.map((e)=>e["fechaIndicador"]);
            const datos = data.map((e)=>parseFloat(e["valorIndicador"]))

            const data_grafico = {
                labels: labels,
                datasets: [{
                    label: 'Indicador',
                    data: datos,
                    fill: false,
                    borderColor: 'rgb(75, 192, 192)',
                    tension: 0.1
                }]
            };

            console.log(labels)
            const ctx_g = document.getElementById("canvas-grafico");

            if(grafico_indicador !=null){
                grafico_indicador.destroy()
            }
            grafico_indicador = new Chart(ctx_g, {
                type: "line",
                data: data_grafico,
            });
            //window.location.href = URL_+"indicadores?id="+data["id"]
        }).fail(function (data){
            console.log(data.responseJSON);
            //console.log("fallo al eliminar registro")
            swal({
                title: "Error",
                text: "Tipo de dato.",
                icon: "warning",
                dangerMode: true,
            })
        });
    }else{
        $("#agente-submit").click();
    }
}

function redireccion(id){
    window.location.href=URL_+'indicadores/actualizar/'+id
}
