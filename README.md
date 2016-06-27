# The Cpf class

A CPF number is called a Cadastro de Pessoa Física or translated “Registration of a Physical Person” and with this class you can apply the validation of this number in your application and display its formatted value.

## Usage

CPF number valid, the following code uses a hypothetical number

```php
$cpf = new Cpf('06115058511');
$cpf->valid(); // true
$cpf->format(); // 061.150.585-11
```

You can set CPF number ignoring the digits from zero to left

```php
$cpf->set(6115058511); 
```

You can set CPF number formatted

```php
$cpf->set('061.150.585-11'); 
```

CPF number invalid

```php
$cpf = new Cpf('21601543695'); 
$cpf->valid(); // false
$cpf->format(); // NULL
```