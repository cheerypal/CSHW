<!DOCTYPE html>
<!-- Author : Euan Gordon -->
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
        <script src="AJAXPost.js" type="text/javascript"></script>
        <script src="AJAXPresent.js" type="text/javascript"></script>
        <script src="onLoad.js" type="text/javascript"></script>
        <script src="Animations.js" type="text/javascript"></script>
        <script src="search.js" type="text/javascript"></script>
        <!--Protocols-->
        <meta name="viewport" content = "width=device-width, initial-scale = 1"/>
        <meta charset="UTF-8">
        <title>CSHW</title>
    </head>
    <?php
    session_start();

    if ( isset( $_SESSION['user_id'] ) ) {
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
                    <a class="navbar-brand logo" href="index.php">CSHW</a>
                </div>
                <div class="collapse navbar-collapse" id="nav">
                    <ul class="nav navbar-nav text-center navbar-right">
                        <li></li>
                        <li class="active"><a href="http://www2.macs.hw.ac.uk/~ejg9/CSHW/">Home</a></li>
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
            <div id="Main" style="padding-top: 130px;">
                <div class="container">
                    <div id="mainRow" class="row">
                        <div class="col-sm-4">
                            <div class="media" style="margin-bottom: 10px;">
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
                            <button id="buttonCollapse" class="btn btn-default col-sm-12" data-toggle="collapse" data-target="#formcollapse" style="width:100%" >Make a Post</button>
                            <div id="formcollapse" class="collapse">
                                <form id="mainform" class="form-horizontal" action="postData.php" method="post">
                                    <div class="form-group">
                                        <label class="control-label col-sm-1" for="topic">Topic: </label>
                                        <div class="col-sm-12">
                                            <input name="topic" type="text" id="topic" class="form-control" placeholder="Topic" size="30" required="required">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-3" for="description">Description: </label>
                                        <div class="col-sm-12">
                                            <textarea id="description" name="desc" class="text-area form-control" placeholder="Description" required="required"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-6">
                                            <select class="form-control" name="tags" required="required">
                                                <option name="java" value="java">Java</option>
                                                <option name="c" value="c">C</option>
                                                <option name="Web" value="Web">Web Development</option>
                                                <option name="news" value="news">News</option>
                                                <option name="python" value="python">Python</option>
                                                <option name="assembler" value="assembler">Assembler</option>
                                                <option name="ml" value="ml">ML</option>
                                                <option name="prolog" value="prolog">Prolog</option>
                                            </select>
                                            <input type="hidden" name="username" value="<?=$username?>">
                                        </div>
                                        <div class="col-sm-6">
                                            <button type="submit" class="btn btn-default form-control">Post</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div id="loading" class="text-center"></div>
                            <div id="links" class="col-sm-12" style=" padding-top:5px; margin-top:10px; border-top: 1px dotted #BF02FF">
                                <div class="links">
                                    <h3>Links To Other Sites:</h3>
                                    <h4><a href="https://vision.hw.ac.uk/">HW Vision</a></h4>
                                    <h4><a href="https://www.linkedin.com/">LinkedIn</a></h4>
                                    <h4><a href="https://stackoverflow.com/">StackOverflow</a></h4>
                                    <h4><a href="https://github.com/">GitHub</a></h4>
                                </div>
                            </div>
                        </div>
                        <div class="columns column-Recent col-sm-8">
                            <h2 style="padding-top:0; margin-top:0; font-weight: bold">Recent Posts</h2>
                            <div id="items">
                                <div class="media">
                                    <div class="media-left">
                                        <img src="ProfilePic2.png" alt="Profile Picture" class="media-object" style="width:60px;">
                                    </div>
                                    <div class="media-body">
                                        <h4 class="media-heading">Welcome to CSHW</h4>
                                        <h5 class="media-heading"><small>Pinned</small></h5>
                                        <h5 class="media-heading"><a href="http://www2.macs.hw.ac.uk/~ejg9"><small>Euan Gordon</small></a></h5>
                                        <p>Please use this website responsibly and post anything you wish, whether it be code problems or just general chit chat. If you find something wrong with the site please email me.
                                        <br>
                                            <a href="http://www2.macs.hw.ac.uk/~ejg9/">Check out my other site to find out more about me!</a> <br><br>Please enjoy as it looks better than HW Vision</p>
                                    </div>
                                </div>
                                <div id="posts">
                                    <!--posts-->
                                </div>
                            </div>
                        </div>
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