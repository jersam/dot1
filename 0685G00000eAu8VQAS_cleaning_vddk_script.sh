#!/bin/bash

# Copyright (c) 2022 VMware, Inc. All rights reserved.

# The aim of the script is to delete every file in following pattern:
#                         *VDDK.*
#
# The default period is set to 180 days, but can be set as an argument.
# Ex: ./cleaning_vddk_script.sh 90 (Delete every file older than 90 days).

DEFAULT_PERIOD=180
TARGET_DIR="/storage/log/vmware/analytics/prod"
PERIOD=${1:-$DEFAULT_PERIOD}

if [[ -d "$TARGET_DIR" ]]; then
    echo "Files before the clean :" 

    find $TARGET_DIR -name "*VDDK.*" -type f -exec wc -l {} +  |  wc -l

    echo "==="

    echo "Start cleaning VDDK files older than $PERIOD days..."

    find $TARGET_DIR -name "*VDDK.*" -type f -mtime +$PERIOD -delete
    if [ $? -eq 0 ]; then
        echo "Clean successful!"
    else
        echo "The clean was unsuccessful!"
    fi

    echo "==="

    echo "Files after the clean: "

    find $TARGET_DIR -name "*VDDK.*" -type f -exec wc -l {} +  |  wc -l
else
    echo "Directory not found!"
fi    
