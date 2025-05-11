<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <title>MOVIE WORLD</title>
        <link rel="stylesheet" href="CSS/index.css" type="text/css"/>
    </head>
    <body>
        <div class="appContainer">
            <div class="header">
                <h1>Movie World</h1>
                <div class="welcomeContainer">
                    <?php
                        if(isset($_SESSION['username']) && isset($_SESSION['userID'])){
                            $userName = $_SESSION['username'];
                            $userID = $_SESSION['userID'];
                            echo "<div class='welcome'>
                                    <p>Welcome Back <strong class='UNwelcome'>". $userName ."</strong></p>
                                </div>";
                            echo "<a href='logout.php' class='logoutLink'>Log Out</a>";
                        }
                        else{
                            echo "
                                <div class= 'logingSignup'>
                                    <a href='login.php' class='loginLink'>Log in</a> or <a href='signup.php' class='signupLink'>Sign up</a>
                                </div>
                            ";
                        }
                    ?>
                </div>
            </div>
            <div>
                <?php
                    $sort = isset($_GET['sort']) ? $_GET['sort'] : 'dates';
                    $url="http://localhost:3000/movies?sort=" . urlencode($sort);
                    if (isset($userID)) {
                        $url .= "&user_id=" . urlencode($userID);
                    }

                    $curl=curl_init($url);

                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

                    $response=curl_exec($curl);

                    $data=json_decode($response, true);

                    echo "
                        <div class='moviesSum'> 
                            Found ". count($data) . " movies
                        </div>
                    ";
                    
                ?>
            </div>
            <div class="contentContainer">
                <div class="moviesContainer">
                    <?php
                        foreach ($data as $movies){

                            $likeOpinion = '';
                            $hateOpinion = '';
                            if(isset($movies['opinion'])) {
                                if ($movies['opinion'] === 'like') {
                                    $likeOpinion = 'selected';
                                } else if ($movies['opinion'] === 'hate') {
                                    $hateOpinion ='selected';
                                }
                            }

                            $sumedLikesOpinions = '';
                            $sumedHatesOpinions = '';
                            if(isset($movies['opinion'])) {
                                if ($movies['opinion'] === 'like') {
                                    $sumedLikesOpinions = 'likesSelectedSum';
                                } else if ($movies['opinion'] === 'hate') {
                                    $sumedHatesOpinions ='hatesSelectedSum';
                                }
                            }
                            
                            echo "
                                <div class='movie'>
                                    <div class='movieHeader'>
                                        <h2>" . $movies['title'] . "</h2>
                                        <p>Posted " . date('d/m/Y',strtotime($movies['dateOfPublication'])) . "</p>
                                    </div>
                                    <div class='movieDescription'>
                                        " . $movies['description'] . "
                                    </div>
                                    <div class='movieFooter'>
                                        <div class='movieLikesHates'>
                                           <div class='$sumedLikesOpinions'> " . $movies['likes']." likes </div>| <div class='$sumedHatesOpinions'>" . $movies['hates'] . " hates</div>
                                        </div>
                                        ";
                                        if(isset($_SESSION['username']) && ($userID != $movies['user_id'])){
                                            echo "
                                                <div class='movielikeHateForm'>
                                                    <form class='likeForm' action='opinion.php' method='POST'>
                                                        <input type='hidden' name='movie_id' value='" . $movies['id'] . "'>
                                                        <input type='hidden' name='type' value='like'>
                                                        <button type='submit' class='likehateButton $likeOpinion'>Like</button>
                                                    </form> |
                                                    <form class='hateForm' action='opinion.php' method='POST'>
                                                        <input type='hidden' name='movie_id' value='" . $movies['id'] . "'>
                                                        <input type='hidden' name='type' value='hate'>
                                                        <button type='submit' class='likehateButton $hateOpinion'>Hate</button>
                                                    </form>
                                                </div>
                                            ";
                                        }
                                        if(isset($_SESSION['username'])){
                                            if(($userID != $movies['user_id'])){
                                                echo "            
                                                    <div>
                                                        Posted by <strong class='movieUsername'>" . $movies['userName'] . "</strong>
                                                    </div> 
                                                ";
                                            } else {
                                                echo "            
                                                    <div>
                                                       Posted by <strong class='movieUsername'>You</strong>
                                                    </div>
                                                ";
                                            }
                                        } else {
                                            echo "            
                                                <div>
                                                    Posted by <strong class='movieUsername'>" . $movies['userName'] . "</strong>
                                                </div> 
                                            ";
                                        }
                            echo"   </div>
                                </div>
                            ";
                        }
                    ?>   
                </div>
                <div class="newMovieSortContainer">
                    <?php
                        if(isset($_SESSION['username'])){
                            $userName = $_SESSION['username'];
                            echo "<div class='newMovie'>
                                    <a href='newmovie.php'>New Movie</a>
                                </div>";
                        }
                    ?>
                    <div class="sort">
                        <p>Sort by:</p>
                        <a href="?sort=likes">
                            Likes <span class="checkbox <?php if (isset($_GET['sort']) && $_GET['sort'] == 'likes') echo 'checked'; ?>"></span>
                        </a>
                        <a href="?sort=hates">
                            Hates <span class="checkbox <?php if (isset($_GET['sort']) && $_GET['sort'] == 'hates') echo 'checked'; ?>"></span>
                        </a>
                        <a href="?sort=dates">
                            Dates <span class="checkbox <?php if (!isset($_GET['sort']) || $_GET['sort'] == 'dates') echo 'checked'; ?>"></span>
                        </a>
                    </div>
                <div>

                </div>
            </div>
        </div>
    </body>
</html>