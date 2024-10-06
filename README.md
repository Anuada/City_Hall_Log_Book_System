# User Guide: start.sh Script

================================

## Introduction

---

The `start.sh` script is a Bash script that provides a menu-driven interface for managing database operations. This user guide explains how to use the script to perform various database tasks.

## Prerequisites

---

- The script assumes that you have Bash installed on your system.
- The script uses PHP to drop the database, so you need to have PHP installed and configured on your system.
- The script uses shell scripts (`db_migration.sh` and `db_seeders.sh`) to perform database migration and seeding, respectively. These scripts should be located in the `scripts` directory.

## Usage

---

### 1. Open a terminal or git bash

### 2. Run the script by typing the following command.

    ```bash
    sh scripts/start.sh
    ```

### 3. The script will display a menu with the following options:

    ```bash
    Please select an option:
    1. Database Migration
    2. Database Drop
    3. Database Seed
    4. Database Migration w/ Database Drop
    5. Database Migration w/ Database Seed
    6. Database Migration w/ Database Drop and Database Seed
    ```

### 4. Enter the number of your chosen option and press Enter.

### 5. The script will prompt you to confirm your selection. Enter `y` to proceed or `n` to cancel.

## Options

---

### 1. Database Migration

- This option migrates the database using the `db_migration.sh` script.
- The script will prompt you to confirm before proceeding.

### 2. Database Drop

- This option drops the database using the `drop.php` script.
- The script will prompt you to confirm before proceeding.

### 3. Database Seed

- This option seeds the database using the `db_seeders.sh` script.
- The script will prompt you to confirm before proceeding.

### 4. Database Migration w/ Database Drop

- This option drops the database using the `drop.php` script and then migrates the database using the `db_migration.sh` script.
- The script will prompt you to confirm before proceeding.

### 5. Database Migration w/ Database Seed

- This option migrates the database using the `db_migration.sh` script and then seeds the database using the `db_seeders.sh` script.
- The script will prompt you to confirm before proceeding.

### 6. Database Migration w/ Database Drop and Database Seed

- This option drops the database using the `drop.php` script, migrates the database using the `db_migration.sh` script, and then seeds the database using the `db_seeders.sh` script.
- The script will prompt you to confirm before proceeding.

## Troubleshooting

---

- If you encounter any issues while running the script, check the script's output for error messages.
- Make sure that the `db_migration.sh` and `db_seeders.sh` scripts are located in the `scripts` directory.
- Make sure that PHP is installed and configured correctly on your system.
