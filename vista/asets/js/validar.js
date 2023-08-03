let nombre = document.getElementById("nombre");
let apaterno = document.getElementById("apaterno");
let amaterno = document.getElementById("amaterno");
let email = document.getElementById("user");
let password = document.getElementById("pass");
let foto = document.getElementById("foto");
let cargo = document.getElementById("rol");
let er = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.([a-zA-Z]{2,4})+$/;

eventListener();
function eventListener(){
    document.addEventListener("DOMContentLoaded", iniciarApp);
    nombre.addEventListener('blur', validarFormulario);
    email.addEventListener('blur', validarFormulario);
    celular.addEventListener('blur', validarFormulario);
    direccion.addEventListener('blur', validarFormulario);
    ciudad.addEventListener('blur', validarFormulario);
    fechaNacim.addEventListener('blur', validarFormulario);
    formulario.addEventListener('submit', enviarEmail);
}
function iniciarApp(){
    registrar.disabled = true;
    registrar.classList.add("disabled");
    registrar.style.cursor = "not-allowed";
}
function validarFormulario(e){
    if(e.target.value.length > 0){
        let error = document.querySelector(".error");
        if(error){
            error.remove();
        }
        e.target.classList.remove("border","border-danger");
        e.target.classList.add("border","border-success");
    }else{
        e.target.classList.remove("border","border-success");
        e.target.classList.add("border","border-danger");
        mostrarError("Todos los campos son obligatorios");
    }

    if(e.target.type === 'email'){
        if(er.test(e.target.value)){
            let error = document.querySelector(".error");
            if(error){
                error.remove();
            }
            e.target.classList.remove("border","border-danger");
            e.target.classList.add("border","border-success");
        }else{
            e.target.classList.remove("border","border-success");
            e.target.classList.add("border","border-danger");
            mostrarError("Email no válido");
        }
    }
    if(nombre.value !== '' && er.test(email.value) && celular.value !== '' && direccion.value !== '' && ciudad.value !== '' && fechaNacim !== ''){
        registrar.disabled = false;
        registrar.classList.remove("disabled");
        registrar.style.cursor = "pointer";
    }
}
function mostrarError(mensaje){
    let mensajeError = document.createElement('p');
    mensajeError.textContent = mensaje;
    mensajeError.classList.add("alert","alert-danger","p-3","mt-3","text-center","error");
    const errores = document.querySelectorAll(".error");
    if(errores.length === 0){
        formulario.appendChild(mensajeError);
    }
}
function enviarEmail(e){
    e.preventDefault();
    setTimeout(()=>{
        let parrafo = document.createElement('p');
        parrafo.textContent = "Se registró correctamente";
        parrafo.classList.add("alert","alert-success","p-3","mt-3","text-center");
        formulario.appendChild(parrafo);
        setTimeout(()=>{
            parrafo.remove();
            resetear();
        }, 5000);
    }, 3000);
}

function resetear(){
    formulario.reset();
    iniciarApp();
}

borrar.addEventListener('click', ()=>{
    resetear();
})
//Formulario Donaciones
let donar = document.getElementById("donar");
let cajaText = document.getElementById("cajaText");
let formDonaciones = document.getElementById("formDonaciones");

donar.addEventListener("click", ()=>{
    var s="no";
    for(var i=0; i<document.form2.Donacion.length; i++){
        if(document.form2.Donacion[i].checked){
            s= "si";
        }
    }
    if(s==="no"){
        mostrarError2("Elija la frecuencia con la que donará");
    }
    var s="no";
    for(var i=0; i<document.form2.Cantidad.length; i++){
        if(document.form2.Cantidad[i].checked){
            s= "si";
        }
    }
    if(s==="no"){
        mostrarError2("Elija la cantidad que donará");
    }
    if(s==="si"){
        // mostrarError2("Donación realizada correctamente")
        formDonaciones.addEventListener('submit', enviarDonacion);
    }
});
function enviarDonacion(e){
    e.preventDefault();
    setTimeout(()=>{
        let parrafo = document.createElement('p');
        parrafo.textContent = "Donación realizada correctamente";
        parrafo.classList.add("alert","alert-success","p-3","mt-3","text-center");
        formDonaciones.appendChild(parrafo);
        setTimeout(()=>{
            parrafo.remove();
            resetear();
        }, 5000);
    }, 3000);
}
function mostrarError2(mensaje){
    let mensajeError = document.createElement('p');
    mensajeError.textContent = mensaje;
    mensajeError.classList.add("alert","alert-danger","p-3","mt-3","text-center","error");
    const errores = document.querySelectorAll(".error");
    if(errores.length === 0){
        formDonaciones.appendChild(mensajeError);
    }
}
