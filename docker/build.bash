#!/bin/bash

dir=`mktemp -d`

git archive HEAD | tar -x -C "$dir"

docker build -t wcob/digital-measures-research-feeds "$dir"
