#!/bin/bash

str=${1^^}	# uppercase
zcat $2/${str}.gz

