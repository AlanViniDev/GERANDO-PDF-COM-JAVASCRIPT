<!-- Chama a biblioteca jquery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

<!-- Biblioteca para gerar PDF -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.4.1/jspdf.debug.js" integrity="sha384-THVO/sM0mFD9h7dfSndI6TS0PgAGavwKvB5hAxRRvc0o9cPLohB0wb/PTA7LdUHs" crossorigin="anonymous"></script>

<script type = "text/javascript">
jQuery(document).ready(function(){
var param = 10;
    jQuery.ajax({
        url: 'teste2.php',
        ascyn: false,
        data:{
            'param': param
        },
        type: 'POST',
        dataType: 'html',
        success: function (data){
        /*Recebe os dados*/
        var dados = [];
        var produtos = [];
        dados.push(JSON.parse(data));
        /* Salva os dados na localStorage para gerar o PDF */
        localStorage.setItem("dadosPDF",(data));
        /* Carrega os dados da tabela */
        dados.forEach((elem) => {
            for(i = 0; i <= (elem.length-1); i++){
                produtos.push(`
                    <tr>
                        <td>${elem[i].idprod}</td>
                        <td>${elem[i].nome}</td>
                        <td>${elem[i].cor}</td>
                        <td>${elem[i].preco}</td>
                    </tr>
                `);
            }
        });    
        /* Tabela */
        tabela.innerHTML = [`
            <table class='table table-dark tabela'>
            <thead>
                <tr>
                <th scope='col'>ID Produto</th>
                <th scope='col'>Cor</th>
                <th scope='col'>Nome</th>
                <th scope='col'>Preço</th>
                </tr>
            </thead>
            <tbody>
            ${produtos.join('')}
            </tbody>
            </table>
        `];
    }
});
});
</script>
<style>
.tabela{
    position:relative;
    top:50px;
}
.icons{
    width:150px;
    float:right;
    top:25px;
    position:relative;
}
</style>
<div class = "icons">
<img src = "pdf.png" style = "cursor:pointer;" onclick = "gerarPDF();"/>
<img src = "word.png" style = "cursor:pointer;"/>
<img src = "imprimir.png" style = "cursor:pointer;"/>
</div>
<div id = "tabela">
</div>


<!-- Gerar PDF -->
<script>

var doc = new jsPDF();

function gerarPDF(){

var dadosPDF = [];
var dados = [];
var produtos = [];
dadosPDF = localStorage.getItem("dadosPDF");

dados.push(JSON.parse(dadosPDF));
dados.forEach((elem) => {
            for(i = 0; i <= (elem.length-1); i++){
                produtos.push(' ID: '+elem[i].idprod+', Nome: '+elem[i].nome+', Cor: '+elem[i].cor+', Preco: '+elem[i].preco);
            }
});    

doc.text('TABELA CADASTRO', 10, 10);
jsPDF.API.mymethod = function(){
    doc.text(produtos,10,20);
}
var pdfdoc = new jsPDF()
pdfdoc.mymethod() 
doc.save('a4.pdf');
}
</script>