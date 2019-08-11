function CriaRequest() {
    try {
        request = new XMLHttpRequest();        
    } catch (IEAtual){    
    try{
        request = new ActiveXObject("Msxml2.XMLHTTP");       
    } catch(IEAntigo){ 
        try{
        request = new ActiveXObject("Microsoft.XMLHTTP");          
        } catch(falha){
        request = false;
        }
    }
    }  
    if (!request) 
        alert("Seu Navegador não suporta o Prove! Atualize ou mude de navegador");
    else
        return request;
    }
function alternativaUnicaAdicionar () {  
    var xmlreq = CriaRequest();
    var qtdUnica = parseInt(document.getElementById('qtdUnica').value) + 1;
    var unicaContainer = document.getElementById('unicaContainer');
    unicaContainer.innerHTML = '<div class="progress"><div class="indeterminate"></div></div>';
    xmlreq.open("GET", "alternativa-unica.php?qtdUnica=" + qtdUnica, true);
    xmlreq.onreadystatechange = function(){
        if (xmlreq.readyState == 4) {
            if (xmlreq.status == 200) {
                parseInt(document.getElementById('qtdUnica').value = qtdUnica);
                unicaContainer.innerHTML = xmlreq.responseText;
            } else{
                unicaContainer.innerHTML = "Erro: " + xmlreq.statusText;
            }
        }
    };
    xmlreq.send(null);
}
function alternativaUnicaRemover () {  
    var xmlreq = CriaRequest();
    var qtdUnica = parseInt(document.getElementById('qtdUnica').value) - 1;
    var unicaContainer = document.getElementById('unicaContainer');
    unicaContainer.innerHTML = '<div class="progress"><div class="indeterminate"></div></div>';
    xmlreq.open("GET", "alternativa-unica.php?qtdUnica=" + qtdUnica, true);
    xmlreq.onreadystatechange = function(){
        if (xmlreq.readyState == 4) {
            if (xmlreq.status == 200) {
                parseInt(document.getElementById('qtdUnica').value = qtdUnica);
                unicaContainer.innerHTML = xmlreq.responseText;
            } else{
                unicaContainer.innerHTML = "Erro: " + xmlreq.statusText;
            }
        }
    };
    xmlreq.send(null);
}
function alternativaMultiplaAdicionar () {  
    var xmlreq = CriaRequest();
    var qtdMultipla = parseInt(document.getElementById('qtdMultipla').value) + 1;
    var multiplaContainer = document.getElementById('multiplaContainer');
    multiplaContainer.innerHTML = '<div class="progress"><div class="indeterminate"></div></div>';
    xmlreq.open("GET", "alternativa-multipla.php?qtdMultipla=" + qtdMultipla, true);
    xmlreq.onreadystatechange = function(){
        if (xmlreq.readyState == 4) {
            if (xmlreq.status == 200) {
                parseInt(document.getElementById('qtdMultipla').value = qtdMultipla);
                multiplaContainer.innerHTML = xmlreq.responseText;
            } else{
                multiplaContainer.innerHTML = "Erro: " + xmlreq.statusText;
            }
        }
    };
    xmlreq.send(null);
}
function alternativaMultiplaRemover () {  
    var xmlreq = CriaRequest();
    var qtdMultipla = parseInt(document.getElementById('qtdMultipla').value) - 1;
    var multiplaContainer = document.getElementById('multiplaContainer');
    multiplaContainer.innerHTML = '<div class="progress"><div class="indeterminate"></div></div>';
    xmlreq.open("GET", "alternativa-multipla.php?qtdMultipla=" + qtdMultipla, true);
    xmlreq.onreadystatechange = function(){
        if (xmlreq.readyState == 4) {
            if (xmlreq.status == 200) {
                parseInt(document.getElementById('qtdMultipla').value = qtdMultipla);
                multiplaContainer.innerHTML = xmlreq.responseText;
            } else{
                multiplaContainer.innerHTML = "Erro: " + xmlreq.statusText;
            }
        }
    };
    xmlreq.send(null);
}