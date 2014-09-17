#!/bin/bash
if [ -e "task.pid" ]
then
	echo Stopping server
	kill `cat task.pid`
	rm task.pid
	cat error.log
else
	echo Starting server
	php -S localhost:8000 router.php >> task.log 2> error.log &
	echo $! > task.pid
fi
