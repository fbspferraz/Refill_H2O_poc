
document.getElementById("start").value = '2021-06-25';
document.getElementById("end").value= '2021-06-30';

function changeUniOrganica(){
    var start = new Date(document.getElementById("start").value).getTime();
    var end = new Date(document.getElementById("end").value).getTime();
    var uniOrganica = document.getElementById("uniOrganica").value;
    document.getElementById("iframeGraphic").src = 'http://62.28.241.83:3000/d-solo/CS4T2cznk/refill_2?orgId=1&from='+start+'&to='+end+'&var-Curso=&var-Turma=&var-UnidadeOrganica='+uniOrganica+'&var-User=&panelId=11';
}

function changeCurso(){
    var start = new Date(document.getElementById("start").value).getTime();
    var end = new Date(document.getElementById("end").value).getTime();
    var curso = document.getElementById("curso").value;
    var uniOrganica = document.getElementById("uniOrganica").value;
    document.getElementById("iframeGraphic").src = 'http://62.28.241.83:3000/d-solo/CS4T2cznk/refill_2?orgId=1&from='+start+'&to='+end+'&var-Curso='+curso+'&var-Turma=&var-UnidadeOrganica='+uniOrganica+'&var-User=&panelId=12';
}

function changeTurma(){
    var start = new Date(document.getElementById("start").value).getTime();
    var end = new Date(document.getElementById("end").value).getTime();
    var turma = document.getElementById("turma").value;
    var uniOrganica = document.getElementById("uniOrganica").value;
    var curso = document.getElementById("curso").value;
    document.getElementById("iframeGraphic").src = 'http://62.28.241.83:3000/d-solo/CS4T2cznk/refill_2?orgId=1&from='+start+'&to='+end+'&var-Curso='+curso+'&var-Turma='+turma+'&var-UnidadeOrganica='+uniOrganica+'&var-User=&panelId=13';
}

function changeInstituto(){
    var start = new Date(document.getElementById("start").value).getTime();
    var end = new Date(document.getElementById("end").value).getTime();
    document.getElementById("iframeGraphic").src = 'http://62.28.241.83:3000/d-solo/CS4T2cznk/refill_2?orgId=1&from='+start+'&to='+end+'&var-Curso=&var-Turma=&var-UnidadeOrganica=1&var-User=&panelId=8';
}

function changeAgua(){
    var start = new Date(document.getElementById("start").value).getTime();
    var end = new Date(document.getElementById("end").value).getTime();
    document.getElementById("iframeGraphic").src = 'http://62.28.241.83:3000/d-solo/CS4T2cznk/refill_2?orgId=1&from='+start+'&to='+end+'&var-Curso=&var-Turma=&var-UnidadeOrganica=&var-User=&panelId=15';
}

function changeMetrica(){
    var start = new Date(document.getElementById("start").value).getTime();
    var end = new Date(document.getElementById("end").value).getTime();
    document.getElementById("iframeGraphic1").src = 'http://62.28.241.83:3000/d-solo/CS4T2cznk/refill_2?orgId=1&from='+start+'&to='+end+'&var-Curso=&var-Turma=&var-UnidadeOrganica=&var-User=&panelId=2';
    document.getElementById("iframeGraphic2").src = 'http://62.28.241.83:3000/d-solo/CS4T2cznk/refill_2?orgId=1&from='+start+'&to='+end+'&var-Curso=&var-Turma=&var-UnidadeOrganica=&var-User=&panelId=4';
    document.getElementById("iframeGraphic3").src = 'http://62.28.241.83:3000/d-solo/CS4T2cznk/refill_2?orgId=1&from='+start+'&to='+end+'&var-Curso=&var-Turma=&var-UnidadeOrganica=&var-User=&panelId=6';
}

function changeUser(){
    var start = new Date(document.getElementById("start").value).getTime();
    var end = new Date(document.getElementById("end").value).getTime();
    document.getElementById("iframeGraphic").src = 'http://62.28.241.83:3000/d-solo/CS4T2cznk/refill_2?orgId=1&from='+start+'&to='+end+'&var-Curso=&var-Turma=&var-UnidadeOrganica=&var-User='+user+'&panelId=14';
}