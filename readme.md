<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<h1> About SocialNetwork</h1>
<p>SocialNetwork was build with php framework Laravel (5.8), Javascript, HTML and CSS(Bootstrap 4).</p>

<hr>

<p>How to use</p>

<small>for xampp on windows</small>
<ul>
	<li>clone project in xampp/htdocs</li>
	<li>go to the folder application using cd command on your cmd or terminal</li>
	<li>run composer install on your cmd or terminal inside of the folder</li>
	<li>copy .env.example file to .env on the root folder.</li>
	<li>php artisan key:generate (to generate key)</li>
	<li>php artisan storage:link (To create the symbolic link)</li>
	<li>create database for this project (for example name the database socialnetwork)</li>
	<li>php artisan migrate (migrate tables in database) </li>
	<li>php artisan serve (run project)</li>
</ul>

<small>for nginx on ubuntu</small>
<ul>
	<li>go to the /var/www/html</li>
	<li>sudo git clone --git path of the project-- (clone project in var/www/html)</li>
	<li>go to the folder application using cd command on your cmd or terminal (location var/www/html)</li>
	<li>sudo composer install (run composer install on your cmd or terminal inside of the folder)</li>
	<li>sudo cp .env.example .env (create new .env file from the .env.example, add DB_DATABASE, DB_USERNAME and DB_PASSWORD in .env)</li>
	<li>create database for this project (for example name the database socialnetwork)</li>
	<li>sudo php artisan key:generate (to generate key)</li>
	<li>sudo php artisan storage:link (To create the symbolic link)</li>
	<li>sudo php artisan migrate (migrate tables in database) </li>
</ul>




