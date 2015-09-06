#!/bin/bash

# Test Query 1
result1=`mysql --skip-column-names -uyii -pyiipass myrentsdb<<EOFMYSQL
SELECT id FROM address_tree WHERE lft >= rgt;
SELECT FOUND_ROWS();
EOFMYSQL`

echo "Test Query 1 result: $result1"

if [ $result1 -ne 0 ]
then
	echo "Test Query 1 failed"
	$(exit 1)
fi

# Test Qury 2
result2=`mysql --skip-column-names -uyii -pyiipass myrentsdb<<EOFMYSQL
select count(*) from address_tree where mod(rgt-lft,2) = 0; 
EOFMYSQL`

echo "Test Query 2 result: $result2"

if [ $result2 -ne 0 ]
then
        echo "Test Query 2 failed"
        $(exit 1)
fi

# Test Qury 3
result3=`mysql --skip-column-names -uyii -pyiipass myrentsdb<<EOFMYSQL
select count(*) from address_tree where mod(lft-level+1,2) = 1;
EOFMYSQL`

echo "Test Query 3 result: $result3"

if [ $result3 -ne 0 ]
then
        echo "Test Query 3 failed"
        $(exit 1)
fi

echo "All queries passes successfully"
