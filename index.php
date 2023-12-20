<?php
function generatePassword($qtCharacters = 32)
{
    // Letras Minúsculas embaralhadas
    $smallLetters = str_shuffle('abcdefghijklmnopqrstuvwxyz');

    // Letras Maiúsculas embaralhadas
    $capitalLetters = str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ');

    // Números aleatórios
    $numbers = (((date('Ymd') / 12) * 24) + mt_rand(800, 9999));
    $numbers .= str_shuffle('1234567890');

    // Caracteres Especiais
    $specialCharacters = str_shuffle('!@#$%*-');

    // Junta tudo
    $characters = $capitalLetters . $smallLetters . $numbers . $specialCharacters;

    // Embaralha e pega apenas a quantida de caracteres informada no parâmetro
    $password = substr(str_shuffle($characters), 0, $qtCharacters);

    // Retorna a senha
    return $password;
}

$qt = filter_input(INPUT_POST, 'qt', FILTER_DEFAULT);

$password = generatePassword($qt);

?>

<h2>Criar Senha Segura e Copiar pra Área de Transferência</h2>

<form method="post">
    <label for="qt">Quantidade de caracteres da senha:</label>
    <input type="number" name="qt" id="qt" value="32">
    <input type="submit" value="Gerar Senha">
</form>
<hr>
<div>
    Senha Gerada:
    <div id="textoParaCopiar">
        <?php echo $password; ?>
    </div>
    <br>
    <button onclick="copiarTexto()">Copiar Senha</button>
</div>

<script>
    function copiarTexto() {
        var texto = document.getElementById("textoParaCopiar").innerText;
        navigator.clipboard.writeText(texto)
            .then(() => {
                alert("Senha copiada!");
            })
            .catch(err => {
                console.error('Erro ao copiar senha: ', err);
            });
    }
</script>