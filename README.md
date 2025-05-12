# travelstaytion_case_study
Case study for Travelstaytion internship application

A small social sharing platform where users can share and express opinions about movies.

# OVERVIEW

MovieWorld is a web application that allows users to : 
  - See the films that are registered.
  - Sign up.
  - Log in.
  - Create new movie posts.
  - Like or hate other users movies.
  - Sort movies based on Likes, Hates, Dates.

(there are several missing exception handling and no code commentary)

# TOOLS AND TECHNOLOGIES

  HTML, CSS, PHP, Node.js/Express.js
    
  For the creation and management of the database of the project, I used the XAMPP tool, which includes :
    - MySQL Database Management System to create and manage the database.
    - Apache Web Server to provide access to MySQL through phpMyAdmin.
    
  Node.js/Express.js to implement REST APIS, which will do the transactions with the database.
  
  PHP for call REST apis to import data into the DB and retrieve data from the DB.



#CHAPTERS

  Chapter 1 Home page.
    When the user is on the home page he can see the list of movies where they exist and the total number of movies. And he has the ability to sort them by Like, Hates, Dates. Also, the user can log in or register.

  Chapter 2 Sign up page.
    By clicking on the sign up link the user is transferred to the registration page where he can fill his details or go back by clicking on the “back to Movie World” link. After successfully registering he will be 
    redirected to the Log in page.

  Chapter 3 Log in page. 
    In the Log in page the user can fill his details and then if they are correct he will be redirected to the home page where there will be some changes from the originally mentioned page.

  Chapter 4 Logged in home page.
    The user has all the possibilities mentioned above.


# How to view the web app 
  - Start apache and mySQL on XAMPP.
  - In cmd type "cd movie_world_app" and then "node app.js".
  - In browser type "localhost/MovieWorld".
