# Objective
Social media site for Spanish soccer fans to interact with one another. 
This website was built using MVC architecture. Uses: HTML5, CSS, JavaScript, PHP

# Summary
This web application is designed as a means of providing a social platform where
fans of the Spanish Soccer League, La Liga can interact with one another. It is
designed with the functionality to provide users the ability to Add, Delete and Edit
articles into the web application. Fellow users can view articles submitted by
other users and comment and interact with them. These articles will be
maintained through an SQL database but the ability to edit and delete articles
that have been posted to the web application remains largely with the original
creator. The displayed articles are dynamically called upon using the SQL
database. Users who sign up will be given a non admin role but a current
administrator in the website can make another user an admin. Administrators are
able to remove any article from its detail view or user by username or visiting
their profiles from the website. Once a user has been removed any events related
to that user or any articles related to the user will be removed from the SQL
database as well. This website will also record events related to a user when a
new user signs up, a user is made an admin, a new story is created, a story is
updated, and finally when a story is deleted. The SQL database will remove all
events related to a user if a user account is deleted or all events related to an
article if an article is removed.

# Special Features
Uses Ajax to provide the userbase with dynamic, asynchronous interactions. (using jquery)
<br/>
Uses amazon AWS machine learning to implement a filter for the article titles and body to 
moderate and unwwanted words from the site. </br>
Uses a dynamic graphical component to represent the relationship between articles and the userbase. 
This tree is built based on an interactive tree diagram where nodes represents users and the child nodes
are used to represent articles.
This 'article tree' can be used to implement all CRUD operations. </br>
Features a notification feed which is updated based on the actions of the userbase. </br>

# Installation instructions
Unzip the file and place the GoalLiga folder into the htdocs folder of xampp.</br>
Use the provided SQL file in the zip file to build the needed database.</br>
Any phpMyAdmin credentials would need to be changed in the config.php file.</br>
Any url changes are also done through the config.php file.</br>

# URL
http://ec2-54-211-68-150.compute-1.amazonaws.com/CS3744-N/GoalLiga//Home
