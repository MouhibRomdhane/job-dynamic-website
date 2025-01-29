<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header></header>

    <section class="login">
        <div class="login_box">
            <div class="left">
                <div class="contact">
                    <form action="login.php" method="post">
                    <?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	<?php } ?>
                                                                                                                                                                                                                                                                
                        <h3>SE CONNECTER</h3>
                        <input type="text" id="username" placeholder="username" name="username"value=""/>
                        <input type="password" id="password" placeholder="Password" name="password"/>
                        <button class="submit">CONNEXION</button>
                      
                       
                        
                        <h4>INSCRIPTION</h4>
                        <br/>
                        <h5 class="inscription-employeur">
                            <a href="inscription_et.php">Vous êtes employeur ?</a>
                        </h5>
                        <h5 class="inscription-demendeur">
                            <a href="inscription_emp.php">Vous êtes demendeur ?</a>
                        </h5>
                        
                    </form>
                </div>
            </div>
            <div class="right">
               
            </div>
        </div>
    </section>


 
</body>

</html>