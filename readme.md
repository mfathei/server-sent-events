#### Server Sent Events project

I am using lumen and lite-server to create and run this project

You need to install them globally using
`npm install -g lite-server http-proxy-middleware connect-history-api-fallback`
and create environment variable `NODE_PATH = C:\Users\mahdy\AppData\Roaming\npm\node_modules`
then just run lite-server <br/><br/>
`php -S 0.0.0.0:8181 -t public` <br/>
backend `http://127.0.0.1:8181/`<br>
`lite-server` <br/>
frontend `http://127.0.0.1:8000/` <br>
<hr>
or use php server without lite-server
`php -S 0.0.0.0:8000 -t public` <br>
then open `http://127.0.0.1:8000/` <br>

<hr>
now I use Redis as QUEUE driver <br>
and you need to run this `php artisan queue:work`
