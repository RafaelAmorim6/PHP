<?php
// declaracao das variaveis de validacao
$nameErr = $emailErr = $addressErr = $phoneErr = "";
$name = $email = $phone = $address = "";
$verifyName = $verifyAddress = $verifyPhone = $verifyEmail = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
//verifica o campo nome----------------------------------------------------------
  if (empty($_POST["name"])) // recebimento do valor do atributo HTML 
  {
    $nameErr = "Nome é obrigatório";
  } 
  else 
  {
    $name = test_input($_POST["name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$name)) 
	{
      $nameErr = "São permitidos somente espacos e letras";
    }
	else
	{
		$verifyName = 1;
	}
  }
 //verifica o campo endereco  ------------------------------------------------
  if (empty($_POST["address"])) 
  {
    $addressErr = "Endereco é obrigatório";
  } 
  else 
  {
    $address = test_input($_POST["address"]);
	if (!preg_match("/^[a-zA-Z0-9 ]*$/",$address)) 
	{
      $addressErr = "São permitidos somente espacos e letras";
    }
	else
	{
		$verifyAddress = 1;
	}
  }
  //verifica o campo telefone-------------------------------------------
  if (empty($_POST["phone"])) 
  {
    $phoneErr = "Telefone é obrigatório";
  } 
  else 
  {
    $phone = test_input($_POST["phone"]);
	if (!preg_match("/^[0-9 ]*$/",$phone)) 
	{
      $phoneErr = "São permitidos somente números";
    }
	else
	{
		$verifyPhone = 1;
	}
  }
 //verifica o campo email------------------------------------------------------
  if (empty($_POST["email"])) 
  {
    $emailErr = "Email é obrigatório";
  } 
  else 
  {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
	{
      $emailErr = "Formato inválido de email";
    }
	else
	{
		$verifyEmail = 1;
	}
  }


}
//verifica se nao há um codigo malicioso nos dados-----------------------------
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
//se todos os campos == OK, insere no banco
 if ($verifyName == 1 && $verifyAddress == 1 && $verifyPhone == 1 && $verifyEmail == 1)
 {
	 inserePedido($name,$address,$phone,$email);
 }
?>

<!DOCTYPE html>
<html>
	<head>
		<!-- Definição da Codificação do texto-->
		<meta charset="utf-8"/> 
		<!--Controle de escala em mobile-->
		<meta name="viewport" content="width=device-width, initial-scale=1"/>
	
		<script>
			function validaForm()
			{
				var tamanho_nome = document.forms["meuForm"].CAMPO_NOME.value.length;
				if(tamanho_nome < 5 || tamanho_nome > 64)
				{
					alert("O campo 'Nome' deve ter entre 5 e 64 caracteres.");
					return false;
				}
      
				var idade = document.forms["meuForm"].CAMPO_IDADE.value;
				if(isNaN(idade) || idade < 4 || idade > 120)
				{
					alert("O campo 'Idade' deve ter preenchido corretamente.");
					return false;
				}
      
				var email = document.forms["meuForm"].CAMPO_EMAIL.value;
				if(email.length < 5  || email.length > 128 || email.indexOf('@') == -1 || email.indexOf('.') == -1)
				{
					alert("O campo 'E-mail' deve ter preenchido corretamente.");
					return false;
				}
      
				var campo_sexo = document.forms["meuForm"].CAMPO_SEXO;

				var sexo = false;

				for (i=0; i<campo_sexo.length; i++)
				{
					if(campo_sexo[i].checked == true)
					{
						sexo = campo_sexo[i].value;
						break;
					}
				}
				if(sexo == false)
				{
					alert("O campo 'Sexo' deve ser preenchido.");
					return false;
				}
       
				var opcao_curso = document.forms["meuForm"].CAMPO_CURSO.selectedIndex;
				if(opcao_curso == 0)
				{
					alert("O campo 'Curso' deve ser preenchido.");
					return false;
				}
       
				var conhecimentos = document.forms["meuForm"].elements['CAMPO_CONHECIMENTOS[]'];     
				var conhecimentosMarcados = 0;
				for (i=0; i<conhecimentos.length; i++)
				{
					if(conhecimentos[i].checked == true)
					{
						conhecimentosMarcados++;
					}
				}
				if(conhecimentosMarcados != 2)
				{
					alert("É necessário marcar 2 conhecimentos.");
					return false;
				}
				document.forms["meuForm"].submit();
			}
		</script>
	</head>

	<body>
		
		<h1> Cadastro de Clientes </h1>
	
		<!--------------------------------------------------------------------------------->
		
		<p><span class="error">* campos obrigatórios.</span></p>
	
		<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
			Nome: <input type="text" name="name" value="<?php echo $name;?>">
			<span class="error">* <?php echo $nameErr;?></span>
			<br><br>
	
			Endereco: <input type="text" name="address" value="<?php echo $address;?>">
			<span class="error">* <?php echo $addressErr;?></span>
			<br><br>
	
			Telefone: <input type="text" name="phone" value="<?php echo $phone;?>">
			<span class="error">* <?php echo $phoneErr;?></span>
			<br><br>
	
			E-mail: <input type="email" name="email" value="<?php echo $email;?>">
			<span class="error">* <?php echo $emailErr;?></span>
			<br><br>
		
			<input type="button" onClick="validaForm();" name="submit" value="Cadastrar">  
		</form>
	
	</body>
</html>
	