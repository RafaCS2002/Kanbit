<?php 
$cont = 2;
while($cont < 100){
	echo "INSERT INTO user (nome, sobrenome, login, senha, cpf, cargo, email) VALUES
	('Roberto$cont', 'Alberto$cont', 'alberto$cont.roberto$cont', '', '759.369.852-45', 'Empregado$cont', 'roberto$cont@gmail.com'),
	('Kleverson$cont', 'Silva$cont', 'silva$cont.kleverson$cont', '', '426.486.126-87', 'Assistência$cont', 'kleverson$cont@gmail.com'),
	('Jorge$cont', 'Amado$cont', 'amado$cont.jorge$cont', '', '624.759.153-65', 'Mr Cafézin$cont', 'jorge$cont@gmail.com'); <br>";

	$cont = $cont + 1;
}