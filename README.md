# PHP Classes

Some useful PHP Classes written and used by KIMB-technologies.

> This repo is under development, the RedisCache class is new, the other ones are older.

## JSONReader
A JSON based data storage class. Store strings, integers, booleans and arrays in a JSON file.
Supports file locking for thread save reading and writing of files. Support for multiple files
and multiple folders. 

- Add, update and remove values
- Add as array or get as array
- Search values
- Check values

## RedisCache
A Redis Cache abstraction class for PECL redis. Open a dataset containing 
values, lists and maps of values. Set the expire time for values.

- Load data from a JSONReader object
- Get a cached value and provide a callback to fetch it, if expired.

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


