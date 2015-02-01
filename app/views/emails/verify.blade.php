<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Молодежная Женская Организация</title>
</head>
<body>
	Докажите что вы не робот :)
	<a href="{{ URL::to('/') . '/register/verify/' . $code }}">
		Нажмите сюда
	</a>
</body>
</html>