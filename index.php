<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/indexstyle.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Partilha -Share and Be Shared</title>
</head>
<body>
    <header id="header">
    
       <a href="index.php" class="logo"><img src="img/logo/Partilha Logo.png" alt="logo"></a>
        <ul>
            <li><a href="#home" onclick="toggle()">Home</a></li>
            <li><a href="#objectives" onclick="toggle()">Trust Fabric's Objectives</a></li>
            <li><a href="#about" onclick="toggle()">About Us</a></li>
            <li><a href="searchpayment.php">Search document</a></li>
        </ul>
        <div class="toggle" onclick="toggle()"></div>

    </header>
    <section id="home">
        <div class="Wave"></div>
        <div>
            <h2>What is Trust Fabric</h2>
            <p>Trust Fabric is a software that allows you to produce, update and search for files records in a 
                secure manner by generating a hash key that gives access to the associated files. Secure because the
                 only way to have access to the files is by correctly typing the hash key </p>
            <a href="#">Read More</a>
        </div>
        <img src="img/svg/files.svg" alt="sharing img">

    </section>
    <section id="objectives">
        
        <div>
            <h2>Trust Fabric’s Objetives</h2>
            <p>The main Trust Fabric objective is to help manage files that businesses send to their clients and to let them grow in a organized and secure manner. 
We want trust fabric to be an easy way for you to guarantee your clients the documents they are receiving are secure and have not been modified in any way, Our system
 will be linked to a well known ledger system that will store any changes made to a document giving you a full understanding of ; who created the document originally, if
  anyone has made any changes to the document etc.</p>
            <a href="#">Read More</a>
        </div>
        <img src="img/svg/secure.svg" alt="team">

    </section>

    <section id="about">
        <div>
            <h2>About Us</h2>
            <p>The "Trust Fabric" project is the result of a collaboration between the University of Sunderland and the multinational company Sage.
The project was developed by a team of 5 students from the University of Sunderland, from different areas related to computing (computer Science, networking, cybersecurity and web development).
The team is composed by Matthew Slimmings, David Barbosa, Lee Yep Heang, Georgios Kompoulos and The Hoang Linh Nguyen.</p>
            <a href="#">Read More</a>
        </div>
        <img src="img/svg/team.svg" alt="team">
        <div class="Wave"></div>

    </section>
    <script type="text/javascript">
        function toggle(){
            var header = document.getElementById("header")
            header.classList.toggle('active')
        }
        
    </script>
</body>
</html>