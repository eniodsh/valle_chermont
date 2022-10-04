<?php

/**
 * @var array $contato Array com os campos do contato cadastrado.
 *
 * Se alterar algo neste arquivo, lembre de modificar também na versão somente texto.
 */

echo
	PHP_EOL. 'Nome: ' . $contato['nome'],
	PHP_EOL. 'E-mail: ' . $contato['email'],
	PHP_EOL. 'Celular: ' . $contato['celular'],
    PHP_EOL. 'Cidade: ' . $contato['cidade'],
	PHP_EOL. 'Mensagem: ' . $contato['mensagem'];
