<html>
<body link="#3366CC" vlink="#3366CC" alink="#3366CC">
<br><br><br><br><br>
<STYLE TYPE="text/css">
a:link { color: #3366CC; text-decoration: underline }
a:active { color: #3366CC; text-decoration: underline }
a:visited { color: #3366CC; text-decoration: underline }
a:hover { color: #FF6699; text-decoration: underline }
</STYLE>
<table border=0 width=1000px height=600px>
<font size=2 face="arial">
<em>
<?php

if ((isset($_GET['username'])) and (isset($_GET['dt'])) and (isset($_GET['message'])))
{
        $username = $_GET['username'];
        $dt = $_GET['dt'];
        $message = $_GET['message'];

        $db = new PDO('sqlite:/opt/database/habwatch.sqlite3');
        $sqlinsert = 'INSERT INTO text (username, dt, message) VALUES (:username, :dt, :message)';
        $stmt = $db->prepare($sqlinsert);

        $stmt->bindValue(':username', $username, PDO::PARAM_STR);
        $stmt->bindValue(':dt', $dt, PDO::PARAM_STR);
        $stmt->bindValue(':message', $message, PDO::PARAM_STR);
        $stmt->execute();

        echo "Message recorded!";
}
else
{
        echo "Message error!";
}
?>
</em></font>
</table>
</body>
</html>

