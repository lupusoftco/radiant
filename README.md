# Lupusoft® Radiant E-Commerce Package

 Your install is complete when you download package and create phpmyadmin database

# Requirements

PHP 5.3 and later.

### Note

If you have any questions, please open an issue on Github or contact us at admin@lupusoft.com.

# Installation

You can install the package via PhpMyAdmin. Create the database following name:

```bash
lupusoft
```


# Order Code Creating Function

```php
function orderCodeCreator() {
	$siparisnumarasi = uniqid('SIP'.$_SESSION["uyeid"].rand(0,999));
	@$sipnosorgula = mysqli_query($db,"select * from siparis where siptakipno = '".$siparisnumarasi."'");
	if(@mysqli_num_rows($sipnosorgula) > 0){
		while(mysqli_num_rows($sipnosorgula) < 1){
			$siparisnumarasi = uniqid('SIP'.$_SESSION["uyeid"].rand(0,999));
			$sipnosorgula = mysqli_query($db,"select * from siparis where siptakipno = '".$siparisnumarasi."'");
		}
	}
	return $siparisnumarasi;
}
```
See other samples under samples directory.

Or to run an individual test checkout page:

```bash
./order.php
```
