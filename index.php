<!DOCTYPE html>
<html>
<head>
	<title>REST API</title>
</head>
<body>
		<h3>Welcome to my REST API</h3>
		<h5>Here you will some steps on how to use it!</h5>


			<!-- CREATE A CONTACT -->
		<ol>
			<li>CREATE</li>
			<ol>
				<li>Use this URL (http://localhost/api/Api/Create/Contact.php)</li>
				<li>Select body</li>
				<li>Select raw data</li>
				<li>Add some json data</li> <p>Example: {
											    "nombre" : "Contact1",
											    "apellido" : "Contact1",
											    "email" : "contact1@hotmail.com",
											    "telefono" : "000-000-0000"
											}</p>
				<img src="public/img/img1.jpg" alt="create" height="500" width="900">
				<li>if a field is empty, will show an error!</li>
				<img src="public/img/img2.png" alt="create" height="500" width="900">
			</ol>
				<!-- READ CONTACT USERS -->
			<ol>
				</br>
				</br>

				<li>READ</li>
				 	<ol>		 		
				 		<li>Use this URL (http://localhost/api/Api/Read/Contact.php)</li>
				 	</ol>

			</ol>
				</br>
				</br>


			<!-- READ CONTACT BY ID -->
		<ol>
			<li>READ CONTACT BY ID</li>
			<ol>
				<li>Use this URL (http://localhost/api/Api/Read/contact_by_id.php)</li>
				<li>Select body</li>
				<li>Select raw data</li>
				<li>Add some json data</li> <p>Example: {
												    "id" : 2
												}</p>
				<img src="public/img/img3.jpg" alt="create" height="500" width="900">
				<li>if a field is empty, will show an error!</li>
				<img src="public/img/img4.jpg" alt="create" height="500" width="900">
			</ol>


			</br>
			</br>


			<!-- DELETE CONTACT BY ID -->
		<ol>
			<li>DELETE CONTACT BY ID</li>
			<ol>
				<li>Use this URL (http://localhost/api/Api/Delete/Contact.php)</li>
				<li>Select body</li>
				<li>Select raw data</li>
				<li>Add some json data</li> <p>Example: {
												    "id" : 1
												}</p>
				<img src="public/img/img5.jpg" alt="create" height="500" width="900">
				<li>if a field is empty, will show an error!</li>
				<img src="public/img/img6.jpg" alt="create" height="500" width="900">
			</ol>
		</ol>


		<h2>Thats all!</h2>
		<h2>Developed by Samuel Peralta</h2>

</body>
</html>