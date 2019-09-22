<?php
// PHPDoc. does not support nullable Types, so remove the ? for doc generation
file_put_contents(
	'./php/classes/RedisCache.php',
	str_replace(
		'(string $key, ?string $arrayKey,',
		'(string $key, string $arrayKey,',
		file_get_contents('./php/classes/RedisCache.php')
	)
);
?>