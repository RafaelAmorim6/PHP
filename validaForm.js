function validaForm()
{
var tamanho_nome = document.forms["cadastro"]["name"].value.length;

	if(tamanho_nome < 5 || tamanho_nome > 64)
	{
		alert("O campo 'Nome' deve ter entre 5 e 64 caracteres.");
		return false;
	}
  
	var idade = document.forms["cadastro"].age.value;

	if(isNaN(idade) || idade < 4 || idade > 120)
	{
		alert("O campo 'Idade' deve ser preenchido corretamente.");
		return false;
	}
      
	var email = document.forms["cadastro"].email.value;

	if(email.length < 5  || email.length > 128 || email.indexOf('@') == -1 || email.indexOf('.') == -1)
	{
		alert("O campo 'E-mail' deve ter preenchido corretamente.");
		return false;
	}
      
	var campo_sexo = document.forms["cadastro"].gen;

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
       
	document.getElementById("cadastro").submit();
	alert("Formulário submetido com sucesso!");
}