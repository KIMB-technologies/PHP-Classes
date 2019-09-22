# PHP Classes

Some useful PHP Classes written and used by KIMB-technologies.

> Also see the [PHP-Doc](https://kimb-technologies.github.io/PHP-Classes/index.html)!

All classes, except for the RedisCache, just need a default PHP installation greater 7.0.
The redis class uses the PHPRedis from PECL `pecl install redis`.  
Use the `docker-compose` file to run the examples, just open `http://localhost:8080/`.

## JSONReader
A JSON based data storage class. Store strings, integers, booleans and arrays in a JSON file.
Supports file locking for thread save reading and writing of files. Support for multiple files
and multiple folders. 

- Add, update and remove values
- Add as array or get as array
- Search values
- Check values

[&rarr; Example Code](https://github.com/KIMB-technologies/PHP-Classes/blob/master/php/json_ex.php)

## RedisCache
A Redis Cache abstraction class for PECL redis. Open a group containing 
single values and arrays of values. Set the expire time for values.

[&rarr; Example Code](https://github.com/KIMB-technologies/PHP-Classes/blob/master/php/redis_ex.php)

## Utilities
Some static helper functions.

- Clean a string to use as filename
- Check something with a regex
- Generate random string from chars

## Template
A small template class for PHP. A template is written in HTML using placeholders.
The PHP class will load the template and is able to fill the placeholdes with given values.

- Multilanguage, a template per language
- SiteURL as default placeholder
- Include a template in another
- Multiple placeholders, a part of the template is multiplied for an array of values
- A template consists of the HTML files for each language and a JSON listing all placeholders

[&rarr; Example Code](https://github.com/KIMB-technologies/PHP-Classes/blob/master/php/template_ex.php)
