<!DOCTYPE html>
<html lang="en">
<head>
    <!--Imports-->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js" type="text/javascript"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Raleway:300" rel="stylesheet">
    <!--My CSS-->
    <link rel="stylesheet" href="generalLayout.css">
    <link rel="stylesheet" href="Adaptive.css">
    <!--Scripts-->
    <script src="Animations.js" type="text/javascript"></script>
    <script src="search.js" type="text/javascript"></script>
    <script src="AJAXpasswordChange.js" type="text/javascript"></script>
    <script src="AJAXprofileChange.js" type="text/javascript"></script>
    <script src="AJAXcoverChange.js" type="text/javascript"></script>
    <!--Protocols-->
    <meta name="viewport" content = "width=device-width, initial-scale = 1"/>
    <meta charset="UTF-8">
    <title>CSHW</title>
</head>
<?php
session_start();

if (isset( $_SESSION['user_id'] ) ) {
    require_once('configureDataBase.php');
    $stmt = $con->prepare("SELECT * FROM Users WHERE Username = ?");
    $stmt->bind_param("s", $_SESSION['user_id']);
    $stmt ->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_object();

    $username = $user->username;
    $yearOfStudy = $user->yearOfStudy;
    $subject = $user->subject;
    if($subject == "SE"){
        $subject = "Software Engineering";
    }elseif ($subject == "IS"){
        $subject = "Information Systems";
    }elseif ($subject == "CS"){
        $subject = "Computer Science";
    }elseif ($subject == "CSYS"){
        $subject = "Computer Systems";
    }
    $first = $user->firstName;
    $sur = $user->surname;
    $email = $user->email;
    $pic = $user->pic;
    $bPic = $user->backgroundPic;
    $stmt->close();
} else {
    header("Location: http://www2.macs.hw.ac.uk/~ejg9/CSHW/Login");
}
?>

<body>
<nav class="navbar navbar-default navbar-fixed-top" id="myNav">
    <div class="container">
        <div class="navbar-header">
            <button type ="button" class="navbar-toggle" data-toggle="collapse" data-target="#nav">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand logo" href="http://www2.macs.hw.ac.uk/~ejg9/CSHW/">CSHW</a>
        </div>
        <div class="collapse navbar-collapse" id="nav">
            <ul class="nav navbar-nav text-center navbar-right">
                <li><a href="http://www2.macs.hw.ac.uk/~ejg9/CSHW/">Home</a></li>
                <li><a href="http://www2.macs.hw.ac.uk/~ejg9/CSHW/MyYear">My Year</a></li>
                <li><a href="http://www2.macs.hw.ac.uk/~ejg9/CSHW/Profile">Profile</a></li>
                <li id="user"><a href="Logout.php">Logout</a></li>
            </ul>
            <form class="navbar-form navbar-right" action="searchResults.php" method="post">
                <div class="input-group">
                    <input name="searchText" id="searchText" type="text" class="text-box form-control" placeholder="Search" style="width:600px;" autocomplete="off">
                    <div class="input-group-btn">
                        <button class="btn btn-default" type="submit">
                            <i class="glyphicon glyphicon-search"></i>
                        </button>
                    </div>
                </div>
                <div id="result" class="text-center" style="padding-top: 10px;"></div>
            </form>
        </div>
    </div>
