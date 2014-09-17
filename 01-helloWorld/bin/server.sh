#!/bin/bash
if [ -e "server.pid" ]
then
	echo Stopping server
	kill `cat server.pid`
	rm task.pid
	cat error.log
else
	echo Starting server
	php -S localhost:8000 router.php >> task.log 2> error.log &
	echo $! > task.pid
fi
