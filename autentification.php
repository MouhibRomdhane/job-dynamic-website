<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .left .top_link a {
    color: #452A5A;
    font-weight: 400;
}

.left .top_link {
    height: 20px
}

.left .contact {
    display: flex;
    align-items: center;
    justify-content: center;
    align-self: center;
    height: 100%;
    width: 73%;
    margin: auto;
}
.left .contactET {
    display: flex;
    align-items: center;
    justify-content: center;
    align-self: center;
    height: 90%;
    width: 73%;
    margin: auto;
}
.login {
    display: flex;
    align-items: center;
}

.left {
    width: 22%;
    height: 50%;
    padding: 25px 25px;
    border-radius: 20px;
    margin: auto;
   
}
.left h3 {
    text-align: center;
    margin-bottom: 74px;
    font-size: 25px ;
    font-weight: bold;
}
.error {
    background: #F2DEDE;
    color: #A94442;
    padding: 10px;
    width: 95%;
    border-radius: 5px;
    margin: 20px auto;
 }
.left input {
    border: none;
    width: 80%;
    margin: 40px 0px;
    border-bottom: 1px solid #f6ae077d;
    padding: 7px 9px;
    width: 100%;
    overflow: hidden;
    background: transparent;
    font-weight: 600;
    font-size: 14px;
}

.left {
    background: linear-gradient(-45deg, #dcd7e0, #fff);
}
    </style>
</head>
<body>
    <header></header>

    <section class="login">
        
            <div class="left">
                <div class="contact">
                    <form action="login.php" method="post">
       
                                                                                                                                                                                                                                                                
                        <h3>SE AUTHENTIFIER</h3>
                        <input type="text" id="username" placeholder="username" name="username"value=""/>
                        <input type="password" id="password" placeholder="Password" name="password"/>
                        <button class="submit">CONNEXION</button>
                      
                       
                        
                    
                        
                    </form>
                </div>
            
          
        </div>
    </section>


 
</body>

</html>