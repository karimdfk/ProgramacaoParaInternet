<?php

require "../conexaoMysql.php";
$pdo = mysqlConnect();

$codigoAnuncio = $_GET["cod"] ?? "";

try {

    $sql = <<<SQL
    SELECT a.titulo, a.descricao, a.preco, a.bairro, a.cidade, a.estado, f.nome_arquivo_foto
    FROM anuncio a, foto f
    WHERE a.codigo = f.cod_anuncio
    AND a.codigo = $codigoAnuncio
SQL;


    $stmt = $pdo->query($sql);
} catch (Exception $e) {
    //error_log($e->getMessage(), 3, 'log.php');
    exit('Ocorreu uma falha: ' . $e->getMessage());
}

$row = $stmt->fetch();

$titulo = htmlspecialchars($row['titulo']);
$descricao = htmlspecialchars($row['descricao']);
$preco = htmlspecialchars($row['preco']);
$bairro = htmlspecialchars($row['bairro']);
$cidade = htmlspecialchars($row['cidade']);
$estado = htmlspecialchars($row['estado']);
$nomeFoto = htmlspecialchars($row['nome_arquivo_foto']);


?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="../docJS.js"></script>
    <title>Mirage</title>

    <style>
        .informacoes-joia {
            margin: 50px auto;
            max-width: 1000px;
        }

        .imagem-joia {
            float: left;
            margin-right: 50px;
        }

        .item-image {
            width: 150px;
            height: 150px;
            margin: 0;
        }

        .descricao-joia p {
            text-align: justify;
        }

        #btnInteresse {
            display: block;
            margin-left: 270px;
        }

        #divInteresse {
            display: none;
            width: 50%;
            margin: 0 auto;
        }

        .inputInteresse,
        #btnInter {
            margin: 5px 0px;
            width: 100%;
            padding: 0.4rem;
            outline: none;
            box-sizing: border-box;
        }

        #estilopreco{
            color: darkgreen; 
        }
    </style>

</head>

<body>
    <header>
        <h1>Mirage</h1>
        <img src="../img/logo.png" id="logo" alt="logo" width="80px" height="80px" class="logo">
    </header>

    <nav>
        <section>
            <ul>
                <li><a href="../index.html">Home</a></li>
                <li><a href="../usuario/login/login.html">Login</a></li>
                <li><a href="../usuario/cadastro/cadastroUsuario.html">Cadastro</a></li>
            </ul>
        </section>
    </nav>

    <main>

        <section class="informacoes-joia">

            <div class="imagem-joia">
                <img class="item-image" src="../img/imgAnuncios/<?php echo $nomeFoto ?>">
            </div>
            <div class="descricao-joia">

                <h2>
                    <?php echo $titulo ?>
                </h2>

                <p>
                    <?php echo $descricao ?>
                </p>

                <h2 id="estilopreco">
                    R$<?php echo $preco ?>
                </h2>
            </div>

            <div class="descricao-joia">
                <h2>
                    Endereço:
                </h2>
                <p>
                    <?php echo $bairro ?>,
                    <?php echo $cidade ?> -
                    <?php echo $estado ?>
                </p>

            </div>

            <button class="btn" id="btnInteresse">Mensagem de interesse</button>
        </section>

        <div id="divInteresse">

            <form action="../interesse/interesse.php?anuncio=<?php echo $codigoAnuncio ?>" method="post">

                <h2>Deixe sua mensagem de Interesse</h2>

                <div>
                    <label for="mensagem">Mensagem</label>
                    <input class="inputInteresse" type="text" id="mensagem" name="mensagem" required>
                </div>
                <div>
                    <label for="contato">Email de contato</label>
                    <input class="inputInteresse" type="email" id="contato" name="contato" required>
                </div>

                <button class="btn">Enviar</button>


            </form>

        </div>


    </main>


    <footer>
        <address>Av. João Naves de Ávila, Santa Mônica, Uberlândia</address>
    </footer>

    <script>
        function mostraDivInteresse() {
            const btnInteresse = document.querySelector("#btnInteresse");
            const divInteresse = document.querySelector("#divInteresse");

            if (btnInteresse.textContent === "Fechar") {
                btnInteresse.textContent = "Mensagem de interesse";
                divInteresse.style.display = 'none';
            }
            else {
                btnInteresse.textContent = "Fechar";
                divInteresse.style.display = 'block';
            }

        };

        window.onload = function () {
            const btnInteresse = document.querySelector("#btnInteresse");
            btnInteresse.onclick = () => mostraDivInteresse();
        };
    </script>

</body>

</html>