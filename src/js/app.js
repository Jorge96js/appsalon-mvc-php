let paso = 1;
const pasoInicial = 1;
const pasoFinal = 3;

const cita = {
    id:'',
    nombre: '',
    fecha: '',
    hora: '',
    servicios: []
}

document.addEventListener('DOMContentLoaded',()=>{
    iniciarApp();
});

function iniciarApp(){
    mostrarSeccion()//Muestr ay oculta las secciones
    tabs()//Cambia la seccion cuando presionen los tab
    botonesPaginador()//Agrega o quita los botones del pagnador
    paginaSiguiente()
    paginaAnterior()

    consultarAPI()//consultar backend php
    idCliente()
    nombreCliente()
    seleccionarFecha()
    seleccionarHora()
}

function mostrarSeccion(){
    //ocultar seccion que tenga la clase mostarr
    const seccionAnterior = document.querySelector('.mostrar');
    if(seccionAnterior){
        seccionAnterior.classList.remove('mostrar')
    }

    //seleccionar seccion con el paso
    const seccion = document.querySelector(`#paso-${paso}`);
    seccion.classList.add('mostrar')

    //Quitar la seleccion
    const tabAnterior = document.querySelector('.actual');
    
    if(tabAnterior){
        tabAnterior.classList.remove('actual')
    }

    //Resaltar tab actual
    const tab = document.querySelector(`[data-paso="${paso}"]`);
    tab.classList.add('actual');
}


function tabs(){
    const botones = document.querySelectorAll('.tabs button');

    botones.forEach(boton =>{
        boton.addEventListener('click', (e)=>{
            paso = parseInt(e.target.dataset.paso);
            mostrarSeccion();
            botonesPaginador();

            if(paso === 3){
                mostrarResumen()
            }
        })
    })
}

function botonesPaginador(){
    const paginaSiguiente =  document.querySelector('#siguiente')
    const paginaAnterior =  document.querySelector('#anterior')

    if(paso === 1){
        paginaAnterior.classList.add('ocultar')
        paginaSiguiente.classList.remove('ocultar')
    }else if(paso === 3){
        paginaSiguiente.classList.add('ocultar')
        mostrarResumen()
    }else{
        paginaSiguiente.classList.remove('ocultar')
        paginaAnterior.classList.remove('ocultar')
    }
    mostrarSeccion()
}

function paginaAnterior(){
    const paginaAnterior = document.querySelector('#anterior')
    paginaAnterior.addEventListener('click', ()=>{
        if(paso <= pasoInicial) return;
        paso--;

        botonesPaginador()
    })
}

function paginaSiguiente(){
    const paginaSiguiente = document.querySelector('#siguiente');
    paginaSiguiente.addEventListener('click', ()=>{
        if(paso >= pasoFinal) return;
        paso++;

        botonesPaginador()
    })
}

async function consultarAPI(){
    try {
        const url = `${location.origin}api/servicios`;
        const res = await fetch(url);
        const servicios  = await res.json();
        mostrarServicios(servicios)
    } catch (error) {
        console.log(error)
    }
}

function mostrarServicios(servicios){
    servicios.forEach(servicio =>{
        const {id, nombre, precio} = servicio


        const nombreServicio = document.createElement('p')
        nombreServicio.classList.add('nombre-servicio')
        nombreServicio.textContent = nombre

        const precioServicio = document.createElement('p')
        precioServicio.classList.add('precio-servicio')
        precioServicio.textContent = `$${precio}`

        const servicioDiv = document.createElement('div')
        servicioDiv.classList.add('servicio')
        servicioDiv.dataset.idServicio = id
        servicioDiv.onclick = ()=>{
            seleccionarServicio(servicio)
        }
        
        servicioDiv.appendChild(nombreServicio)
        servicioDiv.appendChild(precioServicio)

        document.querySelector('#servicios').appendChild(servicioDiv)

    })
}

function seleccionarServicio(servicio){
    const {id} = servicio;
    const {servicios} = cita
    const divServicio = document.querySelector(`[data-id-servicio="${id}"]`)

    //Comprobar si el servicio esta agregado
    if(servicios.some(agregado => agregado.id === servicio.id)){
        //Quitar servicio
        cita.servicios = servicios.filter(agregado => agregado.id != id)
        divServicio.classList.toggle('seleccionado')

    }else{
        //Agregarlo
        divServicio.classList.toggle('seleccionado')

    }

    cita.servicios = [...servicios, servicio]

}

function nombreCliente(){
    cita.nombre = document.getElementById('nombre').value
}

function idCliente(){
    cita.id = document.getElementById('id').value
}

function seleccionarFecha(){
    const fecha = document.getElementById("fecha")

    fecha.addEventListener("input",(e)=>{
        const dia = new Date(e.target.value).getUTCDay();
        if([0,6].includes(dia)){
            e.target.value = ""
            mostrarAlerta("Sabados y Domingos cerrado", "error", '.formulario')
        }else{
            cita.fecha = e.target.value
            
        }
        
    })
}

