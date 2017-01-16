<?php
// declaracao das variaveis de validacao
$nameErr = $emailErr = $addressErr = $phoneErr = "";
$name = $email = $phone = $address = $age = "";
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
    // verifica se a entrada possui somente espacos e letras
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
    $addressErr = "Endereço é obrigatório";
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
    // verifica a formatacao do email
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
//tratamento dos dados de entrada-----------------------------
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
//se todos os campos == OK, insere no banco
 if ($verifyName == 1 && $verifyAddress == 1 && $verifyPhone == 1 && $verifyEmail == 1)
 {
	 //inserção no banco
 }
 
 //verificacao da marcacao dos botoes de genero
 function verificaRadio()
 {
	
	
	$gender = test_input($_POST["gender"]);
	$radio = test_input($_POST["gen"]);
	if (isset($gen) && $gender=="female") echo "checked";
  
	
	if($radio == "M")
	{
		echo "checked"; 
	}
	else 
	if($radio == "F")
	{ 
		echo "checked"; 
	}
 }
?>

<!DOCTYPE html>
<html>
	<head>
		<!-- Definição da Codificação do texto-->
		<meta charset="utf-8"/> 
		<!--Controle de escala - mobile-->
		<meta name="viewport" content="width=device-width, initial-scale=1"/>
		<script src="validaForm.js" ></script>
	</head>

	<body>
		
		<h1> Formulário de Cadastro </h1>
	
		<!--------------------------------------------------------------------------------->
		
		<p><span class="error">* campos obrigatórios.</span></p>
	
		<form name="cadastro" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
			Nome: <input type="text" name="name" value="<?php echo $name;?>">
			<span class="error">* <?php echo $nameErr;?></span>
			<br><br>
			
			Idade: <input type="text" name="age" value="<?php echo $age;?>">
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
			
			Sexo: <input type="radio" name="gen" value="M" <?php verificaRadio();?> >	Masculino <br>
				  <input type="radio" name="gender" value="female">Female
				  
				  <input type="radio" name="gen" value="F" <?php verificaRadio();?> >	Feminino<!---->
				  <br><br>
			<input type="button" onClick="validaForm();" name="submit" value="Cadastrar">  
		</form>
	
	</body>
</html>
	