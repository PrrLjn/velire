#!/bin/bash

source ./bin/lib/functions.lib
eval $(parse_yaml ./bin/config.yaml)

exec 3>> messages.log
exec 2>> error.log

if [ $# = 0 ]
then
	echo "No option provided, use --init or --save-config"
	exit 1
fi

while [ -n "$1" ]
do
	case "$1" in
		--init) init;;
		--save-config) save;;
		--off)  PAR="$2"
				off $PAR
				shift;;
		--log) log;;
		--play) CLUSTER="$2"
				RECIPE="$3"
				play $CLUSTER $RECIPE
				shift 2;;
		--run)  RUN="$2"
				run $RUN
				shift;;
		--check)	check;;
		--delete-run)	FILE="$2"
						delete $FILE
						shift;;
		*) echo "$1 is not an option, use --init or --save-config";;
	esac
	shift
done
