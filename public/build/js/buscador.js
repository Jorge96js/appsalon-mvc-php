function iniciarAPP(){buscarPorFecha()}function buscarPorFecha(){document.getElementById("fecha").addEventListener("input",n=>{const e=n.target.value;window.location="?fecha="+e})}document.addEventListener("DOMContentLoaded",(function(){iniciarAPP()}));