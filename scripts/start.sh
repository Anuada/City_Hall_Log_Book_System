#!/bin/bash

echo "Please select an option:"
echo "1. Database Migration"
echo "2. Database Drop"
echo "3. Database Seed"
echo "4. Database Migration w/ Database Drop"
echo "5. Database Migration w/ Database Seed"
echo "6. Database Migration w/ Database Drop and Database Seed"

read -p "Enter your choice: " option

case $option in
1)
    read -p "Are you sure you want to migrate the database? (y/n) " -n 1 -r
    echo    # (optional) move to a new line
    if [[ $REPLY =~ ^[Yy]$ ]]
    then
        echo "Migrating Database";
        sh ./scripts/db_migration.sh
        echo "Database Migration Complete";
    else
        echo "Migration cancelled."
    fi
    ;;
2)
    read -p "Are you sure you want to drop the database? (y/n) " -n 1 -r
    echo    # (optional) move to a new line
    if [[ $REPLY =~ ^[Yy]$ ]]
    then
        echo "Dropping the Database";
        php ./database/drop.php
    else
        echo "Drop cancelled."
    fi
    ;;
3)
    read -p "Are you sure you want to seed the database? (y/n) " -n 1 -r
    echo    # (optional) move to a new line
    if [[ $REPLY =~ ^[Yy]$ ]]
    then
        echo "Seeding Database";
        sh ./scripts/db_seeders.sh
        echo "Database Seeding Complete";
    else
        echo "Seeding cancelled."
    fi
    ;;
4)
    read -p "Are you sure you want to migrate the database with drop? (y/n) " -n 1 -r
    echo    # (optional) move to a new line
    if [[ $REPLY =~ ^[Yy]$ ]]
    then
        echo "Dropping the Database";
        php ./database/drop.php
        echo "";
        echo "Migrating Database";
        sh ./scripts/db_migration.sh
        echo "Database Migration Complete";
    else
        echo "Migration with drop cancelled."
    fi
    ;;
5)
    read -p "Are you sure you want to migrate the database with seed? (y/n) " -n 1 -r
    echo    # (optional) move to a new line
    if [[ $REPLY =~ ^[Yy]$ ]]
    then
        echo "Migrating Database";
        sh ./scripts/db_migration.sh
        echo "Database Migration Complete";
        echo "";
        echo "Seeding Database";
        sh ./scripts/db_seeders.sh
        echo "Database Seeding Complete";
    else
        echo "Migration with seed cancelled."
    fi
    ;;
6)
    read -p "Are you sure you want to migrate the database with drop and seed? (y/n) " -n 1 -r
    echo    # (optional) move to a new line
    if [[ $REPLY =~ ^[Yy]$ ]]
    then
        echo "Dropping the Database";
        php ./database/drop.php
        echo "";
        echo "Migrating Database";
        sh ./scripts/db_migration.sh
        echo "Database Migration Complete";
        echo "";
        echo "Seeding Database";
        sh ./scripts/db_seeders.sh
        echo "Database Seeding Complete";
    else
        echo "Migration with drop and seed cancelled."
    fi
    ;;
*)
    echo "Invalid option. Please enter a number between 1 and 6."
    ;;
esac