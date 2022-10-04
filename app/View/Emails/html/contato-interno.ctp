<?php

/**
 * @var array $contato Array com os campos do contato cadastrado.
 *
 * Se alterar algo neste arquivo, lembre de modificar também na versão somente texto.
 */
?>

<table>
	<tr>
		<th>Nome:</th>
		<td><?php echo $contato['nome'] ?></td>
	</tr>
	<tr>
		<th>E-mail:</th>
		<td><?php echo $contato['email'] ?></td>
	</tr>
  <tr>
    <th>Celular:</th>
    <td><?php echo $contato['celular'] ?></td>
  </tr>
  <tr>
    <th>Cidade:</th>
    <td><?php echo $contato['cidade'] ?></td>
  </tr>
	<tr>
		<th>Mensagem:</th>
		<td><?php echo $contato['mensagem'] ?></td>
	</tr>
</table>
