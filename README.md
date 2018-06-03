<h1>DotFive Assessment</h1>

<h3>Installation</h3>
<p>Download composer using <em>curl -sS https://getcomposer.org/installer | sudo php -- --install-dir=/usr/local/bin --filename=composer</em> this command or you could find the documentation here <a href="https://getcomposer.org/download/">LINK</a></p>
<p><strong>db/</strong> folder contains the database file. You must have mysql installed and execute the script.</p>
<p>Then open the <strong>src/</strong> folder and option <strong>.env</strong> file and enter database credentials in 
	<ul>
		<li>DB_CONNECTION=mysql</li>
		<li>DB_HOST=127.0.0.1</li>
		<li>DB_PORT=3311</li>
		<li>DB_DATABASE=dotfive</li>
		<li>DB_USERNAME=root</li>
		<li>DB_PASSWORD=root</li>
	</ul>
</p>
<p>Now open terminal and enter the directory <strong>src/</strong> and run this command <string>composer install</string></p>
<p>After it is completed, now it's time to run the project my this command <strong>php artisan serve</strong></p>
<p>YOU MUST HAVE PHP5.6 INSTALLED</p>

<h3>Scenario</h3>
<p>The users have already been created.
	<ul>
		<li>
			<ul>
				<li>Sandy Shores</li>
				<li>Email: sandy@hotmail.com</li>
				<li>Password: Sandy123</li>
			</ul>
		</li>
		<li>
			<ul>
				<li>Mark Wahlberg</li>
				<li>Email: mark@hotmail.com</li>
				<li>Password: Mark123</li>
			</ul>
		</li>
	</ul>
</p>
<p>Sandy and Mark follows each other so they can get notification from each other whenever they perform any action.</p>
<p>Sandy and Mark both have add and update privileges that allow them to add and update categories and items.</p>
<p>If a new user is registered then it must follow other users and others must follow the new user in order to get notifications from amongst themselves.</p>
<p>Administrator has been created that can invoke the users rights to stop or allow add or update.
	<ul>
		<li>DotFive</li>
		<li>Email: admin@dotfive.com</li>
		<li>Password: DotFive123</li>
	</ul>
</p>
<p>Everything is pretty straightforward. After logging in there will be two menu items on top left <strong>Categories</strong> and <strong>Items</strong>. Both have their functionalities.</p>

