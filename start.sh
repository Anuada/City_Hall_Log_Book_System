#!/bin/bash

echo "Please select an option:"
echo "1. "
echo "2. "
echo "3. Database Drop"
echo "4. "
echo "5. "

read option

case $option in
1)
    echo "";
    ;;
2)
    echo "";
    ;;
3)
    echo "Dropping the Database"
    php ./database/actions/drop.php
    ;;
4)
    echo "";
    ;;
5)
    echo "";
    ;;
*)
    echo "Invalid option. Please enter a number between 1 and 5."
    ;;
esac
