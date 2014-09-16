#!/bin/bash
if [ -e "server.pid" ]
then
	echo Stopping server
	kill `cat server.pid`
	rm server.pid
	cat error.log
else
	echo Starting server
	php -S localhost:8000 router.php >> server.log 2> error.log &
	echo $! > server.pid
fi
