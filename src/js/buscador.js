document.addEventListener('DOMContentLoaded',function(){
    iniciarAPP();
})

function iniciarAPP(){
    buscarPorFecha();
}

function buscarPorFecha(){
    const fecha = document.getElementById('fecha');
    fecha.addEventListener('input',(e)=>{
        const fechaSeleccionada = e.target.value;

        window.location = `?fecha=${fechaSeleccionada}`;
    })
}