<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">


    <title>formulier</title>


</head>


<body>


<div class= "container">

<form action="klacht.php" method="POST">

<div class="firstname">

<label for= firstname>Firstname :</label>
<input id = firstname type="text" name="firstname" placeholder="firstname...">

</div>


<div> 

<label for= Email>Email :</label>
<input id = Email  type="text" name="Email" placeholder="Email...">

</div>

<div> 

<label for= klacht> omschrijving klacht :</label>

<textarea style="resize: none;" name="klacht" id="klacht" cols="40" rows="5" placeholder="omschrijving klacht" ></textarea><br>


</div>

            <button type= "submit">send</button>

</form>

</div>


</body>
</html>



