<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <title>Poligonos</title>
</head>
<body>
    <div class="container">
        <div class="body">
            <div class="jumbotron">
            <div class="row">
                <div class="col-6"><h2>Cadastro de Triângulo</h2>
                    <form id="formTriangulo">
                        <div class="row">
                            <div class="col-6"><div class="form-group">
                                <label for="exampleInputEmail1">Lado A</label>
                                <input type="number" class="form-control" id="ladoA" placeholder="Lado A">
                              </div>
                              <div class="form-group">
                                <label for="ladoB">Lado B</label>
                                <input type="number" class="form-control" id="ladoB" placeholder="Lado B">
                              </div></div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Lado C</label>
                                    <input type="number" class="form-control" id="ladoC" placeholder="Lado C">
                                  </div>
                            </div>
                          </div>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                        <small id="saveTri" style="display: none">Salvo!</small>
                      </form></div>
                <div class="col-6">
                    <h2>Cadastro de Retângulo</h2>
                    <form id="formRetangulo">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="ladoH">Lado H</label>
                                    <input type="number" class="form-control" id="altura" placeholder="Altura">
                                  </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="ladoB">Lado B</label>
                                    <input type="number" class="form-control" id="base" placeholder="Base">
                                  </div>
                            </div>
                          </div>
                        
                        
                        <button type="submit" class="btn btn-primary">Salvar</button>
                        <small id="saveRet" style="display: none">Salvo!</small>
                      </form></div>
              </div>
            
        </div>
        <div class="row">
            <div class="col-12">
                <h5>Clique para obter a somas das áreas dos Polígonos cadastrados</h5>
                <button type="text" class="btn btn-primary" onclick="calcular()">Calcular</button>
                <p>Soma das Áreas é: <span id="resultado"></span></p>
            </div>
          </div>
        </div>
    </div>
        
    <script type="text/javascript">
    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN': "{{csrf_token()}}"
        }
    });
        // const formA = document.querySelector("#formTriangulo")
        $("#formTriangulo").submit( function(event){
            event.preventDefault();
            salvarTrinagulo()
        })
        $("#formRetangulo").submit( function(event){
            event.preventDefault();
            salvarRetangulo();
        })
        function salvarTrinagulo(){
            let tri = {
                ladoA : $("#ladoA").val(),
                ladoB : $("#ladoB").val(),
                ladoC : $("#ladoC").val()
            }
            $.post("/api/triangulos", tri, function(data){
                if(data == "salvo"){
                    $("#saveTri").show()
                    setTimeout(function() {
                        $("#saveTri").hide()
                    }, 5000);
                }else{
                    $("#saveTri").text(data)
                    $("#saveTri").show()
                    setTimeout(function() {
                        $("#saveTri").hide()
                        $("#saveTri").text("Salvo!")
                    }, 5000);
                }
            })
        }
        function salvarRetangulo(){
            let ret = {
                ladoH : $("#altura").val(),
                ladoB : $("#base").val()
            }
            $.post("/api/retangulos", ret, function(data){
                if(data){
                    $("#saveRet").show()
                    setTimeout(function() {
                        $("#saveRet").hide()
                    }, 3000);
                }
            })
        }
        function calcular(){
            $.getJSON("/api/somaAreas", function(data){
                $("#resultado").text(data.toFixed(2))
            })
        }
    </script>
</body>
</html>