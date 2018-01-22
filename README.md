<h1>Simple movie review application</h1>
<h2>How to setup</h2>
<h3>Step #1</h3>
<p>Clone this repo and make a .env file in the project folder and run 'composer install' in terminal</p>
<h3>Step #2</h3>
<p>Go to the project folder and run in terminal 'php artisan key:generate'</p>
<h3>Step #3</h3>
<p>Create a mysql database for the project</p>
<h3>Step #4</h3>
<p>Go to 'config/database.php' and configure your settings there.</p>
<p>'mysql' => [</p>
               <p>'driver' => 'mysql',</p>
               <p>'host' => env('DB_HOST', '127.0.0.1'),</p>
               <p>'port' => env('DB_PORT', '3306'),</p>
               <p>'database' => env('DB_DATABASE', 'YOUR_DATABASE_NAME'),</p>
               <p>'username' => env('DB_USERNAME', 'YOUR_MYSQL_USERNAME'),</p>
               <p>'password' => env('DB_PASSWORD', 'YOUR_PASSWORD'),</p>
               <p>'unix_socket' => env('DB_SOCKET', ''),</p>
               <p>'charset' => 'utf8mb4',</p>
               <p>'collation' => 'utf8mb4_unicode_ci',</p>
               <p>'prefix' => '',</p>
               <p>'strict' => true,</p>
               <p>'engine' => null,</p>
           <p>],</p>
<h3>Step #5</h3>
<p>In the command line or terminal run 'php artisan migrate' to migrate the databases</p>
<h3>Step #6</h3>
<p>In the command line or terminal run 'php artisan db:seed --class:AdminSeeder' to seed the admin's username, password</p>
<p>Note: Admin username will be: 'admin@moviereview.com' and password: '123456' for the demo</p>
<h3>Step #6</h3>
<p>Now you can enter movies for normal movies to rate for the normal users.</p>
<p>Run 'php artisan serve' in the command line or terminal to get the project running on 'localhost:8000'</p>

<h1>Enjoy</h1>

<h4>If you have any question or inquiries please send a mail to me at this address: 'nahidshaiket10300@gmail.com'</h4>