</nav>
<section>
    <div class="jumbotron text-center" style="margin-bottom:50px; padding:0;">
        <img src="<?=$bPic?>" alt="bPic" style="width:100%; height:auto; margin-top:0; padding:0;">
    </div>
    <div class="container">
        <div class="row" id="mainRow">
            <div class="col-sm-4">
                <div class="media" style="padding-bottom: 10px; border-bottom: 1px dotted #BF02FF;">
                    <div class="media-left">
                        <a href="http://www2.macs.hw.ac.uk/~ejg9/CSHW/Profile"><img src="<?=$pic?>" alt="No Profile Picture" class="media-object" style="width:100px;"></a>
                    </div>
                    <div class="media-body">
                        <h2 class="media-heading"><?=htmlspecialchars($first)?> <?=htmlspecialchars($sur)?></h2>
                        <h4 class="media-heading"><?=htmlspecialchars($username)?></h4>
                        <h4 class="media-heading"><?=$subject?></h4>
                        <h4 class="media-heading">Year: <?=$yearOfStudy?></h4>
                    </div>
                </div>
            </div>
            <div class="columns column-Recent col-sm-8">
                <h2 style="padding-top:0; margin-top:0; padding-bottom: 10px; margin-bottom:0; font-weight: bold;">Edit Profile</h2>
                <form class="editForms form-horizontal" method="post" id="pass" action="passwordChange.php">
                    <h3>Change Password:</h3>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="password">Old Password:</label>
                        <div class="col-sm-8">
                            <input name="password" class="form-control" id="password" autocomplete="off" type="password" placeholder="Old Password" required="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="username" value="<?=$username?>">
                        <label class="control-label col-sm-2" for="cPassword">New Password:</label>
                        <div class="col-sm-8">
                            <input name="cPassword" id="cPassword" class="form-control" autocomplete="off" type="password" placeholder="New Password" required="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2 col-sm-offset-2">
                            <button class="btn btn-default form-control" type="submit">Change</button>
                        </div>
                    </div>
                </form>
                <div id="loading" class="text-center"></div>
                <form id="pro" class="editForms form-horizontal" method="post" action="profileChange.php">
                    <h3>Change Profile Pic:</h3>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="pic">New Profile Pic:</label>
                        <div id="pic">
                            <div class="row">
                                <input type="hidden" name="username" value="<?=$username?>">
                                <label class="col-sm-1">
                                    <input type="radio" name="p" value="default.png">
                                    <img src="default.png" alt="default" style="width: 40px; margin-bottom:10px">
                                </label>
                                <label class="col-sm-1">
                                    <input type="radio" name="p" value="profilePics/crazy.png">
                                    <img src="profilePics/crazy.png" alt="crazy" style="width: 40px; margin-bottom:10px">
                                </label>
                                <label class="col-sm-1">
                                    <input type="radio" name="p" value="profilePics/devil.png">
                                    <img src="profilePics/devil.png" alt="devil" style="width: 40px; margin-bottom:10px">
                                </label>
                                <label class="col-sm-1">
                                    <input type="radio" name="p" value="profilePics/f.png">
                                    <img src="profilePics/f.png" alt="Fire" style="width: 40px; margin-bottom:10px">
                                </label>
                                <label class="col-sm-1">
                                    <input type="radio" name="p" value="profilePics/face.png">
                                    <img src="profilePics/face.png" alt="Face" style="width: 40px; margin-bottom:10px">
                                </label>
                                <label class="col-sm-1">
                                    <input type="radio" name="p" value="profilePics/h.png">
                                    <img src="profilePics/h.png" alt="100 Hundred" style="width: 40px; margin-bottom:10px">
                                </label>
                                <label class="col-sm-1">
                                    <input type="radio" name="p" value="profilePics/leg.png">
                                    <img src="profilePics/leg.png" alt="leg" style="width: 40px; margin-bottom:10px">
                                </label>
                                <label class="col-sm-1">
                                    <input type="radio" name="p" value="profilePics/poo.png">
                                    <img src="profilePics/poo.png" alt="poo" style="width: 40px; margin-bottom:10px">
                                </label>
                                <label class="col-sm-1">
                                    <input type="radio" name="p" value="profilePics/woozy.png">
                                    <img src="profilePics/woozy.png" alt="woozy" style="width: 40px; margin-bottom:10px">
                                </label>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-2 col-sm-offset-2">
                                    <button class="btn btn-default form-control" type="submit">Change</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div id="out" class="text-center"></div>
                <form id="cov" class="editForms form-horizontal" method="post" action="coverChange.php">
                    <h3>Change Cover Pic:</h3>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="pic">New Cover Pic:</label>
                        <div id="pic">
                            <div class="row">
                                <input type="hidden" name="username" value="<?=$username?>">
                                <label class="col-sm-2">
                                    <input type="radio" name="C" value="back1.JPG">
                                    <img src="back1.JPG" alt="default" style="width: 90px; margin-bottom:10px">
                                </label>
                                <label class="col-sm-2">
                                    <input type="radio" name="C" value="back3.jpg">
                                    <img src="back3.jpg" alt="reykjavik" style="width: 90px; margin-bottom:10px">
                                </label>
                                <label class="col-sm-2">
                                    <input type="radio" name="C" value="back4.JPG">
                                    <img src="back4.JPG" alt="sequoia" style="width: 90px; margin-bottom:10px">
                                </label>
                                <label class="col-sm-2">
                                    <input type="radio" name="C" value="back5.jpg">
                                    <img src="back5.jpg" alt="Wave" style="width: 90px; margin-bottom:10px">
                                </label>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-2 col-sm-offset-2">
                                    <button class="btn btn-default form-control" type="submit">Change</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div id="outCover" class="text-center"></div>
            </div>
        </div>
    </div>
</section>
<footer>
    <div id="foot">
        <div class="feet text-center" style="margin-bottom:0; margin-top:20px;">
            <p>Created by <a href="http://www2.macs.hw.ac.uk/~ejg9">Euan Gordon</a></p>
        </div>
    </div>
</footer>
</body>
</html>