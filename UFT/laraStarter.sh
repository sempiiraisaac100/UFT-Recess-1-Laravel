##THIS PROGRAMM IS TO START THE SERVER AND CRON JOBS####

#loop for ever####
xampp
while true
do
	php artisan schedule:run
	sleep 1
done

echo 'SCHEDULER STARTED'

