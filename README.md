# anitop

## Installation
1. Install the dependencies
 * app: *npm i*
 * server: *composer install*
2. Configuring the database
 1. Run all the SQL inside docs/
 2. Configure the parameters of Connection in the BaseConnection class
 3. The password is in a environment variable called `db_pwd`
3. Start the server and app
 * app: *npm run dev*
 * server: *composer run-script start*