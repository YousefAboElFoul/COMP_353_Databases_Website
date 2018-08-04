<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Satisfaction Form</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 750px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <h2>Contact Us</h2>
    <p>Please fill in your satsifaction rated between (1-10) and send us.</p>
    <form action="client.php" method="post">
        <p>
            <label for="inputnumber">Satisfaction:<sup>*</sup></label>
            <input type="number_format" name="name" id="inputnumber">
        </p>
      <!--     <p>
            <label for="inputEmail">Email:<sup>*</sup></label>
            <input type="text" name="email" id="inputEmail">
        </p>
        <p>
            <label for="inputSubject">Subject:</label>
            <input type="text" name="subject" id="inputSubject">
        </p>
        <p>
         <label for="inputComment">Message:<sup>*</sup></label>
            <textarea name="message" id="inputComment" rows="5" cols="30"></textarea>
        </p> -->
        <input type="submit" value="Submit">
        <input type="reset" value="Reset">
    </form>
</body>
</html>