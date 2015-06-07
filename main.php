<?php session_start(); 
?>

<!DOCTYPE html>
<!-- saved from url=(0022)http://x5c.de/jtinder/ -->
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>exp</title>
    <link rel="stylesheet" type="text/css" href="./jTinder Touch Slider_files/jTinder.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
</head>
<body>


<script src="jquery-1.11.3.min.js"></script>

    <script type="text/javascript" src="./jTinder Touch Slider_files/jquery.jTinder.js"></script>

<script>
    var userData;
    var count = 0;

    //this array will hold the usernames of disliked persons as well as holding the username of the current user at position [0]. 
    var usernames = [];
    $( document ).ready(function() {

    //uses session to keep track of the user after they sign in
    var sessionUser = usernames['0'] = $("#userID").val();

    var curUser = {"username": $("#userID").val()};

        $.post( 
        "users.php",
        curUser,
        function(info, userData){
            userData = $.parseJSON(info);
            //$("#feedBackArea").empty();

            //display all the members on the website
            if (userData != null)
            {

                console.log(info);
                  for(var i = 0 ; i < userData.length; i++) 
                    {

                            $("#displayarea").append(   '<li class="'+userData[count].username+'"><div class="img"></div><div class = "name"></div><div class = "quote"></div><div class="like"></div><div class="dislike"></div></li>'
                            );
                            $('#tinderslide .'+userData[count].username+' .img').css("background", 'url("'+userData[count].picture+'") no-repeat scroll center center');
                            $('#tinderslide .'+userData[count].username+' .img').css("background-size", "auto 95%");
                            $('#tinderslide .'+userData[count].username+' .quote').css("font-size", "75%");
                            $('#tinderslide .'+userData[count].username+' .name').append(userData[count].name + "<br>");
                            $('#tinderslide .'+userData[count].username+' .quote').append('"'+userData[count].quote + '"<br>');
                            
                            usernames[count+1]=userData[count].username;
                            count += 1;
                    }
                    $( document ).ready(function() {
                    go();        
                    transform();
                    mainTind(usernames);
                    });

            }
            else
            {
                $("#feedBackArea").html("failed auth!");
            }                                   
        }
    );
    
    //hides the area from the user where I pass variables from php to JS
    $("#userID").hide();


    });
  

</script>
<div class="container">
    <h2 class = "titles text-center" id = "userLog"> HATR: </h2>
    <h3 class = "titles text-center" >Connecting people who have an irrational hatred of each other</h3>
</div>

    <!-- start padding container -->
    <div class="wrap container">
        <!-- start jtinder container -->
        <div id="tinderslide">
            <ul id= "displayarea" style ="background: #fff0d6">

            
            </ul>
        </div>
        <!-- end jtinder container -->
    </div>
    <!-- end padding container -->

    <!-- jTinder trigger by buttons  -->
    <div class="actions">
        <a href="" class="dislike"><i></i></a>
        <a href="" class="like"><i></i></a>
    </div>

<div class="container text-center">   
    <div id = "hateArea" style = "font-size: 150%"></div>
    <div id = "feedBackArea"></div>
    <!-- Hold values that need to be passed from php to javascript  -->
    <input type = "text" id = "userID" value = <?php echo ($_SESSION['username'])?>></input>


    <!-- jTinder status text  -->
    <div id="status"></div>
</div>


    <!-- jQuery lib -->
    
    <!-- jQuery lib -->
    <script type="text/javascript" src="./jTinder Touch Slider_files/jquery.min.js"></script>
    <!-- transform2d lib -->
    <script type="text/javascript" src="./jTinder Touch Slider_files/jquery.transform2d.js"></script>
    <!-- jTinder lib -->
    <script type="text/javascript" src="./jTinder Touch Slider_files/jquery.jTinder.js"></script>
    <!-- jTinder initialization script -->
    <script type="text/javascript" src="./jTinder Touch Slider_files/main.js"></script>






</body></html>