function mostrarAlerta(mensaje, tipo, elemento, desaparece = true){
    const alertaPrevia = document.querySelector('.alerta')
    if(alertaPrevia){
        alertaPrevia.remove
    }
    const referencia = document.querySelector(elemento)
    const alerta = document.createElement('DIV')
    alerta.textContent = mensaje
    alerta.classList.add(tipo)
    alerta.classList.add('alerta')
    referencia.appendChild(alerta)

    if(desaparece){
        setTimeout(()=>{
            alerta.remove()
        },3000)
    }
}

function seleccionarHora(){
    const inputHora = document.querySelector('#hora')
    inputHora.addEventListener('input',(e)=>{

        const horaCita = e.target.value
        const hora = horaCita.split(":")[0]
        if(hora < 10 || hora > 18){
            e.target.value = ''
            mostrarAlerta("Hora no valida", "error", ".formulario")
        }else{
            cita.hora = e.target.value
        }
    })
}

function mostrarResumen(){
    const resumen = document.querySelector('.contenido-resumen')
    //limpiar resumen
    while(resumen.firstChild){
        resumen.removeChild(resumen.firstChild)
    }

    //console.log(Object.values(cita))
    if(Object.values(cita).includes('') || Object.values.length === 0){
        mostrarAlerta("Faltan datos de servicio", "error", ".contenido-resumen", false)
        
        return;
    }

    //formatear div del resumen

    const {nombre, fecha , hora, servicios} = cita;

    const headingServicios = document.createElement("H3")
    headingServicios.textContent = "Resumen Servicios"
    resumen.appendChild(headingServicios)
     
    servicios.forEach(servicio =>{
        const {id,precio,nombre} = servicio
        const contenedorServicio = document.createElement('DIV')
        contenedorServicio.classList.add('contenedor-servicio')

        const textoServicio = document.createElement('P')
        textoServicio.textContent = nombre
        
        
        const precioServicio = document.createElement('P')
        precioServicio.innerHTML = `<span>Precio:</span> $${precio}`
        contenedorServicio.appendChild(textoServicio)
        contenedorServicio.appendChild(precioServicio)

        resumen.appendChild(contenedorServicio)
    })

    const headingCita = document.createElement("H3")
    headingCita.textContent = "Resumen de la cita"
    resumen.appendChild(headingCita)

    const nombreCliente = document.createElement('P')
    nombreCliente.innerHTML = `<span>Nombre:</span> ${nombre}`
    const fechaCita = document.createElement('P')
    
    //formatear fecha
    const fechaObj = new Date(fecha);
    const mes = fechaObj.getMonth();
    const dia = fechaObj.getDate() + 2;
    const year = fechaObj.getFullYear();


    const fechaUTC = new Date(Date.UTC(year,mes,dia));

    const opciones = {weelday:'long',year:'numeric',month:'long', day:'numeric' };
    const fechaFormateada = fechaUTC.toLocaleDateString('es-AR', opciones);
    fechaCita.innerHTML = `<span>Fecha:</span>${fechaFormateada}`;
    const horaCita = document.createElement('P');
    horaCita.innerHTML = `<span>Horario:</span> ${hora} Horas`;
    const serviciosCita = document.createElement('P');
    serviciosCita.innerHTML = `<span>Servicio/os:</span> ${servicios}`; 

    //Boton para reservar la cita
    const botonReservar = document.createElement('BUTTON')
    botonReservar.classList.add('boton')
    botonReservar.textContent = "Reservar cita"
    botonReservar.onclick = reservarCita

    resumen.appendChild(nombreCliente)
    resumen.appendChild(fechaCita)
    resumen.appendChild(horaCita)
    resumen.appendChild(botonReservar)
        
}

async function reservarCita(){

    const {nombre, fecha, hora, servicios, id} = cita;
    const servicioId = servicios.map(servicio => servicio.id);

    const datos  = new FormData();
    datos.append('fecha',fecha);
    datos.append('hora',hora);
    datos.append('usuarioId',id);
    datos.append('servicios',servicioId);
   // console.log(fecha)
    //peticion a la api
    try {
        const url = `${location.origin}/api/cita`;
        const respuesta = await fetch(url,{
            method: 'POST',
            body: datos
        })
        const resultado = await respuesta.json()
        //console.log(resultado)
        //console.log([...data])
        if(resultado.resultado === true){
            Swal.fire({
                title: "Cita agendada",
                text: "La cita fue agendada correctamente!",
                icon: "success"
              }).then(()=>{
                setTimeout(() => {
                    window.location.reload();
                },3000);
              });
        }
    } catch (error) {
        Swal.fire({
            title: "Error",
            text: "Hubo un error al crear la cita",
            icon: "error"
          })
    }
}